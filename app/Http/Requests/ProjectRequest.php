<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'deadline' => 'required|date|after_or_equal:now',
            'photo' => 'mimes:png,jpg,jpeg|max:2048|nullable',
        ];
    }
}
