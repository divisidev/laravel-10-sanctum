<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'   => 'required|min:3|max:255',
            'content' => 'required|min:3',
            'cover'   => 'image|mimes:jpg,jpeg,png|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'   => 'Title is required',
            'title.min'        => 'Title must be at least 3 characters',
            'title.max'        => 'Title may not be greater than 255 characters',
            'content.required' => 'Content is required',
            'content.min'      => 'Content must be at least 3 characters',
            'cover.image'      => 'Cover must be an image',
            'cover.mimes'      => 'Cover must be a file of type: jpg, jpeg, png',
            'cover.max'        => 'Cover may not be greater than 2048 kilobytes'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data'    => $validator->errors()
        ], 422));
    }
}
