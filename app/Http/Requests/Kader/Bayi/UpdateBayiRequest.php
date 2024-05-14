<?php

namespace App\Http\Requests\Kader\Bayi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBayiRequest extends FormRequest
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
        $oldData = json_decode($this->input('pemeriksaan_bayi'), true);

        $this->request->replace($this->only([
                'lingkar_kepala',
                'lingkar_lengan',
                'asi',
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
            'lingkar_kepala' => [
                'bail',
                'regex' => '/^\d{1,3}(\.\d{1,3})?$/'
            ],
            'lingkar_lengan' => [
                'bail',
                'regex' => '/^\d{1,3}(\.\d{1,3})?$/'
            ],
            'asi' => [
                'bail',
                Rule::in(['iya', 'tidak'])
            ],
        ];
    }
}
