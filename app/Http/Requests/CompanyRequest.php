<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'civility' => 'bail|required|max:1',
            'name' => 'bail|required|max:150',
            'company' => 'bail|required|max:150',
            'addressCompany' => 'bail|required|max:150',
            'phone' => 'bail|required'
        ];
    }
}
