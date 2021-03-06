<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PostRequest
 * @package App\Http\Requests\Product
 * @property int id
 * @property string name
 * @property string code
 * @property int quantity
 * @property mixed price
 * @property string desc
 * @property int category_id
 * @property int user_id
 */
class PostRequest extends FormRequest
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
            "name" => "required|string|max:255",
            "code" => "required|string|unique:products|max:255",
            "quantity" => "required|int",
            "price" => "required|int",
            "desc" => "required|string",
            "images" => "required",
            "category_id" => "required|int",
            "user_id" => "required|int",
        ];
    }

    public function messages()
    {
        return parent::messages(); // TODO: Change the autogenerated stub
    }
}
