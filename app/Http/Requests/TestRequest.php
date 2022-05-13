<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
            'famille' => 'required',
            'categorie' => 'required',
            'status' => 'required',
            'if' => 'required',
            'ice' => 'required|integer|digits:15',
            'rc' => 'required',
            'patente' => 'required|integer',
            'mode_paiement' => 'required',
            'cin' => 'required|min:10|max:10',
            'agent_commercial' => 'required',
            'nom' => 'required|max:255',
            'fonction' => 'required|max:255',
            'email' => 'required|email|max:255',
            'fix' => 'required|max:255',
            'fax' => 'required|max:255',
            'portable' => 'required|max:255',
            'adresse' => 'required|max:255',
            'ville' => 'required|max:255',
            'pays' => 'required|max:255',
        ];
    }
}
