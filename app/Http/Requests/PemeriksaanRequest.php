<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class PemeriksaanRequest extends FormRequest
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

        if ($this->has(['date', 'month', 'year'])) {
            $this->replace([
                'tgl_pemeriksaan' => Carbon::create($this->input('year'), $this->input('month'), $this->input('date'))->format('Y-m-d')
            ] + $this->except(['year', 'month', 'date']));

        }

        if (!$this->has('golongan')) {
            $routeName = Route::currentRouteName();
            $needles = collect(['bayi', 'lansia']);
            $this->merge([
                'golongan' => $needles->first(function ($needle) use ($routeName) {
                return strpos($routeName, $needle) !== false;
            })]);
        }

        if (!$this->has('kader_id')) {
            $this->merge([
                'kader_id' => DB::table('kaders')
                    ->join('users', 'users.user_id', '=', 'kaders.user_id')
                    ->where('users.user_id', auth()->id())
                    ->value('kaders.kader_id')
            ]);
        }
        if ($this->has(['lingkar_kepala', 'lingkar_lengan', 'asi', 'kenaikan', 'data_kb', '_token'])) {
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
                'kader_id' => [
                    'bail',
                    'required_without_all:NIK,tgl_pemeriksaan,golongan,berat_badan,tinggi_badan,status,respon',
                    'exists:kaders'
                ],
                'NIK' => [
                    'bail',
                    'required_without_all:kader_id,tgl_pemeriksaan,golongan,berat_badan,tinggi_badan,status,respon',
                    'exists:penduduks'
                ],
                'status' => [
                    'bail',
                    'required_without_all:kader_id,NIK,tgl_pemeriksaan,golongan,berat_badan,tinggi_badan,respon',
                    Rule::in(['sehat', 'sakit'])
                ],
                'golongan' => [
                    'bail',
                    'required_without_all:kader_id,NIK,tgl_pemeriksaan,berat_badan,tinggi_badan,status,respon',
                    Rule::in(['lansia', 'bayi'])
                ],
                'tgl_pemeriksaan' => [
                    'bail',
                    'required_without_all:kader_id,NIK,golongan,berat_badan,tinggi_badan,status,respon',
                    'date'
                ],
                'tinggi_badan' => [
                    'bail',
                    'required_without_all:kader_id,NIK,tgl_pemeriksaan,golongan,berat_badan,status,respon',
                    'numeric'
                ],
                'berat_badan' => [
                    'bail',
                    'required_without_all:kader_id,NIK,tgl_pemeriksaan,golongan,tinggi_badan,status,respon',
                    'numeric'
                ],
                'respon' => [
                    'bail',
                    'required_without_all:kader_id,NIK,tgl_pemeriksaan,golongan,berat_badan,tinggi_badan,status',
                    'string'
                ],
            ];
        }

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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'golongan' => $this->input('golongan'),
            'kader_id' => $this->input('kader_id')
        ], 422));
    }
}
