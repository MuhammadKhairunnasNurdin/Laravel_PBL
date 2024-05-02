<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePemeriksaanRequest extends FormRequest
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
        $this->replace([
                'tgl_pemeriksaan' => Carbon::create($this->input('year'), $this->input('month'), $this->input('day'))->format('Y-m-d')
            ] + $this->except(['year', 'month', 'day']));

        $oldData = json_decode($this->input('pemeriksaan'), true);

        $this->request->replace($this->only([
            'tgl_pemeriksaan',
            'golongan',
            'kader_id',
            'NIK',
            'berat_badan',
            'tinggi_badan',
            'status',
            'respon',
        ]));

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
            'kader_id' => [
                'bail',
                'exists:kaders'
            ],
            'NIK' => [
                'bail',
                'exists:penduduks'
            ],
            'status' => [
                'bail',
                Rule::in(['sehat', 'sakit'])
            ],
            'golongan' => [
                'bail',
                Rule::in(['lansia', 'bayi'])
            ],
            'tgl_pemeriksaan' => [
                'bail',
                'date'
            ],
            'tinggi_badan' => [
                'bail',
                'numeric'
            ],
            'berat_badan' => [
                'bail',
                'numeric'
            ],
            'respon' => [
                'bail',
                'string'
            ],
        ];
    }
}
