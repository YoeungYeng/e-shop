<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            "name" => "required",
            "description" => "required",
        ];
    }

    // cast time
    public function messages(): array{
        return [
            "name.required" => "Category name is required",
            "description.required" => "Category description is required",
        ];
    }

    public function attributes(): array{
        return [
            "name" => "Category name",
            "description" => "Category description",

        ];
    }


}
