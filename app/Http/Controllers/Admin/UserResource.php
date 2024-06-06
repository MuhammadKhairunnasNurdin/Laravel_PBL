<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreAdminKaderRequest;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Admin;
use App\Models\Kader;
use App\Models\Penduduk;
use App\Models\User;
use App\Services\FilterServices;
use App\Services\ImageLogic;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class UserResource extends Controller
{

    public function __construct(
        private readonly FilterServices $filter
    )
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Data User'
        ];

        $activeMenu = 'user';

        /**
         * Retrieve data for filter feature
         */
        $users = $this->filter->getFilteredUser($request)->paginate(5);
        $users->appends(request()->all());

        /**
         * delete data that trashed in soft deleted kader
         */
        if (Kader::onlyTrashed()->where('deleted_at', '<=', now()->subMonth())->exists()) {
            Artisan::call('model:prune');
        }

        return view('admin.user.index', compact('breadcrumb', 'activeMenu', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Data User'
        ];

        $activeMenu = 'user';

        $penduduks = Penduduk::whereDoesntHave('kaders')
            ->whereDoesntHave('admins')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) >= 20')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) <= 50')
            ->get();

        if ($penduduks->count() === 0) {
            return redirect()->intended('admin/user' . session('urlPagination'))
                ->with('error', 'Data penduduk(usia 20-50 tahun dan tidak punya akun) tidak tersedia untuk penambahan user');
        }

        return view('admin.user.tambah', compact('breadcrumb', 'activeMenu', 'penduduks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $userRequest, StoreAdminKaderRequest $adminKaderRequest): RedirectResponse
    {
        $user = User::create($userRequest->input());
        $adminKaderRequest->merge([
            'user_id' => $user->user_id
        ]);

        if ($user->level === 'admin') {
            Admin::create($adminKaderRequest->all());
        } else {
            $softDeletedKader = Kader::withTrashed()->where('penduduk_id', $adminKaderRequest->input('penduduk_id'))->first();
            if ($softDeletedKader) {
                $softDeletedKader->restore();
                $softDeletedKader->update($adminKaderRequest->all());
            } else {
                Kader::create($adminKaderRequest->all());
            }
        }

        return redirect()->intended('admin/user' . session('urlPagination'))
            ->with('success', 'Data user berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Data User'
        ];

        $activeMenu = 'user';

        $user = User::with(['kaders', 'admins'])->find($id);
        if ($user === null) {
            return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Data user tidak ditemukan atau mungkin sudah dihapus admin lain');
        }

        $penduduk = User::with(['admins', 'kaders'])->findOrFail($id);

        if ($penduduk->kaders->isNotEmpty()) {
            $penduduk = $penduduk->kaders->first()->penduduk;
        }else if ($penduduk->admins->isNotEmpty()) {
            $penduduk = $penduduk->admins->first()->penduduk;
        }

        return view('admin.user.detail', compact('breadcrumb', 'activeMenu', 'user', 'penduduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Data User'
        ];

        $activeMenu = 'user';

        $user = User::find($id);
        if ($user === null) {
            return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Data user tidak ditemukan atau mungkin sudah dihapus admin lain');
        }

        $pendudukNama = User::with(['admins', 'kaders'])->findOrFail($id);

        if ($pendudukNama->kaders->isNotEmpty()) {
            $pendudukNama = $pendudukNama->kaders->first()->penduduk->nama;
        }else if ($pendudukNama->admins->isNotEmpty()) {
            $pendudukNama = $pendudukNama->admins->first()->penduduk->nama;
        }

        return view('admin.user.edit', compact('breadcrumb', 'activeMenu', 'user', 'pendudukNama'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id): RedirectResponse
    {
        /**
         * try database transaction, because we use sql type
         * database(mysql), to prevent database race condition when
         * update data, we use transaction to rollback if there are any
         * error and catch that error mesasge to display in view
         */
        try {
            /**
             * return $isUpdated for checking update data not just
             * submit when not actually changes
             */
            $isUpdated =  DB::transaction(function () use ($request, $id) {
                $isUpdated = false;

                /**
                 * lock and update with queue penduduks table
                 * to prevent database race condition
                 *
                 * and check if use has change column in penduduks table
                 */
                $user = User::lockForUpdate()->find($id);
                if ($user === null) {
                    return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Data user sudah dihapus lebih dulu oleh admin lain');
                }

                if ($request->all() !== []) {
                    /**
                     * fill $isUpdated to use in checking update
                     * action
                     */
                    if ($request->has('level')) {
                        /**
                         * retrieve old level
                         */
                        $level = $user->level;
                        /**
                         * retrieve kader model for updating data
                         */
                        $kader = Kader::where('user_id', $id)->first();

                        /**
                         * if level change from kader or ketua to admin
                         */
                        if ($request->level === 'admin') {
                            Admin::create([
                                'penduduk_id' => $kader->penduduk_id,
                                'user_id' => $id
                            ]);

                            $kader->delete();
                        }
                        /**
                         * if level change from admin to ketua or kader
                         */
                        elseif ($level === 'admin') {
                            $admin = Admin::where('user_id', $id)->first();
                            $this->updateTrashedKader($admin, $id);
                        }
                        /**
                         * if level change from kader to ketua or vice versa
                         */
                        else {
                            $this->updateTrashedKader($kader, $id);
                        }
                    }

                    if ($request->has('foto_profil')) {
                        /**
                         * retrieve old hashName foto_profil
                         */
                        $foto_profil = $user->foto_profil;
                        /**
                         * delete foto_profil that saved in public/user directory
                         */
                        ImageLogic::delete($foto_profil, 6, 'user_img');
                    }

                    $isUpdated = $user->update($request->input());
                }

                return $isUpdated;
            });

            if (!is_bool($isUpdated)){
                return $isUpdated;
            }

            return redirect()->intended('admin/user' . session('urlPagination'))
                ->with('success', $isUpdated ? 'Data user berhasil diubah' : 'Namun Data user tidak diubah');
        } catch (\Throwable $e) {
            return redirect()->intended('admin/user' . session('urlPagination'))
                ->with('error', 'Terjadi Masalah Ketika mengubah Data user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request): RedirectResponse
    {
        /**
         * try database transaction, because we use sql type
         * database(mysql), to prevent database race condition when
         * delete data, we use transaction to rollback if there are any
         * error and catch that error mesasge to display in view
         */
        try {
            return DB::transaction(function () use ($id, $request) {
                /**
                 * lock and delete with queue users table
                 * to prevent database race condition
                 */
                $user = User::lockForUpdate()->find($id);
                if ($user === null) {
                    return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Data user tidak ditemukan');
                }

                /**
                 * check if other user is update our data when we do delete action
                 */
                if ($user->updated_at > $request->input('updated_at')) {
                    return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Data user masih di update oleh admin lain, coba refresh dan lakukan hapus lagi');
                }

                /**
                 * because  kader is soft delete in model and migration, we do this to softly delete that data
                 */
                Kader::where('user_id', $id)->delete();

                /**
                 * retrieve old hashName foto_profil
                 */
                $foto_profil = $user->foto_profil;
                /**
                 * delete foto_profil that saved in public/user directory
                 */
                ImageLogic::delete($foto_profil, 6, 'user_img');
                /**
                 * delete user that also delete admins data because cascadeOnDelete
                 */
                $user->delete();

                return redirect()->intended('admin/user' . session('urlPagination'))->with('success', 'Data user berhasil dihapus');
            });
        } catch (QueryException) {
            return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        } catch (\Throwable $e) {
            return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Terjadi Masalah Ketika menghapus Data user: ' . $e->getMessage());
        }
    }

    /**
     * update data trashed in kader table and delete old model
     *
     * @param Admin|Kader $model
     * @param string $user_id
     * @return void
     */
    private function updateTrashedKader(Admin|Kader $model, string $user_id): void
    {
        $softDeletedKader = Kader::onlyTrashed()->where('penduduk_id', $model->penduduk_id)->first();
        if ($softDeletedKader) {
            $softDeletedKader->restore();
            $softDeletedKader->update([
                'user_id' => $user_id
            ]);
        } else {
            Kader::create([
                'penduduk_id' => $model->penduduk_id,
                'user_id' => $user_id
            ]);
        }

        $model->delete();
    }
}
