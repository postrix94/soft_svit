<?php

namespace App\Http\Requests\Mail;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
{
    /**
     * Indicates whether validation should stop after the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

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
            "from" => ["email", "max:50"],
            "to" => ["email", "max:50"],
            "cc" => ["nullable", "email", "max:50"],
            "subject" => ["required", "max:255"],
            "type_list" => ["required", "in:text,html"],
            "body_list" => ["required", "max:50000"],
        ];
    }

    public function messages()
    {
        return [
            "from.email" => "Ви невірно ввели email",
            "from.max" => "Максимальна довжина 50 символів",
            "to.email" => "Ви невірно ввели email",
            "to.max" => "Максимальна довжина 50 символів",
            "cc.email" => "Ви невірно ввели email",
            "cc.max" => "Максимальна довжина 50 символів",
            "subject.required" => "Поле обов`язкове",
            "subject.max" => "Максимальна довжина 255 символів",
            "body_list.required" => "Поле обов`язкове",
            "body_list.max" => "Максимальна довжина 5000 символів",
        ];
    }
}
