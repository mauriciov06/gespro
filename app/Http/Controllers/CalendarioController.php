<?php

namespace Gespro\Http\Controllers;

use Illuminate\Http\Request;
use Gespro\Post;
use Gespro\Planeacion;

use Calendar;

class CalendarioController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $events = [];
    $data = Post::all();
    if($data->count()) {
        foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                $value->tematica_post,
                true,
                new \DateTime($value->fecha_inicio),
                new \DateTime($value->fecha_final.' +1 day'),
                $value->id
                /* Add color and link on event
              [
                  'color' => '#f05050',
                  'url' => 'pass here url and any route',
              ]*/
            );
        }
    }
    $calendar = Calendar::addEvents($events);
    return view('calendario.index', compact('calendar'));
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

  public function listspost($id)
  {
    $posts = Post::select('id', 'title','start')->get();
    echo $posts;
  }
  public function updatePost(Request $request){
    $post = Post::find($request->id);
    $post->start = $request->fecha_inicio;
    $post->save();
    return response()->json(['actualizado'=>true]);
  }
  public function infoPost(Request $request){
    $post = Post::find($request->id);
    return response()->json(
      $post->toArray()
    );
  }
}
