<?php

namespace App\Http\Requests\Admin\Penduduk;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdatePendudukRequest extends FormRequest
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
        $this->request->replace($this
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
                'RT',
                'penduduk',
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
                'string',
                'regex:/^\w{1,20}$/',
                'unique:penduduks,NIK, '.$this->route('penduduk').',penduduk_id',
            ],
            'NKK'=> [
                'bail',
                'required',
                'string',
                'regex:/^\w{1,20}$/',
            ],
            'nama' => [
                'bail',
                'required',
                'string',
                'regex:/^[a-zA-Z\s.]{1,100}$/',
            ],
            'tgl_lahir' => [
                'bail',
                'required',
                'date_format:Y-m-d'
            ],
            'pendapatan' => [
                'bail',
                'required',
                Rule::in(['Belum Bekerja', 'Rp 0 - Rp 500.000', 'Rp 500.000 - Rp 1.000.000', 'Rp 1.000.000 - Rp 2.000.000', 'Rp 2.000.000 - Rp 3.000.000', 'Rp 3.000.000 - keatas'])
            ],
            'no_telp' =>[
                'bail',
                'nullable',
                'string',
                'regex:/^\w{0,14}$/',
            ],
            'jenis_kelamin' => [
                'bail',
                'required',
                Rule::in(['L', 'P'])
            ],
            'pendidikan' => [
                'bail',
                'required',
                Rule::in(['Belum Sekolah', 'Tidak Terpelajar', 'SD', 'SMP', 'SMA', 'D4/S1', 'S2 Keatas'])
            ],
            'hubungan_keluarga' => [
                'bail',
                'required',
                Rule::in(['Kepala Keluarga', 'Istri', 'Anak'])
            ],
            'alamat' => [
                'bail',
                'required',
                'string',
                'regex:/^([\w\s\n.]{1,200})$/',
            ],
            'RT' => [
                'bail',
                'required',
                Rule::in(['RT 01', 'RT 02', 'RT 03', 'RT 04', 'RT 05', 'RT 06'])
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
        $oldData = json_decode($this->input('penduduk'), true);

        $this->request->replace($this->only(array_keys(array_diff_assoc($oldData, $this->request->all()))));
    }

}
