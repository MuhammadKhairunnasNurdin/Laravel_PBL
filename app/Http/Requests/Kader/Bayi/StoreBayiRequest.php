<?php

namespace App\Http\Requests\Kader\Bayi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBayiRequest extends FormRequest
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
                'lingkar_kepala',
                'lingkar_lengan',
                'asi',
                'kenaikan',
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
        ];
    }
}
