<?php

namespace App\Http\Requests\Companies;

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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'name'              => 'required|string|max:255',
                        'house_no'          => 'required|string|max:5',
                        'street_address'    => 'required|max:255',
                        'city'              => 'required|string',
                        'country'           => 'required|string|max:60',
                        'phone_no'          => 'required|min:8|numeric',
                        'vat_no'            => 'required|min:8|numeric',
                        'status'            => 'required|boolean',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name'              => 'required|string|max:255',
                        'house_no'          => 'string|max:5',
                        'street_address'    => 'max:255',
                        'city'              => 'string',
                        'country'           => 'string|max:60',
                        'phone_no'          => 'min:8|numeric',
                        'vat_no'            => 'min:8|numeric',
                        'status'            => 'boolean',
                    ];
                }
            default:break;
        }

    }
}
