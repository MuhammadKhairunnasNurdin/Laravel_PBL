<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $user = User::with($relationship)->find(Auth::id())->only('username', 'foto_profil', $relationship);

        if ($relationship === 'kaders') {
            $user['nama'] = Penduduk::find($user[$relationship][0]->penduduk_id)->only('nama')['nama'];
        } else {
            $user['nama'] = $user[$relationship][0]->nama;
        }

        unset($user[$relationship]);

        return $user;
    }

    /**
     * for updating username or password user
     */
    public function update(Request $request): RedirectResponse
    {
        /**
         * Retrieve authenticate user that want to update password and username or one of them
         */
        $user = Auth::user();

        /**
         * make username null when not updated
         */
        if ($request->username === $user->username) {
            $request->merge(['username' => null]);
        }

        /**
         * make Validator object for validate request input and retrieve errors message when fail7
         */
        $validator = Validator::make($request->all(), [
            'username' => [
                'bail',
                'required_without_all:password',
                Rule::when($request->username !== null, ['unique:users', 'string', 'max:100'])
            ],
            'password' => [
                'bail',
                'required_without_all:username',
                Rule::when($request->password !== null, ['string', 'max:100'])
            ],
        ]);

        /**
         * if validate fails, return error messages from Validator class errors() function
         */
        if ($validator->fails()) {
            return redirect()
                ->intended($user->level . '/profile')
                ->withErrors($validator->errors(), 'errors')
            ;
        }

        /**
         * update password if form password filled
         */
        if (!empty($request->password)) {
            $user->password = $request->password;
        }
        /**
         * update username if form username change
         */
        if (!empty($request->username)) {
            $user->username = $request->username;
        }

        /**
         * save user updated data to database
         */
        $user->save();

        return redirect()
            ->intended($user->level . '/profile')
            ->withInput(['success' => 'update user data success'])
        ;
    }
}
