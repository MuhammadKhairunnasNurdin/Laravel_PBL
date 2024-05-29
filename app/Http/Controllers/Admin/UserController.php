<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\User;
use App\Models\Admin;
use App\Models\Kader;
use App\Models\Penduduk;
use App\Services\FilterServices;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private FilterServices $filter;

    public function __construct(FilterServices $filter)
    {
        $this->filter = $filter;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Data User'
        ];

        $activeMenu = 'users';

        /**
         * Retrieve data for filter feature
         */
        $users = User::paginate(10);

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

        $activeMenu = 'users';

        $users = User::all();
        $penduduks = Penduduk::all();

        return view('admin.user.tambah', compact('breadcrumb', 'activeMenu', 'users', 'penduduks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        User::create($request->all());

        return redirect()->intended('admin/user' . session('urlPagination'))
            ->with('success', 'Data user berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::find($id);
        if ($users === null) {
            return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Data user tidak ditemukan atau mungkin sudah dihapus admin lain');
        }

        $breadcrumb = (object) [
            'title' => 'Data User'
        ];

        $activeMenu = 'users';

        // $users =  User::where('user_id', $id)->get();
        
        return view('admin.user.detail', compact('breadcrumb', 'activeMenu', 'users'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::find($id);
        if ($users === null) {
            return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Data user tidak ditemukan atau mungkin sudah dihapus admin lain');
        }
        
        $breadcrumb = (object) [
            'title' => 'Data User'
        ];
        
        $activeMenu = 'users';
        
        $users =  User::where('user_id', $id)->get();

        return view('admin.user.edit', compact('breadcrumb', 'activeMenu', 'users'));
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
                $users = User::lockForUpdate()->find($id);
                if ($request->all() !== [] and $users !== null) {
                    /**
                     * fill $isUpdated to use in checking update
                     * action
                     */
                    $isUpdated = $users->update($request->all());
                }

                return $isUpdated;
            });

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
                $users = User::lockForUpdate()->find($id);
                if ($users === null) {
                    return redirect()->intended('admin/penduduk' . session('urlPagination'))->with('error', 'Data user tidak ditemukan');
                }

                /**
                 * check if other user is update our data when we do delete action
                 */
                if ($users->updated_at > $request->input('updated_at')) {
                    return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Data user masih di update oleh admin lain, coba refresh dan lakukan hapus lagi');
                }

                /**
                 * if penduduk has an account either had role kader, ketua, or admin, will delete to
                 */
                $kader = Kader::where('penduduk_id', $id)->get('user_id');
                $admin = Admin::where('penduduk_id', $id)->get('user_id');
                /**
                 * we delete penduduk after we search query above in table kaders and admins
                 *
                 * because when penduduks table deleted, admins and kaders are deleted too in cascadeOnDelete function
                 */
                $users->delete();
                /**
                 * if penduduk is kader
                 */
                if ($kader->containsOneItem()) {
                    User::find($kader[0]->user_id)->delete();
                }
                /**
                 * if penduduk is admin
                 */
                if ($admin->containsOneItem()) {
                    User::find($admin[0]->user_id)->delete();
                }

                return redirect()->intended('admin/user' . session('urlPagination'))->with('success', 'Data penduduk berhasil dihapus');
            });
        } catch (QueryException) {
            return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Data penduduk gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        } catch (\Throwable $e) {
            return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Terjadi Masalah Ketika menghapus Data penduduk: ' . $e->getMessage());
        }
    }
}