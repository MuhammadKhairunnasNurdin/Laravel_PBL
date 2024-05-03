<?php

namespace App\Http\Requests\Kader\Pemeriksaan;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
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
        $routeName = Route::currentRouteName();
        $needles = collect(['bayi', 'lansia']);
        $this->merge([
            'golongan' => $needles->first(function ($needle) use ($routeName) {
                    return str_contains($routeName, $needle);
                }),
            'kader_id' => auth()->user()->kaders[0]->kader_id,
            'tgl_pemeriksaan' => Carbon::create($this->input('year'), $this->input('month'), $this->input('day'))->format('Y-m-d')
        ]);

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
                'exists:kaders'
            ],
            'NIK' => [
                'bail',
                'required',
                'exists:penduduks'
            ],
            'status' => [
                'bail',
                'required',
                Rule::in(['sehat', 'sakit'])
            ],
            'golongan' => [
                'bail',
                'required',
                Rule::in(['lansia', 'bayi'])
            ],
            'tgl_pemeriksaan' => [
                'bail',
                'required',
                'date'
            ],
            'tinggi_badan' => [
                'bail',
                'required',
                'numeric'
            ],
            'berat_badan' => [
                'bail',
                'required',
                'numeric'
            ],
            'respon' => [
                'bail',
                'required',
                'string'
            ],
        ];
    }
}
