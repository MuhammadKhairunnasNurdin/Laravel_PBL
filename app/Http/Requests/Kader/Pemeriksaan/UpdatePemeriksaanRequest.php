<?php

namespace App\Http\Requests\Kader\Pemeriksaan;

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
        $this->merge([
            'kader_id' => auth()->user()->kaders[0]->kader_id,
        ]);

        $oldData = json_decode($this->input('pemeriksaan'), true);

        $this->request->replace($this->only([
            'kader_id',
            'status',
            'berat_badan',
            'tinggi_badan',
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
                'integer',
                'exists:kaders'
            ],
            'status' => [
                'bail',
                'string',
                Rule::in(['sehat', 'sakit'])
            ],
            'berat_badan' => [
                'bail',
                'numeric',
                'regex:/^\d{1,3}(\.\d{1,3})?$/'
            ],
            'tinggi_badan' => [
                'bail',
                'numeric',
                'regex:/^\d{1,3}(\.\d{1,3})?$/'
            ],
        ];
    }
}
