<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleValidationRequest extends FormRequest
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
            'categorie' => 'required',
            'code' => 'required|max:255',
            'designation' => 'required|max:255',
            'status' => 'required',
            'pv' => 'required|numeric|min:0',
            'pa' => 'required|numeric|min:0',
            'uv' => 'required|numeric|min:0',
            'ua' => 'required|numeric|min:0',
        ];
    }
}
