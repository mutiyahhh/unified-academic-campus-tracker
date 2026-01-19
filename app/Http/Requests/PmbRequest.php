<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PmbRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'prodi' => 'required|string',
            'year' => 'required|integer',
            'number_of_registrants' => 'required|integer',
            'quota_accepted' => 'required|integer',
            're_registration' => 'required|integer',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            'prodi.required' => 'Program Studi tidak boleh kosong',
            'prodi.string' => 'Program Studi harus berupa string',
            'year.required' => 'Tahun tidak boleh kosong',
            'year.integer' => 'Tahun harus berupa integer',
            'number_of_registrants.required' => 'Jumlah Pendaftar tidak boleh kosong',
            'number_of_registrants.integer' => 'Jumlah Pendaftar harus berupa integer',
            'quota_accepted.required' => 'Kuota Diterima tidak boleh kosong',
            'quota_accepted.integer' => 'Kuota Diterima harus berupa integer',
            're_registration.required' => 'Pendaftar Ulang tidak boleh kosong',
            're_registration.integer' => 'Pendaftar Ulang harus berupa integer',
        ];
    }
}
