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
            'tgl_kegiatan' => Carbon::create($this->input('year'), $this->input('month'), $this->input('day'))->format('Y-m-d')
        ]);

        $oldData = json_decode($this->input('kegiatan'), true);

        $this->request->replace(
            $this->only([
                'nama',
                'tgl_kegiatan',
                'jam_mulai',
                'tempat',
            ])
        );

        $this->request->replace($this->only(array_keys(array_diff_assoc($this->request->all(), $oldData))));
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
                'string',
                'max:100',
                'min:5'
            ],
            'tgl_kegiatan' => [
                'bail',
                'date_format:Y-m-d'
            ],
            'jam_mulai' => [
                'bail',
                'date_format:H:i'
            ],
            'tempat' => [
                'bail',
                'string',
                'max:200',
                'min:5'
            ]
        ];
    }
}
