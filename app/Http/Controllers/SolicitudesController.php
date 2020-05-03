<?php

namespace Gespro\Http\Controllers;

use Illuminate\Http\Request;
use Gespro\Http\Requests;
use Gespro\Http\Requests\StoreSolicitudesRequest;
use Gespro\Http\Requests\UpdateSolicitudesRequest;
use Gespro\SolicitudesUrgentes;
use Gespro\TemasUrgenciaSolicitudes;
use Auth;
use Redirect;
use Session;

class SolicitudesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if(Auth::user()->tipo_cuenta == 1){
      $solicitudes = SolicitudesUrgentes::busquedasolicitud($request->get('nombre_soli'),$request->get('tema_urge'))->orderBy('id','DESC')->paginate();
    }else{
      $solicitudes = SolicitudesUrgentes::busquedasolicitud($request->get('nombre_soli'),$request->get('tema_urge'))->orderBy('id','DESC')->where('id_usuario', Auth::id())->paginate();
    }
    $temas_urgencias = TemasUrgenciaSolicitudes::pluck('nombre_tema','id');
    return view('solicitudes.index', compact('solicitudes', 'temas_urgencias'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $temas_urgencias = TemasUrgenciaSolicitudes::pluck('nombre_tema','id');
    return view('solicitudes.create', compact('temas_urgencias'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreSolicitudesRequest $request)
  {
    if($request->hasFile('archivo_adjunto_solicitud')){
      $file = $request->file('archivo_adjunto_solicitud');
      $name_adjunto = time().'-adjunto';
      $file->move(public_path().'/adjuntos-solicitudes/',$name_adjunto);
    }

    $solicitud = new SolicitudesUrgentes;
    $solicitud->id_usuario = $request->input('id_usuario');
    $solicitud->tema_urgencia = $request->input('tema_urgencia');
    $solicitud->nombre_solicitud = $request->input('nombre_solicitud');
    $solicitud->descripcion_solicitud = $request->input('descripcion_solicitud');
    $solicitud->archivo_adjunto_solicitud = $name_adjunto;
    $solicitud->estado = $request->input('estado');
    $solicitud->save();
    return redirect('/solicitudes')->with('message','Solicitud creada correctamente');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $solicitud = SolicitudesUrgentes::find($id);
    $temas_urgencias = TemasUrgenciaSolicitudes::pluck('nombre_tema','id');
    return view('solicitudes.show', compact('solicitud', 'temas_urgencias'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $solicitud = SolicitudesUrgentes::find($id);
    $temas_urgencias = TemasUrgenciaSolicitudes::pluck('nombre_tema','id');
    return view('solicitudes.edit', compact('solicitud','temas_urgencias'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateSolicitudesRequest $request, $id)
  {
    $solicitud = SolicitudesUrgentes::find($id);
    $solicitud->fill($request->all());
    if($request->hasFile('archivo_adjunto_solicitud')){
      $file = $request->file('archivo_adjunto_solicitud');
      $name_adjunto = time().'-adjunto';
      $solicitud->archivo_adjunto_solicitud = $name_adjunto;
      $file->move(public_path().'/adjuntos-solicitudes/',$name_adjunto);
    }
    $solicitud->save();
    return redirect('/solicitudes')->with('message','Solicitud actualizada correctamente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $solicitud = SolicitudesUrgentes::find($request->id);
    if($request->contrasena == '12345'){
      $file_path = public_path().'/adjuntos-solicitudes/'.$solicitud->archivo_adjunto_solicitud;
      \File::delete($file_path);
      $solicitud->delete();
      return response()->json(['borrado'=>true,'mensaje'=>'Solicitud eliminada correctamente.']);
    }else{
      return response()->json(['borrado'=>false]);
    }
  }
}
