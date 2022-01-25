<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerAddressRequest extends FormRequest
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
        $states = array_keys(estadosBrasileiros());
        return [
            'addresses'                => 'required|array',
            'addresses.*.zipcode'      => 'required|string|regex:/^[0-9]{8}$/',
            'addresses.*.address'      => 'required|string',
            'addresses.*.number'       => 'required|string',
            'addresses.*.complement'   => 'nullable|string',
            'addresses.*.neighborhood' => 'required|string',
            'addresses.*.city'         => 'required|string',
            'addresses.*.state'        => ['required', 'string', Rule::in($states)],
        ];
    }

    public function messages()
    {
        return [
            'addresses.*.state.in' => 'Informe um estado válido.',
            'addresses.*.zipcode.regex' => 'Informe um CEP válido.'
        ];
    }
}
