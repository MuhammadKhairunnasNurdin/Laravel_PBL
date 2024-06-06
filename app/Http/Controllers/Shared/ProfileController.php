<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Penduduk;
use App\Models\User;
use App\Services\ImageLogic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function indexKader()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Profil',
        ];

        $activeMenu = 'profile';

        /**
         * Retrieve User with level Kader for updating profile feature
         */
        $user = $this->indexData('kaders');

        return view('kader.profil.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'user' => $user]);
    }

    public function indexKetua()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Profil',
        ];

        $activeMenu = 'profile';

        /**
         * Retrieve User with level ketua for updating profile feature
         */
        $user = $this->indexData('kaders');

        return view('ketua.profil.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'user' => $user]);
    }

    public function indexAdmin()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Profil',
        ];

        $activeMenu = 'profile';

        /**
         * Retrieve User with level ketua for updating profile feature
         */
        $user = $this->indexData('admins');

        return view('admin.profil.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'user' => $user]);
    }

    /**
     * Retrieve users joined kaders table with specific id
     */
    private function indexData(string $relationship): array
    {
        $user = User::with($relationship)->find(Auth::id())->only('username', 'foto_profil', 'updated_at', $relationship);

        $user['nama'] = Penduduk::find($user[$relationship][0]->penduduk_id)->only('nama')['nama'];

        unset($user[$relationship]);

        return $user;
    }

    /**
     * for updating username, password or foto profil user
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
                 * lock and update with queue users table
                 * to prevent database race condition
                 *
                 * and check if user is found or not
                 */
                $user = User::lockForUpdate()->find($id);
                if ($user === null) {
                    return redirect()
                        ->intended( Auth::user()->level. '/profile')
                        ->with('error', 'data user tidak ditemukan');
                }

                if ($request->input() !== []) {
                    $isUpdated = $user->update($request->input());
                }

                return $isUpdated;
            });

            if (!is_bool($isUpdated)){
                return $isUpdated;
            }

            return redirect()->intended( Auth::user()->level . '/profile')
                ->with('success', $isUpdated ? 'Data user berhasil diubah' : 'Namun Data user tidak diubah');
        } catch (\Throwable $e) {
            return redirect()->intended(Auth::user()->level . '/profile')
                ->with('error', 'Terjadi Masalah Ketika mengubah Data user: ' . $e->getMessage());
        }
    }

    public function delete(string $id, $updated_at): RedirectResponse
    {
        /**
         * try database transaction, because we use sql type
         * database(mysql), to prevent database race condition when
         * delete data, we use transaction to rollback if there are any
         * error and catch that error mesasge to display in view
         */
        try {
            return DB::transaction(function () use ($id, $updated_at) {
                /**
                 * lock and delete with queue users table
                 * to prevent database race condition
                 */
                $user = User::lockForUpdate()->find($id);
                if ($user === null) {
                    return redirect()->intended(Auth::user()->level . '/profile')->with('error', 'Data user tidak ditemukan');
                }

                /**
                 * check if other user is update our data when we do delete action
                 */
                if ($user->updated_at > $updated_at) {
                    return redirect()->intended(Auth::user()->level . '/profile')->with('error', 'Data user masih di update pada beda device, coba refresh dan lakukan hapus lagi');
                }

                /**
                 * retrieve old hashName foto_profil
                 */
                $foto_profil = $user->foto_profil;
                /**
                 * delete foto_profil that saved in public/user directory
                 */
                ImageLogic::delete($foto_profil, 6, 'user_img');

                /**
                 * give value null to hashName foto that saved in database
                 */
                $user->update(['foto_profil' => null]);

                return redirect()->intended(Auth::user()->level . '/profile')->with('success', 'Foto profil berhasil dihapus');
            });
        } catch (\Throwable $e) {
            return redirect()->intended('admin/user' . session('urlPagination'))->with('error', 'Terjadi Masalah Ketika menghapus Foto Profil: ' . $e->getMessage());
        }
    }
}
