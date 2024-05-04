<?php

namespace App\Http\Requests\Kader\Lansia;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
                'numeric'
            ],
            'gula_darah' => [
                'bail',
                'required',
                'integer'
            ],
            'kolesterol' => [
                'bail',
                'required',
                'integer'
            ],
            'tensi_darah' => [
                'bail',
                'required',
                'integer'
            ],
            'asam_urat' => [
                'bail',
                'required',
                'numeric'
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
