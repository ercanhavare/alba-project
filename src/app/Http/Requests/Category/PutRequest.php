<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PutRequest
 * @package App\Http\Requests\Category
 * @property int id
 * @property string name
 * @property int user_id
 */
class PutRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|unique:categories|max:255",
            "user_id" => "required|min:1"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "A category name is required",
            "name.unique" => "A category name must be unique",
            "user_id:required" => "A user is required"
        ];
    }
}
