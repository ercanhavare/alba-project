<?php

namespace App\Http\Requests\Basket;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PutRequest
 * @package App\Http\Requests\Basket
 * @property int product_id
 * @property int user_id
 * @property mixed quantity
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
