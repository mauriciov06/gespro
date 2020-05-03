<?php

namespace Gespro\Http\Controllers;

use Illuminate\Http\Request;
use Gespro\Http\Requests;
use Gespro\Http\Requests\StorePostRequest;
use Gespro\Http\Requests\UpdatePostRequest;
use Gespro\Post;
use Gespro\Planeacion;
use Gespro\Revisiones;
use Auth;
use Redirect;
use Session;
use Mail;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request, $idplaneacion)
  {
    /*$posts = Post::busquedapost($request->get('nombre_post'),$request->get('tipo_post'))->orderBy('id','DESC')->where('id_planeacion', $idplaneacion)->paginate();
    return view('posts.index', compact('posts', 'idplaneacion'));*/
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($idplaneacion)
  {
    return view('posts.create', compact('idplaneacion'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StorePostRequest $request)
  {
    if($request->hasFile('adjunto_pieza_grafica')){
      $file = $request->file('adjunto_pieza_grafica');
      $extencion_file = $request->file('adjunto_pieza_grafica')->getClientOriginalExtension();
      $name_pieza = time().'-pieza.'.$extencion_file;
      $file->move(public_path().'/piezas-graficas/',$name_pieza);
    }else{
      $name_pieza = 0;
    }

    if($request->hasFile('adjunto_editable')){
      $file2 = $request->file('adjunto_editable');
      $extencion_file2 = $request->file('adjunto_editable')->getClientOriginalExtension();
      $name_editable = time().'-editable.'.$extencion_file2;
      $file2->move(public_path().'/editables-graficos/',$name_editable);
    }else{
      $name_editable = 0;
    }

    $post = new Post;
    $post->id_planeacion = $request->input('id_planeacion');
    $post->title = $request->input('title');
    $post->start = date("Y-m-d H:i:s",strtotime($request->input('start')));
    $post->end = date("Y-m-d H:i:s",strtotime($request->input('end')));
    $post->editable = $request->input('editable');
    $post->adjunto_editable = $name_editable;
    $post->asunto = $request->input('asunto');
    $post->tipo_post = $request->input('tipo_post');
    $post->inversion_inicial = $request->input('inversion_inicial');
    $post->inversion_final = 0;
    $post->ciudades_post = $request->input('ciudades_post');
    $post->formato_post = $request->input('formato_post');
    $post->genero_post = $request->input('genero_post');
    $post->edades_post = $request->input('edades_post');
    $post->describir_detalles_post = $request->input('describir_detalles_post');
    $post->adjunto_pieza_grafica = $name_pieza;
    $post->estado = $request->input('estado');
    $post->fase_post = $request->input('fase_post');
    $post->save();
    return redirect('/posts/'.$post->id_planeacion.'/listado-posts')->with('message','Post creado correctamente');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $post = Post::find($id);
    return view('posts.show', compact('post','idplaneacion'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $post = Post::find($id);
    return view('posts.edit', compact('post'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdatePostRequest $request, $id)
  {
    $post = Post::find($id);
    $post->fill($request->all());
    if($request->hasFile('adjunto_editable')){
      $file = $request->file('adjunto_editable');
      $extencion_file = $request->file('adjunto_editable')->getClientOriginalExtension();
      $post->adjunto_editable = time().'-editable.'.$extencion_file;
      $file->move(public_path().'/editables-graficos/',$post->adjunto_editable);
    }

    if($request->hasFile('adjunto_pieza_grafica')){
      $file = $request->file('adjunto_pieza_grafica');
      $extencion_file2 = $request->file('adjunto_pieza_grafica')->getClientOriginalExtension();
      $post->adjunto_pieza_grafica = time().'-pieza.'.$extencion_file2;
      $file->move(public_path().'/piezas-graficas/',$post->adjunto_pieza_grafica);
    }
    
    $post->start = date("Y-m-d H:i:s",strtotime($request->input('start')));
    $post->end = date("Y-m-d H:i:s",strtotime($request->input('end')));
    $post->save();
    return redirect('/posts/'.$post->id_planeacion.'/listado-posts')->with('message','Post actualizado correctamente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $post = Post::find($request->id);
    if($request->contrasena == '12345'){
      $file_path = public_path().'/editables-graficos/'.$post->adjunto_editable;
      $file_path2 = public_path().'/piezas-graficas/'.$post->adjunto_pieza_grafica;
      \File::delete($file_path);
      \File::delete($file_path2);
      $post->delete();
      return response()->json(['borrado'=>true,'mensaje'=>'Post eliminada correctamente.']);
    }else{
      return response()->json(['borrado'=>false]);
    }
  }

  public function getAsunto(Request $request)
  {
    $post = Post::find($request->id);
    return response()->json(['asunto'=>$post->asunto]);
  }

  public function updateAsunto(Request $request)
  {
    $post = Post::find($request->id);
    $post->asunto = $request->asunto;
    $post->save();
    return response()->json([
      'actualizado'=>true
    ]);
  }

  public function aprovedPost(Request $request)
  {
    if($request->type == 'post'){
      if($request->fase_post == 'pieza-espera'){
        $post = Post::find($request->id);
        $post->fase_post = $request->fase_post;
        if($post->save()){
          $revision = new Revisiones; 
          $revision->id_usuario = Auth::id();
          if($request->type == 'post'){
            $revision->id_planeacion = $post->id_planeacion;
            $revision->id_post = $request->id;
          }else{
            $revision->id_planeacion = $request->id;
            $revision->id_post = 0;
          }
          $revision->fase_revision = $request->fase_aproved;
          $revision->tipo_revision = $request->type;
          $revision->razon_desaprobacion = '0';
          $revision->estado = 'aprobado';
          if($revision->save()){
            //Envio notificación por correo
            Mail::send('emails.noti-aprobacion-post-copy', ['post'=>$post], function($msj) use ($post){
              $msj->subject('Aprobación de Copys');
              $msj->to('desarrollo@gomind.com.co');
            });
            return response()->json([
              'aproved'=>true
            ]);
          }
        }

      }else{
        $post = Post::find($request->id);
        $fecha_ini = strtotime($post->start);
        $hoy = strtotime(date("Y-m-d"));
        if($fecha_ini == $hoy){
          $post->fase_post = 'Publicar';
        }elseif($fecha_ini < $hoy){
          $post->fase_post = 'Vencido';
        }else{
          $post->fase_post = 'Programar';
        }
        if($post->save()){
          $revision = new Revisiones; 
          $revision->id_usuario = Auth::id();
          if($request->type == 'post'){
            $revision->id_planeacion = $post->id_planeacion;
            $revision->id_post = $request->id;
          }else{
            $revision->id_planeacion = $request->id;
            $revision->id_post = 0;
          }
          $revision->fase_revision = $request->fase_aproved;
          $revision->tipo_revision = $request->type;
          $revision->razon_desaprobacion = '0';
          $revision->estado = 'aprobado';
          if($revision->save()){
            //Envio notificación por correo
            Mail::send('emails.noti-aprobacion-post-piezagrafica', ['post'=>$post], function($msj) use ($post){
              $msj->subject('Aprobación de Pieza Grafica');
              $msj->to('desarrollo@gomind.com.co');
            });
            Mail::send('emails.noti-publicacion-post', ['post'=>$post], function($msj) use ($post){
              $msj->subject('Publicación de Post Aprobado');
              $msj->to('desarrollo@gomind.com.co');
            });
            return response()->json([
              'aproved'=>true
            ]);
          }
        }

      }
    }else{
      $planeacion = Planeacion::find($request->id);
      $planeacion->estado = 'Aprobado';
      if($planeacion->save()){

        $revision = new Revisiones; 
        $revision->id_usuario = Auth::id();
        $revision->id_planeacion = $request->id;
        $revision->fase_revision = $request->fase_aproved;
        $revision->id_post = 0;
        $revision->tipo_revision = $request->type;
        $revision->razon_desaprobacion = '0';
        $revision->estado = 'aprobado';
        if($revision->save()){
          //Envio notificación por correo
          Mail::send('emails.noti-aprobacion-planeacion', ['planeacion'=>$planeacion], function($msj) use ($planeacion){
            $msj->subject('Aprobación de Entrega de Planeación');
            $msj->to('desarrollo@gomind.com.co');
          });
          return response()->json([
            'aproved'=>true
          ]);
        }

      }
      

    }
    
  }

  public function reprovedPost(Request $request)
  {
    $revision = new Revisiones(); 
    $revision->id_usuario = Auth::id();
    $dataReproved = '';
    if($request->type == 'post'){
      $post = Post::find($request->id);
      $revision->id_planeacion = $post->id_planeacion;
      $revision->id_post = $request->id;
      $dataReproved = $post;
    }else{
      $revision->id_planeacion = $request->id;
      $revision->id_post = 0;
      $dataReproved = Planeacion::find($request->id);
    }
    $revision->tipo_revision = $request->type;
    $revision->fase_revision = $request->fase;
    $revision->razon_desaprobacion = $request->razon_desaprobacion;
    $revision->estado = 'desaprobado';
    $fase = '';
    if($revision->save()){
      if($request->type == 'post'){
        if($request->fase == 'copys'){
          $fase = 'Copys';
        }elseif($request->fase == 'diseno-pieza'){
          $fase = 'Diseño de Pieza';
        }
      }else{
        if($request->fase == 'entrega-planeacion'){
          $fase = 'Entrega de Planeación';
        }
      }
      $type_obj = $request->type;
      $razon_desa = $request->razon_desaprobacion;
      //Envio notificación por correo
      Mail::send('emails.noti-desaprobacion', ['dataReproved'=>$dataReproved, 'type_obj'=>$type_obj,'razon_desa'=>$razon_desa], function($msj) use ($dataReproved,$razon_desa,$fase){
        $msj->subject('Desaprobación de '.$fase);
        $msj->to('desarrollo@gomind.com.co');
      });

      return response()->json([
        'reproved'=>true
      ]);
    }
  }
}
