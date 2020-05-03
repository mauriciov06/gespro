<?php

namespace Gespro\Http\Controllers;

use Illuminate\Http\Request;
use Gespro\Ciudad;
use Gespro\User;
use Gespro\Http\Requests;
use Gespro\Http\Requests\UpdateContactoClienteRequest;
use Gespro\Http\Requests\StoreContactoClienteRequest;

use Redirect;
use Session;

class ContactoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $contactos = User::where('id_cliente',$request->id)->paginate();
      $user_contactos = User::where('tipo_cuenta',4)->get();
      $ciudades = Ciudad::pluck('nombre_ciudad','id');

      return view('cliente.contacto-cliente.index', compact('contactos','ciudades','user_contactos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $ciudades = Ciudad::pluck('nombre_ciudad','id');
      return view('cliente.contacto-cliente.create', compact('ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactoClienteRequest $request)
    {
      $contactocliente = new User;
      $contactocliente->tipo_cuenta = $request->input('tipo_cuenta');
      $contactocliente->name = $request->input('name');
      $contactocliente->email = $request->input('email');
      $contactocliente->celular_usuario = $request->input('celular_usuario');
      $contactocliente->ciudad_usuario = $request->input('ciudad_usuario');
      $contactocliente->telefono_usuario = $request->input('telefono_usuario');
      $contactocliente->direccion_usuario = '0';
      $contactocliente->cargo_usuario = $request->input('cargo_usuario');
      $contactocliente->avatar = '0';
      $contactocliente->nit_rut = '0';
      $contactocliente->password = $request->input('password');
      $contactocliente->slug = str_replace(' ','-',strtolower($request->input('name')));
      $contactocliente->id_equipo = '-1';
      $contactocliente->id_cliente = $request->input('idcliente');
      $contactocliente->save();

      return redirect('/contactos/'.$contactocliente->id_cliente.'/listado-contactos')->with('message','Contacto creado correctamente');
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
    public function update(UpdateContactoClienteRequest $request, $id)
    {
      $usuario = User::find($id);
      $usuario->fill($request->all());
      $usuario->slug = str_replace(' ','-',strtolower($request->input('name')));
      $usuario->save();

      return redirect('/contactos/'.$request->idcliente.'/listado-contactos')->with('message','Contacto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $user = User::find($request->id);
      if($request->contrasena == '12345'){
        $user->delete();
        return response()->json(['borrado'=>true,'mensaje'=>'Contacto eliminado correctamente.']);
      }else{
        return response()->json(['borrado'=>false]);
      }
    }
}
