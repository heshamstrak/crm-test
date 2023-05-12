<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title'         => 'required',
            'description'   => 'required',
            'deadline'      => 'required',
            'project_id'    => 'required',
            'status'        => 'required',
        ];

        return $rules;

    }//end of rules


}//end of request
