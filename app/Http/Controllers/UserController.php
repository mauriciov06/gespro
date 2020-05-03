<?php

namespace Gespro\Http\Controllers;

use Illuminate\Http\Request;
use Gespro\Http\Requests;
use Gespro\Http\Requests\StoreUserRequest;
use Gespro\Http\Requests\UpdateUserRequest;
use Gespro\User;
use Gespro\Ciudad;
use Gespro\Equipo;
use Auth;
use Redirect;
use Session;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$usuarios = User::busquedausuario($request->get('nombre_usuario'),$request->get('correo_usuario'),$request->get('ciudad_usuario'))->orderBy('id','DESC')->where('tipo_cuenta','1')->paginate();
		$ciudades = Ciudad::pluck('nombre_ciudad','id');
		return view('usuario.index', compact('usuarios','ciudades'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$ciudades = Ciudad::pluck('nombre_ciudad','id');
		$equipos = Equipo::pluck('nombre_equipo','id');
		return view('usuario.create', compact('ciudades','equipos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreUserRequest $request)
	{
		if($request->hasFile('avatar')){
			$file = $request->file('avatar');
			$name_avatar = time().$file->getClientOriginalName();
			$file->move(public_path().'/avatares/',$name_avatar);
		}

		$usuario = new User;
		$usuario->tipo_cuenta = $request->input('tipo_cuenta');
		$usuario->name = $request->input('name');
		$usuario->email = $request->input('email');
		$usuario->celular_usuario = $request->input('celular_usuario');
		$usuario->ciudad_usuario = $request->input('ciudad_usuario');
		$usuario->telefono_usuario = $request->input('telefono_usuario');
		$usuario->direccion_usuario = '0';
		$usuario->cargo_usuario = $request->input('cargo_usuario');
		$usuario->avatar = $name_avatar;
		$usuario->nit_rut = '0';
		$usuario->password = $request->input('password');
		$usuario->slug = str_replace(' ','-',strtolower($request->input('name')));
		$usuario->id_equipo = $request->input('id_equipo');
		$usuario->id_cliente = $request->input('id_cliente');
		$usuario->save();
		return redirect('/usuarios')->with('message','Usuario creado correctamente');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $usuario)
	{
		return view('usuario.show', compact('usuario'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $usuario)
	{
		$ciudades = Ciudad::pluck('nombre_ciudad','id');
		$equipos = Equipo::pluck('nombre_equipo','id');
		return view('usuario.edit', compact('usuario','ciudades','equipos'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateUserRequest $request, User $usuario)
	{
		$usuario->fill($request->all());
		if($request->hasFile('avatar')){
			$file = $request->file('avatar');
			$name_avatar = time().$file->getClientOriginalName();
			$usuario->avatar = $name_avatar;
			$file->move(public_path().'/avatares/',$name_avatar);
		}
		$usuario->slug = str_replace(' ','-',strtolower($request->input('name')));
		$usuario->save();
		return redirect('/usuarios')->with('message','Usuario actualizado correctamente');
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
			$file_path = public_path().'/avatares/'.$user->avatar;
			\File::delete($file_path);
	    $user->delete();
	    return response()->json(['borrado'=>true,'mensaje'=>'Usuario eliminado correctamente.']);
		}else{
			return response()->json(['borrado'=>false]);
		}
	}
}
