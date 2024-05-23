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
        $this->request->replace(
            $this->only([
                'lingkar_kepala',
                'lingkar_lengan',
                'asi',
                'pemeriksaan_bayi'
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
                'numeric',
                'regex:/^\d{1,3}(\.\d{1,3})?$/'
            ],
            'lingkar_lengan' => [
                'bail',
                'required',
                'numeric',
                'regex:/^\d{1,3}(\.\d{1,3})?$/'
            ],
            'asi' => [
                'bail',
                'required',
                'string',
                Rule::in(['iya', 'tidak'])
            ],
        ];
    }
    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation(): void
    {
        /**
         * compare updated data from user form with old data in
         * database and just replace request input with data that
         * changes
         */
        $oldData = json_decode($this->input('pemeriksaan_bayi'), true);

        $this->request->replace($this->only(array_keys(array_diff_assoc($oldData, $this->request->all()))));
    }
}
