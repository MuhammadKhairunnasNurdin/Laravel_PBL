<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
        $this->request->replace($this
            ->only([
                'username',
                'password',
                'password_confirmation',
                'level',
                'foto_profil'
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
                'unique:users,username'
            ],
            'password' => [
                'bail',
                'required',
                'string',
                /**
                 * at least 8 characters
                 * must contain at least 1 uppercase letter, 1 lowercase letter, and 1 number
                 * Can contain special characters
                 */
                'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,100}$/',
                'confirmed'
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
                'required',
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
        $this->request->replace(
            $this->only([
                'username',
                'password',
                'level',
                'foto_profil'
            ])
        );

        $image = $this->file('foto_profil');
        $fileName = $image->hashName();

        Storage::disk('user_img')->put($fileName, file_get_contents($image));

        $this->merge([
            'foto_profil' => $fileName
        ]);
    }
}
