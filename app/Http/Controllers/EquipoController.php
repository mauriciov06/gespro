<?php

namespace Gespro\Http\Controllers;

use Illuminate\Http\Request;
use Gespro\Http\Requests;
use Gespro\Equipo;
use Gespro\User;

class EquipoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $equipos = Equipo::busquedaequipo($request->get('nombre_equipo'))->orderBy('id','DESC')->paginate();
    return view('equipo.index', compact('equipos'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('equipo.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if($request->ajax()){
      Equipo::create($request->all());
      return response()->json([
        'mensaje' => 'Equipo creado correctamente'
      ]);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $equipo = Equipo::find($id);
      return response()->json(
        $equipo->toArray()
      );
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $equipo = Equipo::find($request->id);
    $equipo->nombre_equipo = $request->equipo;
    $equipo->save();

    return response()->json([
      'mensaje'=>'Equipo actualizado correctamente.'
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $equipo = Equipo::find($request->id);
    if($request->contrasena == '12345'){
      $equipo->delete();
      return response()->json(['borrado'=>true,'mensaje'=>'Equipo eliminado correctamente.']);
    }else{
      return response()->json(['borrado'=>false]);
    }
  }
}
