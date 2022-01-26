<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
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
            'name'        => 'required|string',
            'name_search' => 'required|string|unique:pets,name_search',
            'birthday'    => 'nullable|date',
            'sex'         => 'required|in:M,F',
            'specie_id'   => 'required|exists:species,id',
            'breed_id'    => 'required|exists:breeds,id',
            'pelage_id'   => 'required|exists:pelages,id',
            'notes'       => 'nullable|string',
            'status'      => 'nullable|boolean',
            'image'       => 'nullable|mimes:png,jpg'
        ];

        if($this->method() == 'PUT') {
            $rules['name_search'] = 'required|string|unique:pets,name_search,'.$this->route('id');
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'birthday'    => Carbon::parse($this->birthday)->format('Y-m-d'),
            'sex'         => strtoupper($this->sex),
            'name_search' => strtoupper(tirarAcentos($this->name))
        ]);
    }
}
