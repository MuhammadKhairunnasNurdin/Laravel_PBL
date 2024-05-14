<?php

namespace App\Http\Requests\Kader\Pemeriksaan;

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
        ]);

        $this->request->replace($this->only([
            'kader_id',
            'penduduk_id',
            'golongan',
            'status',
            'tinggi_badan',
            'berat_badan',
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
            'status' => [
                'bail',
                'required',
                Rule::in(['sehat', 'sakit'])
            ],
            'golongan' => [
                'bail',
                'required',
                'string',
                Rule::in(['lansia', 'bayi'])
            ],
            'tinggi_badan' => [
                'bail',
                'required',
                'numeric',
                'regex:/^\d{1,3}(\.\d{1,3})?$/'
            ],
            'berat_badan' => [
                'bail',
                'required',
                'numeric',
                'regex:/^\d{1,3}(\.\d{1,3})?$/'
            ],
        ];
    }
}
