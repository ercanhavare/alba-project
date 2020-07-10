<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PutRequest
 * @package App\Http\Requests\Image
 * @property int id
 * @property string name
 * @property string path
 * @property int product_id
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
