<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'phone' => 'required',
            'image' => 'required',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            
            $client = $this->route()->parameter('client');

            $rules['email'] = 'required|email|unique:clients,id,' . $client->id;

        }//end of if

        return $rules;

    }//end of rules


}//end of request
