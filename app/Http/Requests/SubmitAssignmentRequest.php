<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Http\Requests\SubmitAssignmentRequest;

class SubmitAssignmentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'link' => 'nullable|url',
            'assignment_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'url' => 'Link harus berupa url penyimpanan tugas anda'
        ];
    }
}
