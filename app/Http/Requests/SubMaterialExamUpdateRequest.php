<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SubMaterialExamUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:150',
            'sub_material_id' => ['required', Rule::exists('sub_materials', 'id')],
            'total_multiple_choice' => 'required|integer',
            'total_essay' => 'required|integer',
            'multiple_choice_value' => 'required|integer',
            'essay_value' => 'required|integer',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after_or_equal:start_at',
            'time' => 'required|regex:/^[0-9]*$/',
            'last_submit' => 'nullable|boolean',
            'cheating_detector' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'title.required' => 'Judul diperlukan.',
            'title.max' => 'Judul tidak boleh lebih dari 150 karakter.',
            'sub_material_id.required' => 'ID materi pembelajaran diperlukan.',
            'sub_material_id.exists' => 'ID materi pembelajaran tidak valid.',
            'total_multiple_choice.required' => 'Total soal pilihan ganda diperlukan.',
            'total_multiple_choice.integer' => 'Total soal pilihan ganda harus berupa angka.',
            'total_essay.required' => 'Total soal esai diperlukan.',
            'total_essay.integer' => 'Total soal esai harus berupa angka.',
            'multiple_choice_value.required' => 'Nilai untuk soal pilihan ganda diperlukan.',
            'multiple_choice_value.integer' => 'Nilai untuk soal pilihan ganda harus berupa angka.',
            'essay_value.required' => 'Nilai untuk soal esai diperlukan.',
            'essay_value.integer' => 'Nilai untuk soal esai harus berupa angka.',
            'start_at.required' => 'Waktu mulai diperlukan.',
            'start_at.date' => 'Waktu mulai harus berupa tanggal yang valid.',
            'end_at.required' => 'Waktu selesai diperlukan.',
            'end_at.date' => 'Waktu selesai harus berupa tanggal yang valid.',
            'end_at.after_or_equal' => 'Waktu selesai harus sama atau setelah waktu mulai.',
            'time.required' => 'Waktu pengerjaan diperlukan.',
            'time.regex' => 'Waktu pengerjaan harus berupa angka.',
            'last_submit.boolean' => 'Status pengiriman terakhir harus berupa benar atau salah.',
            'cheating_detector.boolean' => 'Detektor kecurangan harus berupa benar atau salah.',
        ];
    }
}
