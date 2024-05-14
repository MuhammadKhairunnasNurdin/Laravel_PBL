<?php

namespace App\Http\Requests\Kader\Pemeriksaan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePemeriksaanRequest extends FormRequest
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

        $this->request->replace($this->only([
            'golongan',
            'kader_id',
            'penduduk_id',
            'berat_badan',
            'tinggi_badan',
            /*'status',*/
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
                'exists:kaders'
            ],
            'penduduk_id' => [
                'bail',
                'required',
                'integer',
                'exists:penduduks'
            ],
            /*'status' => [
                'bail',
                'required',
                Rule::in(['sehat', 'sakit'])
            ],*/
            'golongan' => [
                'bail',
                'required',
                'string',
                Rule::in(['lansia', 'baduta', 'batita', 'balita'])
            ],
            'tinggi_badan' => [
                'bail',
                'required',
                'numeric',
                'regex' => '/^\d{1,3}(\.\d{1,3})?$/'
            ],
            'berat_badan' => [
                'bail',
                'required',
                'numeric',
                'regex' => '/^\d{1,3}(\.\d{1,3})?$/'
            ],
        ];
    }
}
