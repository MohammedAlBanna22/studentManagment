<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherAddRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name'          => 'required|string|max:255',
            'phone'         => 'required|numeric|digits_between:7,15',
           'date_of_birth' => 'required|date',
           'age'           => 'required|integer|min:18|max:100',
            'gender'        => 'required|in:m,f',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password'      => 'required|min:6|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => 'Name is required',
            'phone.required'         => 'Phone is required',
            'date_of_birth.required' => 'Date of birth is required',
            'gender.required'        => 'Gender is required',
        ];
    }

}
