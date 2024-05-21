<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePendudukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation
     */
    protected function prepareForValidation(): void
    {
        $this->request->request($this
            ->only([
                'NIK',
                'NKK',
                'nama',
                'tgl_lahir',
                'pendapatan',
                'no_telp',
                'jenis_kelamin',
                'pendidikan',
                'hubungan_keluarga',
                'alamat',
                'RT'
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
            'NIK' => [
                'bail',
                'required',
            ],
            'NKK'=> [
                'bail',
                'required',
            ],
            'nama' => [
                'bail',
                'required',
            ],
            'tgl_lahir' => [
                'bail',
                'required',
            ],
            'pendapatan' => [
                'bail',
                'required',
            ],
            'no_telp' =>[
                'bail',
                'required',
            ],
            'jenis_kelamin' => [
                'bail',
                'required',
                Rule::in(['L', 'P'])
            ],
            'pendidikan' => [
                'bail',
                'required',
                Rule::in(['Tidak Terpelajar', 'SD', 'SMP', 'SMA', 'S1'])
            ],
            'hubungan_keluarga' => [
                'bail',
                'required',
                Rule::in(['Kepala Keluarga', 'Istri', 'Anak'])
            ],
            'alamat' => [
                'bail',
                'required',
            ],
            'RT' => [
                'bail',
                'required',
                Rule::in(['RT 01', 'RT 02', 'RT 03', 'RT 04', 'RT 05', 'RT 06'])
            ]
            
        ];
    }
}