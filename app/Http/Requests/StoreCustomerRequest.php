<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
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
            'name'                 => 'required|string',
            'email'                => 'nullable|email',
            'birthday'             => 'nullable|date_format:Y-m-d',
            'cpf'                  => 'nullable|regex:/^([0-9]{11})$/',
            'gender'               => 'nullable|in:M,F',
            'notes'                => 'nullable|string',
            'address'              => 'nullable',
            'address.zipcode'      => 'nullable|string|regex:/^[0-9]{8}$/',
            'address.address'      => 'nullable|string',
            'address.number'       => 'nullable|string',
            'address.complement'   => 'nullable|string',
            'address.neighborhood' => 'nullable|string',
            'address.city'         => 'nullable|string',
            'address.state'        => ['nullable', 'string', Rule::in($states)],
            'contacts'             => 'nullable|array',
            'contacts.*.type'      => 'nullable|string|in:email,phone,cellphone',
            'contacts.*.contact'   => 'nullable|string',
            'contacts.*.favorite'  => 'nullable|boolean'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'birthday'      => Carbon::parse($this->birthday)->format('Y-m-d'),
            'gender'        => strtoupper($this->gender),
            'cpf'           => apenasNumeros($this->cpf),
            'address.state' => strtoupper($this->address['state']),
        ]);
    }

    public function messages()
    {
        return [
            'cpf.regex'        => 'O CPF informado é inválido.',
            'address.state.in' => 'Informe um estado válido.',
            'address.zipcode.regex' => 'Informe um CEP válido.'
        ];
    }
}
