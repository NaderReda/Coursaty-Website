<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTraningCourse extends FormRequest
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
            'courseID'=>'required',
            'price'=> 'required',
            'start_date'=>'required|before:end_date',
            'end_date'=>'required|after:start_date',
        ];
    }

    public function messages(): array
    {
        return [
            'courseID.required'=>'اسم الكورس مطلوب',
            'price.required'=>'سعر الكورس مطلوب',
            'start_date.required'=>'تاريخ البداية مطلوب',
            'start_date.before'=>'تاريخ البداية يجب أن يكون اقل من تاريخ النهاية',
            'end_date.required'=>'تاريخ النهاية مطلوب',
            'end_date.after'=>'تاريخ النهاية يجب أن يكون اكبر من تاريخ البداية',
        ];
    }
    
}
