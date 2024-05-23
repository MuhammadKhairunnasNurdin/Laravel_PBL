<?php

namespace App\Http\Requests\Kader\Lansia;

use Illuminate\Foundation\Http\FormRequest;

class StoreLansiaRequest extends FormRequest
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
        $this->request->replace($this
            ->only([
                'lingkar_perut',
                'gula_darah',
                'kolesterol',
                'tensi_darah',
                'asam_urat'
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
            'lingkar_perut' => [
                'bail',
                'required',
                'numeric',
                'regex:/^\d{1,3}(\.\d{1,3})?$/'
            ],
            'gula_darah' => [
                'bail',
                'required',
                'integer',
                'regex:/^\d{1,3}$/'
            ],
            'kolesterol' => [
                'bail',
                'required',
                'integer',
                'regex:/^\d{1,3}$/'
            ],
            'tensi_darah' => [
                'bail',
                'required',
                'integer',
                'regex:/^\d{1,3}$/'
            ],
            'asam_urat' => [
                'bail',
                'required',
                'numeric',
                'regex:/^\d{1,2}(\.\d{1,3})?$/'
            ],
        ];
    }
}
