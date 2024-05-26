<?php

namespace App\Http\Requests\Kader\Kegiatan;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKegiatanRequest extends FormRequest
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
            'jam_mulai' => Carbon::make($this->input('jam_mulai'))->format('H:i:s'),
        ]);

        $this->request->replace(
            $this->only([
                'nama',
                'tgl_kegiatan',
                'jam_mulai',
                'tempat',
                'kegiatan',
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
                'date_format:H:i:s'
            ],
            'tempat' => [
                'bail',
                'required',
                'string',
                'regex:/^([\w\s\n.]{5,200})$/',
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
        $oldData = json_decode($this->input('kegiatan'), true);

        $this->request->replace($this->only(array_keys(array_diff_assoc($oldData, $this->request->all()))));
    }
}
