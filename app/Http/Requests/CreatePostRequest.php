<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'text' => 'required',
            'image' => 'required|File::image()->smallerThan(1000)',
            'category_id' => 'required',
        ];

    }
        
    public function messages()
    {
        return [
            'image' => 'tried to upload image that has size small than 1 mb'
        ];
    }

}
