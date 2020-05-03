<?php

namespace Gespro\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Gespro\Post;
use Gespro\Planeacion;

class MailController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //
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
      //
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
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }

  public function notiPiezaGraficaDesap(Request $request)
  {
    $post = Post::find($request->id_post);
    $planeacion = Planeacion::find($post->id_planeacion);

    Mail::send('emails.noti-pieza-grafica-desap', ['post'=>$post, 'planeacion'=>$planeacion], function($msj) use ($post, $planeacion){
      $msj->subject('Recordatorio de Pieza Grafica');
      $msj->to('communitymanager2@gomind.com.co');
    });
    return response()->json([
      'send'=>true
    ]);
  }
}
