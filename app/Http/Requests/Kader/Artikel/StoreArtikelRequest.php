<?php

namespace App\Http\Requests\Kader\Artikel;

use Illuminate\Foundation\Http\FormRequest;

class StoreArtikelRequest extends FormRequest
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
        ]));

    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation(): void
    {
        $image = $this->file('foto_artikel');
        $fileName = $image->hashName();
        $image->move(public_path('artikel'), $fileName);
        $this->merge([
            'foto_artikel' => $fileName
        ]);
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
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:5048'
            ]
        ];
    }
}
