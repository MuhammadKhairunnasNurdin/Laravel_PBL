<?php

namespace App\Http\Requests\Kader\Lansia;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateLansiaRequest extends FormRequest
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

        $oldData = json_decode($this->input('pemeriksaan_lansia'), true);

        $this->request->replace($this->only([
                'lingkar_perut',
                'gula_darah',
                'kolesterol',
                'tensi_darah',
                'asam_urat'
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
            'lingkar_perut' => [
                'bail',
                'numeric',
                'regex' => '/^\d{1,3}(\.\d{1,3})?$/'
            ],
            'gula_darah' => [
                'bail',
                'integer'
            ],
            'kolesterol' => [
                'bail',
                'integer'
            ],
            'tensi_darah' => [
                'bail',
                'integer'
            ],
            'asam_urat' => [
                'bail',
                'numeric',
                'regex' => '/^\d{1,2}(\.\d{1,3})?$/'
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
