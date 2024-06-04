<?php

namespace App\Http\Requests\Admin\User;

use App\Services\ImageLogic;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->request->replace(
            $this->only([
                'username',
                'password',
                'password_confirmation',
                'level',
                'foto_profil',
                'user'
            ])
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => [
                'bail',
                'required',
                'string',
                /**
                 * Must start with an alphabetic character.
                 * Can contain the following characters: a-z, A-Z, 0-9, -, and _
                 */
                'regex:/^[a-zA-z][a-zA-Z0-9-_]{3,100}$/',
                'unique:users,username,' . $this->route('user') . ',user_id'
            ],
            'password' => [
                'bail',
                'nullable',
                'present_with:password_confirmation',
                'string',
                /**
                 * at least 8 characters
                 * must contain at least 1 uppercase letter, 1 lowercase letter, and 1 number
                 * Can contain special characters
                 */
                'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,100}$/'
            ],
            'level' => [
                'bail',
                'required',
                'string',
                Rule::in(['kader', 'ketua', 'admin']),
                function ($attribute, $value, $fail) {
                    if ($value === 'ketua' and DB::table('users')->where('level', $value)->exists()) {
                        $fail('Ketua maksimal 1 dan sudah ada datanya!');
                    }
                }
            ],
            'foto_profil' => [
                'bail',
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:700'
            ]
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation(): void
    {
        /**
         * compare updated data from user form with old data in
         * database and just replace request input with data that
         * changes
         */
        $oldData = decrypt(json_decode($this->input('user'), true));
        /**
         * fill old data with null, to compare if password is null in form, we not replace only that field
         */
        $oldData['password'] = null;
        $this->request->replace($this->only(array_keys(array_diff_assoc($oldData, $this->input()))));

        /**
         * store image in public/user directory when user fill foto_profil input
         */
        $image = $this->file('foto_profil');

        if (isset($image)) {
            $this->merge([
                'foto_profil' => ImageLogic::upload($image, 'user_img')
            ]);
        }
    }
}
