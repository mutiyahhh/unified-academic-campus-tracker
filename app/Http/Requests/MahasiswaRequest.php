<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
        $rules = [
            'prodi' => 'required',
            'nim' => 'required|string|max:255',
            'nik' => 'required|string|size:16|regex:/^[0-9]+$/',
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'religion' => 'required|string|max:255',
            'phone_number' => 'required',
            'gender' => 'required',
            'blood_type' => 'required',
            'mothers_name' => 'required|string|max:255',
            'fathers_name' => 'required|string|max:255',
            'generation' => 'required|integer|digits:4|min:1900|max:2099',
            'lecturer' => 'required|string|max:255',
            'gpa' => 'required|numeric|min:1.00|max:4.00|regex:/^[1-4](\.\d{1,2})?$/',
            'status' => 'required|string|max:255',
            'prakerin_status' => 'required|string|max:255',
        ];
        
        // Conditional validation based on status
        $status = request()->input('status');
        
        // Only require seminar_status and meeting_status when status is "aktif"
        if ($status === 'aktif') {
            $rules['seminar_status'] = 'nullable|string|max:255';
            $rules['meeting_status'] = 'nullable|string|max:255';
        } else {
            // For other statuses, these fields are optional but will be auto-filled
            $rules['seminar_status'] = 'nullable|string|max:255';
            $rules['meeting_status'] = 'nullable|string|max:255';
        }
        
        // Add conditional validation for alumni fields when status is "lulus" or when meeting_status is "sudah terlaksana"
        if ($status === 'lulus' || (request()->input('meeting_status') === 'sudah terlaksana' && $status === 'aktif')) {
            $rules['work_status'] = 'required|string|in:tidak bekerja,belum bekerja,bekerja';
            $rules['work_waiting_time'] = 'nullable|string|max:255';
            
            // Only require institution_name and job_according_major when work_status is "bekerja"
            if (request()->input('work_status') === 'bekerja') {
                $rules['institution_name'] = 'required|string|max:255';
                $rules['job_according_major'] = 'required|string|in:ya,tidak';
            } else {
                $rules['institution_name'] = 'nullable|string|max:255';
                $rules['job_according_major'] = 'nullable|string|in:ya,tidak';
            }
        }
        
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     */

    public function messages(): array
    {
        return [
            'prodi.required' => 'Nama prodi harus diisi',
            'nim.required' => 'NIM harus diisi',
            'nim.string' => 'NIM harus berupa string',
            'nim.max' => 'NIM maksimal 255 karakter',
            'nik.required' => 'NIK harus diisi',
            'nik.string' => 'NIK harus berupa string',
            'nik.size' => 'NIK harus tepat 16 karakter',
            'nik.regex' => 'NIK harus berupa angka',
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama maksimal 255 karakter',
            'birth_place.required' => 'Tempat lahir harus diisi',
            'birth_place.string' => 'Tempat lahir harus berupa string',
            'birth_place.max' => 'Tempat lahir maksimal 255 karakter',
            'birth_date.required' => 'Tanggal lahir harus diisi',
            'birth_date.date' => 'Tanggal lahir harus berupa tanggal',
            'address.required' => 'Alamat harus diisi',
            'address.string' => 'Alamat harus berupa string',
            'religion.required' => 'Agama harus diisi',
            'religion.string' => 'Agama harus berupa string',
            'religion.max' => 'Agama maksimal 255 karakter',
            'phone_number.required' => 'Nomor telepon harus diisi',
            'gender.required' => 'Jenis kelamin harus diisi',
            'blood_type.required' => 'Golongan darah harus diisi',
            'mothers_name.required' => 'Nama ibu harus diisi',
            'mothers_name.string' => 'Nama ibu harus berupa string',
            'mothers_name.max' => 'Nama ibu maksimal 255 karakter',
            'fathers_name.required' => 'Nama ayah harus diisi',
            'fathers_name.string' => 'Nama ayah harus berupa string',
            'fathers_name.max' => 'Nama ayah maksimal 255 karakter',
            'generation.required' => 'Angkatan harus diisi',
            'generation.integer' => 'Angkatan harus berupa angka',
            'generation.digits' => 'Angkatan harus berupa 4 digit tahun (contoh: 2020)',
            'generation.min' => 'Angkatan minimal tahun 1900',
            'generation.max' => 'Angkatan maksimal tahun 2099',
            'lecturer.required' => 'Dosen harus diisi',
            'lecturer.string' => 'Dosen harus berupa string',
            'lecturer.max' => 'Dosen maksimal 255 karakter',
            'gpa.required' => 'IPK harus diisi',
            'gpa.numeric' => 'IPK harus berupa angka',
            'gpa.min' => 'IPK minimal 1.00',
            'gpa.max' => 'IPK maksimal 4.00',
            'gpa.regex' => 'IPK harus dalam format 1 digit (1-4) diikuti titik dan 2 digit desimal (contoh: 3.75)',
            'status.required' => 'Status harus diisi',
            'status.string' => 'Status harus berupa string',
            'status.max' => 'Status maksimal 255 karakter',
            'prakerin_status.required' => 'Status prakerin harus diisi',
            'prakerin_status.string' => 'Status prakerin harus berupa string',
            'prakerin_status.max' => 'Status prakerin maksimal 255 karakter',
            'seminar_status.required' => 'Status seminar harus diisi',
            'seminar_status.string' => 'Status seminar harus berupa string',
            'seminar_status.max' => 'Status seminar maksimal 255 karakter',
            'meeting_status.required' => 'Status meeting harus diisi',
            'meeting_status.string' => 'Status meeting harus berupa string',
            'meeting_status.max' => 'Status meeting maksimal 255 karakter',
        ];
    }
}
