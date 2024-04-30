<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class BayiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has(['date', 'month', 'year', 'berat_badan', 'tinggi_badan', 'respon', 'status', 'NIK', '_token'])) {
            $this->request->replace($this
                ->only([
                    'lingkar_kepala',
                    'lingkar_lengan',
                    'asi',
                    'kenaikan',
                    'data_kb'
                ])
            );
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (in_array($this->getMethod(), ['PUT', 'PATCH'])) {
            return [
                'lingkar_kepala' => [
                    'bail',
                    'required_without_all:lingkar_lengan,asi,kenaikan,data_kb',
                    'numeric'
                ],
                'lingkar_lengan' => [
                    'bail',
                    'required_without_all:lingkar_kepala,asi,kenaikan,data_kb',
                    'numeric'
                ],
                'asi' => [
                    'bail',
                    'required_without_all:lingkar_kepala,lingkar_lengan,kenaikan,data_kb',
                    Rule::in(['iya', 'tidak'])
                ],
                'kenaikan' => [
                    'bail',
                    'required_without_all:lingkar_kepala,lingkar_lengan,asi,data_kb',
                    Rule::in(['iya', 'tidak'])
                ],
                'data_kb' => [
                    'bail',
                    'required_without_all:lingkar_kepala,lingkar_lengan,asi,kenaikan',
                    'string',
                    'max:50'
                ],
            ];
        }
        return [
            'lingkar_kepala' => [
                'bail',
                'required',
                'numeric'
            ],
            'lingkar_lengan' => [
                'bail',
                'required',
                'numeric'
            ],
            'asi' => [
                'bail',
                'required',
                Rule::in(['iya', 'tidak'])
            ],
            'kenaikan' => [
                'bail',
                'required',
                Rule::in(['iya', 'tidak'])
            ],
            'data_kb' => [
                'bail',
                'required',
                'string',
                'max:50'
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
