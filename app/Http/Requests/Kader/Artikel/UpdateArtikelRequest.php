<?php

namespace App\Http\Requests\Kader\Artikel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtikelRequest extends FormRequest
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
        $this->merge([
            'tag' => implode(',', $this->input('tag', [])),
            'kader_id' => auth()->user()->kaders[0]->kader_id,
        ]);

        $this->request->replace($this->only([
            'kader_id',
            'judul',
            'isi',
            'tag',
            'foto_artikel',
            'artikel'
        ]));

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kader_id' => [
                'bail',
                'required',
                'integer',
                'exists:kaders,kader_id'
            ],
            'judul' => [
                'bail',
                'required',
                'string',
                'regex:/^([\w\s\n.,!;:?()-]{5,250})$/',
            ],
            'isi' => [
                'bail',
                'required',
                'string',
                'regex:/^[\w\s\n.,!;:?()-]{30,30000}$/',
            ],
            'tag' => [
                'bail',
                'required',
                'string',
                'regex:/^[a-zA-Z\s,_]{1,100}$/',
            ],
            'foto_artikel' => [
                'bail',
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:5048'
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
        $oldData = json_decode($this->input('artikel'), true);
        $this->request->replace($this->only(array_keys(array_diff_assoc($oldData, $this->input()))));

        /**
         * store image in public/artikel directory when user fill foto_artikel input
         */
        $image = $this->file('foto_artikel');
        if (isset($image)) {
            $fileName = $image->hashName();
            $this->merge([
                'foto_artikel' => $fileName
            ]);
            $image->move(public_path('artikel'), $fileName);
        }
    }
}
