<?php

namespace Gespro\Http\Controllers;

use Illuminate\Http\Request;
use Gespro\Http\Requests;
use Gespro\Http\Requests\StoreClienteRequest;
use Gespro\Http\Requests\UpdateClienteRequest;
use Gespro\User;
use Gespro\Ciudad;
use Redirect;
use Session;

class ClienteController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $clientes = User::busquedacliente($request->get('nombre_cliente'),$request->get('correo_cliente'),$request->get('ciudad_cliente'),$request->get('tipo_cuenta_cliente'))->orderBy('id','DESC')->where('id_equipo',0)->paginate();
    $ciudades = Ciudad::pluck('nombre_ciudad','id');
    return view('cliente.index', compact('clientes','ciudades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $ciudades = Ciudad::pluck('nombre_ciudad','id');
    return view('cliente.create', compact('ciudades'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreClienteRequest $request)
  {
    $request->except('password');
    if($request->hasFile('avatar')){
      $file = $request->file('avatar');
      $name_avatar = time().$file->getClientOriginalName();
      $file->move(public_path().'/avatares/',$name_avatar);
    }

    $cliente = new User;
    $cliente->tipo_cuenta = $request->input('tipo_cuenta');
    $cliente->name = $request->input('name');
    $cliente->email = $request->input('email');
    $cliente->celular_usuario = $request->input('celular_usuario');
    $cliente->ciudad_usuario = $request->input('ciudad_usuario');
    $cliente->telefono_usuario = $request->input('telefono_usuario');
    $cliente->direccion_usuario = $request->input('direccion_usuario');
    $cliente->cargo_usuario = '0';
    $cliente->avatar = $name_avatar;
    $cliente->nit_rut = $request->input('nit_rut');
    $cliente->password = $request->input('password');
    $cliente->slug = str_replace(' ','-',strtolower($request->input('name')));
    $cliente->id_equipo = 0;
    $cliente->save();
    return redirect('/clientes')->with('message','Cliente creado correctamente');
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
  public function edit(User $cliente)
  {
    $ciudades = Ciudad::pluck('nombre_ciudad','id');
    return view('cliente.edit', compact('cliente','ciudades'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateClienteRequest $request, User $cliente)
  {
    $cliente->fill($request->all());
    if($request->hasFile('avatar')){
      $file = $request->file('avatar');
      $name_avatar = time().$file->getClientOriginalName();
      $cliente->avatar = $name_avatar;
      $file->move(public_path().'/avatares/',$name_avatar);
    }
    $cliente->slug = str_replace(' ','-',strtolower($request->input('name')));
    $cliente->save();
    return redirect('/clientes')->with('message','Clientes actualizado correctamente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $cliente = User::find($request->id);
    
    if($request->contrasena == '12345'){
      $contactos_clients = User::where('id_cliente', $request->id)->where('tipo_cuenta',4)->get();

      foreach ($contactos_clients as $contacto_client) {
        $delecontacto = User::find($contacto_client->id);
        $delecontacto->delete();
      }
      
      $file_path = public_path().'/avatares/'.$cliente->avatar;
      \File::delete($file_path);
      $cliente->delete();
      return response()->json(['borrado'=>true,'mensaje'=>'Cliente eliminado correctamente.']);
    }else{
      return response()->json(['borrado'=>false]);
    }

  }

  public function deletedcontacto(Request $request)
  {
    $contactos_clients = User::where('id_cliente', $request->id)->where('tipo_cuenta',4)->get();
    return response()->json(['num_contactos'=>$contactos_clients->count()]);
  }
}
