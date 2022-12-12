<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        if (request()->isMethod('post')) {
            return [
                "name" => "required|max:50",
                "description" => "required|max:250",
                "image" => "required|max:5048",
                "type" => "required|should be 1, 2 or 3"
            ];
        } else {
            return [
                "name" => "required|max:50",
                "description" => "required|max:250",
                "image" => "required|max:5000",
                "type" => "required|should be 1, 2 or 3"
            ];
        }
    }
}
