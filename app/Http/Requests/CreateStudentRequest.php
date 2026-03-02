<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
            
            'name'=> 'required',
            'country_id'=>'required',
            'phone'=>'required',
            'nationalID'=>'required',
            'active'=> 'required',
            
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'اسم الطالب مطلوب',
            'country_id.required'=>'اسم الدولة مطلوب',
            'phone.required'=>'رقم الهاتف مطلوب',
            'nationalID.required'=>'الرقم القومي مطلوب',
            'active.required'=>'حالة الطالب مطلوبة',
        ];
    }
}
