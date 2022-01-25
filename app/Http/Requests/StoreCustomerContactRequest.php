<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerContactRequest extends FormRequest
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
            'contacts'             => 'required|array',
            'contacts.*.type'      => 'required|string|in:email,phone,cellphone',
            'contacts.*.contact'   => 'required|string',
            'contacts.*.favorite'  => 'nullable|boolean'
        ];
    }
}
