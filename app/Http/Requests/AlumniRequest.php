<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumniRequest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'required|string',
            'gender' => 'required|string',
            'birth_place' => 'required|string',
            'birth_date' => 'required|string',
            'religion' => 'required|string',
            'blood_type' => 'required|string',
            'nim' => 'required|string',
            'prodi' => 'required|string',
            'entry_year' => 'required|string',
            'graduation_year' => 'required|string',
            'work_status' => 'required|string',
            'work_waiting_time' => 'required|string',
            'institution_name' => 'required|string',
            'job_according_major' => 'required|string',
        ];
    }
}
