<?php

namespace Gespro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSolicitudesRequest extends FormRequest
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
            'id_usuario'=>'required',
            'tema_urgencia'=>'required',
            'nombre_solicitud'=>'required',
            'descripcion_solicitud'=>'required',
            'archivo_adjunto_solicitud'=>'required'
        ];
    }
}
