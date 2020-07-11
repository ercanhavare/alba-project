<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PostRequest
 * @package App\Http\Requests\User
 * @property int id
 * @property string name
 * @property string surname
 * @property string email
 * @property int mobile
 * @property mixed password
 * @property int role_id
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
            "surname" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "mobile" => "required|string|max:255",
            "role_id" => "nullable|int",
            "password" => "required|string|min:8|confirmed",
        ];
    }

    public function messages()
    {
        return parent::messages(); // TODO: Change the autogenerated stub
    }
}
