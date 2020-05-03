<?php

namespace Gespro\Http\Controllers;

use Illuminate\Http\Request;
use Gespro\Http\Requests;

use Gespro\Revisiones;
use Gespro\User;
use Gespro\Planeacion;
use Gespro\Post;

use Auth;
use Redirect;
use Session;

class EstadisticaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request, $idplaneacion)
  {
    $planeacion = Planeacion::find($idplaneacion);
    $num_posts = Post::where('id_planeacion', $idplaneacion)->count();
    $inversion_final = Post::where('id_planeacion', $idplaneacion)->select('inversion_inicial')->get();
    $inversion_fin = 0;
    $array_inver = json_decode($inversion_final, true);
    foreach($array_inver as $clave => $valor) {
      foreach ($valor as $key2 => $value2) {
        $inversion_fin += (int)$value2;
      }
    }
    $user = User::find($planeacion->id_usuario);
    $name_user = $user->name;

    //Calculo de Eficacia FASE I
    $unix_end_start = strtotime($planeacion->end) - strtotime($planeacion->start);
    $dias_dur_planeacion = $unix_end_start / 86400;

    $plane_revision = Revisiones::where('id_planeacion',$idplaneacion)->where('fase_revision','entrega-planeacion')->where('estado','aprobado')->get();
    
    if(count($plane_revision) != 0){
      $array_plane_revi = json_decode($plane_revision, true);
      $unix_revi = 0;
      foreach ($array_plane_revi as $posicion => $value_revi) {
        $unix_revi = strtotime(date("Y-m-d",strtotime($value_revi['created_at'])));
      }
      $unix_revi_total = $unix_revi - strtotime($planeacion->start);
      $dias_dur_rev = round($unix_revi_total / 86400);

      $indice_respuesta_fase1 = 0;
      $indice_restante_fase1 = 0;
      
      if($dias_dur_rev == $dias_dur_planeacion){
        $indice_respuesta_fase1 = 100;
      }elseif($dias_dur_rev < $dias_dur_planeacion){
        $indice_respuesta_fase1 = 100 + (($dias_dur_planeacion-$dias_dur_rev)/100)*100;
      }elseif($dias_dur_rev > $dias_dur_planeacion){
        $indice_respuesta_fase1 = 100 - (($dias_dur_rev-$dias_dur_planeacion)/100)*100;
      }

      if($indice_respuesta_fase1 < 100){
        $indice_restante_fase1 = 100 - $indice_respuesta_fase1;
      }
    }else{
      $indice_respuesta_fase1 = 0;
      $indice_restante_fase1 = 0;
    }
    //Calculo de Eficacia FASE II
    $list_post = Post::where('id_planeacion',$idplaneacion)->where('fase_post','pieza-espera')->get();
    $array_posts = json_decode($list_post, true);
    $array_dr = array();
    foreach ($array_posts as $i => $post) {
      $unix_end_start_post = strtotime($post['end']) - strtotime($post['start']);
      $dias_dur_post = $unix_end_start_post / 86400;
      $post_revision = Revisiones::where('id_planeacion',$idplaneacion)->where('id_post', $post['id'])->where('fase_revision', 'copys')->where('estado','aprobado')->get();
      $array_post_revi = json_decode($post_revision, true);
      $unix_revi_post = 0;
      foreach ($array_post_revi as $posicion_post => $value_revi_post) {
        $unix_revi_post = strtotime(date("Y-m-d",strtotime($value_revi_post['created_at'])));
      }
      $unix_revi_total_post = $unix_revi_post - strtotime($post['start']);
      $dias_dur_rev_post = round($unix_revi_total_post / 86400);
      
      $array_dr[] = array('id_post'=>$post['id'], "dias_duracion_post"=>$dias_dur_post, "dias_duracion_revision"=>$dias_dur_rev_post);
    }

    $pro_post_dura_cal = 0;
    $pro_revi_dura_cal = 0;

    $indice_respuesta_fase2 = 0;
    $indice_restante_fase2 = 0;

    foreach ($array_dr as $duracion_post_cal) {
      $pro_post_dura_cal += $duracion_post_cal['dias_duracion_post'];
      $pro_revi_dura_cal += $duracion_post_cal['dias_duracion_revision'];

      if($pro_post_dura_cal == $pro_revi_dura_cal){
        $indice_respuesta_fase2 = 100;
      }elseif($pro_post_dura_cal > $pro_revi_dura_cal){
        $indice_respuesta_fase2 = 100 + (($pro_post_dura_cal-$pro_revi_dura_cal)/100)*100;
      }elseif($pro_post_dura_cal < $pro_revi_dura_cal){
        $indice_respuesta_fase2 = 100 - (($pro_revi_dura_cal-$pro_post_dura_cal)/100)*100;
      }

      if($indice_respuesta_fase2 < 100){
        $indice_restante_fase2 = 100 - $indice_respuesta_fase2;
      }
    }    


    //Calculo de Eficacia FASE III
    $list_post_fase3 = Post::where('id_planeacion',$idplaneacion)->where('fase_post','Vencido')->get();
    $array_posts3 = json_decode($list_post_fase3, true);
    $array_dr3 = array();
    foreach ($array_posts3 as $i => $post3) {
      $unix_end_start_post3 = strtotime($post3['end']) - strtotime($post3['start']);
      $dias_dur_post3 = $unix_end_start_post3 / 86400;
      $post_revision3 = Revisiones::where('id_planeacion',$idplaneacion)->where('id_post', $post3['id'])->where('fase_revision', 'copys')->where('estado','aprobado')->get();
      $array_post_revi3 = json_decode($post_revision3, true);
      $unix_revi_post3 = 0;
      foreach ($array_post_revi3 as $posicion_post3 => $value_revi_post3) {
        $unix_revi_post3 = strtotime(date("Y-m-d",strtotime($value_revi_post3['created_at'])));
      }
      $unix_revi_total_post3 = $unix_revi_post3 - strtotime($post3['start']);
      $dias_dur_rev_post3 = round($unix_revi_total_post3 / 86400);
      
      $array_dr3[] = array('id_post'=>$post3['id'], "dias_duracion_post"=>$dias_dur_post3, "dias_duracion_revision"=>$dias_dur_rev_post3);
    }

    $pro_post_dura_cal3 = 0;
    $pro_revi_dura_cal3 = 0;

    $indice_respuesta_fase3 = 0;
    $indice_restante_fase3 = 0;

    foreach ($array_dr3 as $duracion_post_cal) {
      $pro_post_dura_cal3 += $duracion_post_cal['dias_duracion_post'];
      $pro_revi_dura_cal += $duracion_post_cal['dias_duracion_revision'];

      if($pro_post_dura_cal3 == $pro_revi_dura_cal3){
        $indice_respuesta_fase3 = 100;
      }elseif($pro_post_dura_cal3 > $pro_revi_dura_cal){
        $indice_respuesta_fase3 = 100 + (($pro_post_dura_cal3-$pro_revi_dura_cal3)/100)*100;
      }elseif($pro_post_dura_cal3 < $pro_revi_dura_cal){
        $indice_respuesta_fase3 = 100 - (($pro_revi_dura_cal3-$pro_post_dura_cal3)/100)*100;
      }

      if($indice_respuesta_fase3 < 100){
        $indice_restante_fase3 = 100 - $indice_respuesta_fase3;
      }
    }




    return view('estadisticas.index', compact('planeacion', 'num_posts', 'inversion_fin', 'name_user', 'indice_respuesta_fase1', 'indice_restante_fase1','indice_respuesta_fase2','indice_restante_fase2','indice_respuesta_fase3','indice_restante_fase3')); 
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
}
