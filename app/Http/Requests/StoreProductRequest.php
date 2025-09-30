<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize (): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules (): array
    {
        return [
            "name" => "required|string|min:3|max:255",
            "category_id" => "required|integer|exists:categories,id",
            "origin_price" => "required|numeric|min:0",
            "sale_price" => "required|numeric|min:0",
            "quantity" => "required|integer|min:0",
            "description" => "string|nullable",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",

        ];
    }

    // upload image for news
    public function uploadNews ($image): ?string
    {
        if ($image && $image->isValid ()) {
            // Generate a unique filename
            $filename = Str::uuid () . '.' . $image->getClientOriginalExtension ();

            // Read and crop/resize the image using Intervention
            $processedImage = Image::read ($image)
                ->cover (300, 350) // Resize to 300x300 pixels
                // ->crop(300, 300, 50, 50) // Or optionally crop
                ->encodeByExtension ($image->getClientOriginalExtension (), quality: 80);

            // Save to public disk
            Storage::disk ('public')->put ("images/{$filename}", $processedImage);

            // Return the public URL
            return asset ("storage/images/{$filename}");
        }

        return null;
    }

    public function messages ()
    {
        return [
            'title.required' => 'The category title is required.',
            'content.max' => 'The content may not be greater than 1000 characters.',
            'author.required' => 'The author field is required.',
            'slug.in' => 'The selected slug is invalid. Please choose either active or inactive.',
        ];
    }

//    // artribute
//    public function attributes ()
//    {
//        return [
//            'name' => 'category name',
//            'content' => 'category content',
//            'slug' => 'category slug',
//            'cateogory id' => "category must be exist"
//
//        ];
//    }


    protected function failedValidation (\Illuminate\Contracts\Validation\Validator $validator)
    {
        // Redirect back with errors and old input
        throw new \Illuminate\Validation\ValidationException(
            $validator,
            redirect ()
                ->back ()
                ->withErrors ($validator)
                ->withInput ()
        );
    }
}
