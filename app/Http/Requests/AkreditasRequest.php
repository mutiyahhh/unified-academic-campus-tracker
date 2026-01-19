<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AkreditasRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'university' => 'required|string',
            'level' => 'required|string',
            'region' => 'required|string',
            'sk_number' => 'required|string',
            'sk_year' => 'required|string',
            'rank' => 'required|string',
            'expired' => 'required|date',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */

    public function messages(): array
    {
        return [
            'name.required' => 'Nama prodi harus diisi',
            'name.string' => 'Nama prodi harus berupa string',
            'name.max' => 'Nama prodi maksimal 255 karakter',
            'university.required' => 'Nama universitas harus diisi',
            'university.string' => 'Nama universitas harus berupa string',
            'level.required' => 'Strata pendidikan harus diisi',
            'level.string' => 'Strata pendidikan harus berupa string',
            'region.required' => 'Wilayah harus diisi',
            'region.string' => 'Wilayah harus berupa string',
            'sk_number.required' => 'Nomor SK harus diisi',
            'sk_number.string' => 'Nomor SK harus berupa string',
            'sk_year.required' => 'Tahun SK harus diisi',
            'sk_year.string' => 'Tahun SK harus berupa string',
            'rank.required' => 'Peringkat harus diisi',
            'rank.string' => 'Peringkat harus berupa string',
            'expired.required' => 'Tanggal kadaluarsa harus diisi',
            'expired.date' => 'Tanggal kadaluarsa harus berupa tanggal',
        ];
    }
}
