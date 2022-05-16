<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validation extends FormRequest
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
            'designation' => 'required|max:255',
            'quantite' => 'required|numeric|min:1',
            'remise_article' => 'required|numeric|min:0',
            'remise_utilisateur' => 'required|numeric|min:0',
        ];
    }
}
