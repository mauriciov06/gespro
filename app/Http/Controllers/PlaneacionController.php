<?php

namespace Gespro\Http\Controllers;

use Illuminate\Http\Request;
use Gespro\Http\Requests;
use Gespro\Http\Requests\StorePlaneacionRequest;
use Gespro\Http\Requests\UpdatePlaneacionRequest;

use Gespro\Planeacion;
use Gespro\Post;
use Auth;
use Redirect;
use Session;

class PlaneacionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if(Auth::user()->tipo_cuenta == 1){
      $planeaciones = Planeacion::busquedaplaneacion($request->get('nombre_plan'),$request->get('servicio_plan'),$request->get('estado_plan'))->orderBy('id','DESC')->paginate();
    }else{
      $planeaciones = Planeacion::busquedaplaneacion($request->get('nombre_plan'),$request->get('servicio_plan'),$request->get('estado_plan'))->orderBy('id','DESC')->where('id_usuario', Auth::id())->paginate();
    }

    return view('planeacion.index', compact('planeaciones'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('planeacion.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StorePlaneacionRequest $request)
  {
    if($request->hasFile('archivo_adjunto')){
      $file = $request->file('archivo_adjunto');
      $extencion_file = $request->file('archivo_adjunto')->getClientOriginalExtension();
      $name_planeacion = time().'-planeacion.'.$extencion_file;
      $file->move(public_path().'/adjuntos-planeacion/',$name_planeacion);
    }

    $planeacion = new Planeacion;
    $planeacion->id_usuario = $request->input('id_usuario');
    $planeacion->nombre_planeacion = $request->input('nombre_planeacion');
    $planeacion->tipo_servicio = $request->input('tipo_servicio');
    $planeacion->start = date("Y-m-d H:i:s",strtotime($request->input('start')));
    $planeacion->end = date("Y-m-d H:i:s",strtotime($request->input('end')));
    $planeacion->momentos = $request->input('momentos');
    $planeacion->archivo_adjunto = $name_planeacion;
    $planeacion->inversion_inicial = $request->input('inversion_inicial');
    $planeacion->inversion_final = 0;
    $planeacion->ciudades_planeacion = $request->input('ciudades_planeacion');
    $planeacion->edades_planeacion = $request->input('edades_planeacion');
    $planeacion->detalles_planeacion = $request->input('detalles_planeacion');
    $planeacion->numero_post = 0;
    $planeacion->estado = $request->input('estado');
    $planeacion->save();
    return redirect('/planeaciones')->with('message','Planeación creado correctamente');
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
    $planeacion = Planeacion::find($id);
    return view('planeacion.edit', compact('planeacion'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdatePlaneacionRequest $request, $id)
  {
    $planeacion = Planeacion::find($id);
    $planeacion->fill($request->all());
    if($request->hasFile('archivo_adjunto')){
      $file = $request->file('archivo_adjunto');
      $extencion_file = $request->file('archivo_adjunto')->getClientOriginalExtension();
      $name_adjunto = time().'-planeacion.'.$extencion_file;
      $planeacion->archivo_adjunto = $name_adjunto;
      $file->move(public_path().'/adjuntos-planeacion/',$name_adjunto);
    }
    $planeacion->start = date("Y-m-d H:i:s",strtotime($request->input('start')));
    $planeacion->end = date("Y-m-d H:i:s",strtotime($request->input('end')));
    $planeacion->save();
    return redirect('/planeaciones')->with('message','Planeación actualizada correctamente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $planeacion = Planeacion::find($request->id);
    if($request->contrasena == '12345'){

      $posts_planeacion = Post::where('id_planeacion', $request->id)->get();

      foreach ($posts_planeacion as $post_planeacion) {
        $delepost = Post::find($post_planeacion->id);
        $file_pieza = public_path().'/piezas-graficas/'.$delepost->adjunto_pieza_grafica;
        $file_editable = public_path().'/editables-graficos/'.$delepost->adjunto_editable;
        \File::delete($file_pieza);
        \File::delete($file_editable);
        $delepost->delete();
      }

      $file_path = public_path().'/adjuntos-planeacion/'.$planeacion->archivo_adjunto;
      \File::delete($file_path);
      $planeacion->delete();
      return response()->json(['borrado'=>true,'mensaje'=>'Planeación eliminada correctamente.']);
    }else{
      return response()->json(['borrado'=>false]);
    }
  }

  public function deletedpost(Request $request)
  {
    $posts_planeaciones = Post::where('id_planeacion', $request->id)->get();
    return response()->json(['num_posts'=>$posts_planeaciones->count()]);
  }
}
