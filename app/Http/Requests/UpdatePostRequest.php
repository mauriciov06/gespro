<?php

namespace Gespro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
      'title' => 'required',
      'start' => 'required',
      'end' => 'required|after:start',
      'editable' => 'required',
      'asunto' => 'required',
      'tipo_post' => 'required',
      'inversion_inicial' => 'required',
      'ciudades_post' => 'required',
      'formato_post' => 'required',
      'genero_post' => 'required',
      'edades_post' => 'required',
      'describir_detalles_post' => 'required',
      'estado' => 'required',
      'fase_post' => 'required'
    ];
  }
}
