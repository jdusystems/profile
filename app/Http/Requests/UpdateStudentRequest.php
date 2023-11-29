<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'surname' => ['required' ],
            'given_name' => ['required' ],
            'phone_number' => ['required' , "max:9"],
            'contact_number' => ['required' , "max:9"],
        ];
    }
    public function messages()
    {
        return [
            'surname.required' => "Talaba familiyasini kiritish shart!" ,
            'given_name.required' => "Talaba ismini kiritish shart!" ,
            'phone_number.required' => "Talaba telefon raqamini kiritish shart!" ,
            'contact_number.required' => "Talaba ota-onasi telefon raqamini kiritish shart!" ,
            'phone_number.max' => "Telefon raqam formati noto'g'ri!" ,
            'contact_number.max' => "Telefon raqam formati noto'g'ri!" ,
        ];
    }
}
