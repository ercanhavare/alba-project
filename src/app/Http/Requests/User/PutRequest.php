<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PutRequest
 * @package App\Http\Requests\User
 * @property int id
 * @property string name
 * @property string surname
 * @property string email
 * @property int mobile
 * @property mixed password
 * @property int role_id
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
            //
        ];
    }
}
