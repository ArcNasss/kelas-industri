<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Enums\SubMaterialExamTypeEnum;

class SubMaterialRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = [
            'material_id' => 'required',
            'title' => 'required|string',
            'description' => 'required',
            'teacher_file' => 'required|file|mimes:pdf',
            'student_file' => 'required|file|mimes:pdf',
            'total_multiple_choice' => 'required|integer',
            'total_essay' => 'required|integer',
            'type' => ['required', Rule::in([SubMaterialExamTypeEnum::REGISTER->value, SubMaterialExamTypeEnum::QUIZ->value])],
            'multiple_choice_value' => 'required|integer',
            'essay_value' => 'required|integer',
            'time' => 'required|regex:/^[0-9]*$/',
            'last_submit' => 'nullable|boolean',
            'cheating_detector' => 'nullable|boolean',
        ];

        if (request()->routeIs('admin.subMaterials.update')) {
            $rules['teacher_file'] = 'file|mimes:pdf';
            $rules['student_file'] = 'file|mimes:pdf';
        }

        return $rules;
    }

    /**
     * custome messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'material_id.required' => 'Materi tidak boleh kosong !',
            'title.required' => 'Judul tidak boleh kosong !',
            'title.string' => 'Judul harus berupa string !',
            'description.required' => 'Deskripsi tidak boleh kosong !',
            'teacher_file.required' => 'File guru tidak boleh kosong !',
            'teacher_file.file' => 'File guru harus berupa file !',
            'teacher_file.mimes' => 'File guru harus berupa pdf !',
            'student_file.required' => 'File siswa tidak boleh kosong !',
            'student_file.file' => 'File siswa harus berupa file !',
            'student_file.mimes' => 'File siswa harus berupa pdf !',
        ];
    }
}
