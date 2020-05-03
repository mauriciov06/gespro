<?php

namespace Gespro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactoClienteRequest extends FormRequest
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
            'tipo_cuenta'=>'required',
            'name'=>'required',
            'email'=>'required',
            'celular_usuario'=>'required',
            'ciudad_usuario'=>'required',
            'telefono_usuario'=>'required',
            'cargo_usuario'=>'required'
        ];
    }
}
