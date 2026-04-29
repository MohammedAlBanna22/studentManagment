<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

    $studentId = $this->route('id') ?? $this->input('id');

    return [
        'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
        'email' => 'required|email|unique:students,email,' . $studentId,
        'age' => 'required|integer|min:1|max:100',
        'date_of_birth' => 'required|date',
        'gender' => 'required|in:m,f',
        'score' => 'required|integer|min:0|max:100',
    ];

    }
    public function messages(){
    return [
        'name.required' => 'please write Student Name',
        'age.max' => 'student cannot be older than 100',
    ];
    }
}