<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class validateClient extends FormRequest
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
            'ice' => 'required',
            'rc' => 'required',
            'patente' => 'required',
            'mode_paiement' => 'required',
            'cin' => 'required',
            'agent_commercial' => 'required',
            'nom' => 'required',
            'fonction' => 'required',
            'email' => 'required',
            'fix' => 'required',
            'fax' => 'required',
            'portable' => 'required',
            'adresse' => 'required',
            'ville' => 'required',
            'pays' => 'required'
        ];
    }
}
