<?php

namespace Gespro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlaneacionRequest extends FormRequest
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
      'nombre_planeacion'=>'required',
      'tipo_servicio'=>'required',
      'start'=>'required',
      'end'=>'required|after:start',
      'momentos'=>'required',
      'archivo_adjunto'=>'required',
      'inversion_inicial'=>'required',
      'ciudades_planeacion'=>'required',
      'edades_planeacion'=>'required',
      'detalles_planeacion'=>'required',
      'estado'=>'required'
    ];
  }
}
