<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'name'     => 'required|string',
            'email'    => 'nullable|email',
            'birthday' => 'nullable|date_format:Y-m-d',
            'cpf'      => 'nullable|regex:/^([0-9]{11})$/',
            'gender'   => 'nullable|in:M,F',
            'notes'    => 'nullable|string',
            'status'   => 'nullable|boolean'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'birthday'      => Carbon::parse($this->birthday)->format('Y-m-d'),
            'gender'        => strtoupper($this->gender),
            'cpf'           => apenasNumeros($this->cpf),
        ]);
    }

    public function messages()
    {
        return [
            'cpf.regex' => 'O CPF informado é inválido.',
        ];
    }
}
