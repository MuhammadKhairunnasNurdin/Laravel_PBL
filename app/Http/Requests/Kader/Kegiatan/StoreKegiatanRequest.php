<?php

namespace App\Http\Requests\Kader\Kegiatan;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreKegiatanRequest extends FormRequest
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
            'kader_id' => auth()->user()->kaders[0]->kader_id,
        ]);

        $this->request->replace(
            $this->only([
                'kader_id',
                'nama',
                'tgl_kegiatan',
                'jam_mulai',
                'tempat'
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
            'kader_id' => [
                'bail',
                'required',
                'integer',
                'exists:kaders',
            ],
            'nama' => [
                'bail',
                'required',
                'string',
                'regex:/^[a-zA-Z\s.]{5,100}$/',
            ],
            'tgl_kegiatan' => [
                'bail',
                'required',
                'date_format:Y-m-d'
            ],
            'jam_mulai' => [
                'bail',
                'required',
                'date_format:H:i'
            ],
            'tempat' => [
                'bail',
                'required',
                'string',
                'regex:/^([\w\s\n.]{5,200})$/',
            ]
        ];
    }
}
