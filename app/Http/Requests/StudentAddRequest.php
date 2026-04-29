<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentAddRequest extends FormRequest
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
           $studentId = $this->route('id') ?? $this->input('id');

    $emailRule = 'required|email|unique:students,email';
// it usr for make same valdite to creat and update
    // If it's an update request, ignore current student
    if ($this->isMethod('post') && $studentId) {
        $emailRule = 'required|email|unique:students,email,' . $studentId;
    }

        return [
            //
        'name'=> 'required|string|max:255',
        'email'=> 'required|email|unique:students,email',
        'age'=>'required|integer|min:1|max:100',
        'date_of_birth'=>'required|date',
        'gender'=>'required|in:m,f',
        'score'=>'required|integer|min:0|max:100',
        'image'=> 'nullable|image|mimes:png,jpg,gif|max:2048',
        ];
    }
    public function messages(){
        return [
    'name.required'=>'please write Student Name',
    'age.max'=> 'student cannot be older than 100',

        ];
    }
}
