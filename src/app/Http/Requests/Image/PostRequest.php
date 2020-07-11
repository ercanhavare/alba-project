<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PostRequest
 * @package App\Http\Requests\Image
 * @property int id
 * @property string name
 * @property string path
 * @property int product_id
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
            "image" => "file|size:512",
        ];
    }
}
