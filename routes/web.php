<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use Gespro\Ciudad;
use Gespro\User;
use Gespro\Post;

Route::group(['middleware' => 'autenticacion'], function(){

  //Admin
	Route::get('/dashboard', 'DashboardController@dashboard');

	//Usuarios
	Route::resource('usuarios', 'UserController');

	//Planeacion
	Route::resource('planeaciones', 'PlaneacionController');
	Route::get('planeaciones/post/{id}', 'PlaneacionController@deletedpost');

	//Post
	Route::resource('posts', 'PostController');
	Route::get('posts/{id}/crear-post', 'PostController@create');
	Route::get('posts/asunto/{id}', 'PostController@getAsunto');
	Route::put('posts/updateasunto/{id}', 'PostController@updateAsunto');
	Route::put('posts/aproved/{id}', 'PostController@aprovedPost');
	Route::put('posts/reproved/{id}', 'PostController@reprovedPost');
	//Route::get('posts/{id}/listado-posts', 'PostController@index');
	Route::get('posts/{id}/listado-posts', function ($idplaneacion,Request $request) {

		$posts = Post::busquedapost($request->get('nombre_post'),$request->get('tipo_post'))->orderBy('id','DESC')->where('id_planeacion', $idplaneacion)->paginate();
    return view('posts.index', compact('posts', 'idplaneacion'));
	});

	//Clientes
	Route::resource('clientes', 'ClienteController');
	Route::get('clientes/contactos/{id}', 'ClienteController@deletedcontacto');

	//Contactos de clientes
	Route::resource('contactos', 'ContactoClienteController');
	//Crear contacto
	Route::get('contactos/{idcliente}/crear-contacto', function ($idcliente) {
	  $ciudades = Ciudad::pluck('nombre_ciudad','id');
	  return view('cliente.contacto-cliente.create', compact('ciudades','idcliente'));
	});
	//Listar contactos
	Route::get('contactos/{idcliente}/listado-contactos', function ($idcliente,Request $request) {

		$contactos = User::busquedacontactocliente($request->get('nombre_contacto_cli'),$request->get('correo_contacto_cli'))->orderBy('id','DESC')->where('id_cliente', $idcliente)->paginate();
		$ciudades = Ciudad::pluck('nombre_ciudad','id');

		return view('cliente.contacto-cliente.index', compact('contactos','ciudades','idcliente'));
	});
	//Edit contacto
	Route::get('contactos/{idcliente}/contacto-cliente/{idcontacto}/edit', function ($idcliente, $idcontacto , Request $request) {
		$contactocliente = User::find($idcontacto);
	  $ciudades = Ciudad::pluck('nombre_ciudad','id');
	  return view('cliente.contacto-cliente.edit', compact('ciudades','idcliente', 'contactocliente'));
	});

	//Equipos
	Route::resource('equipos', 'EquipoController');

	//Solicitudes
	Route::resource('solicitudes', 'SolicitudesController');

	//Cerrar sesion
	Route::get('/cerrar-sesion', 'LoginController@logout');

	//Calendario
	Route::get('/calendario', 'CalendarioController@index')->name('calendario.index');
	Route::get('calendario/listspost/{idusu}', 'CalendarioController@listspost');
	Route::get('calendario/updatePost/{id}/fecha_inicio/{fecha_inicio}', 'CalendarioController@updatePost');
	Route::get('calendario/infoPost/{id}', 'CalendarioController@infoPost');

	//Revisiones
	//Route::resource('revisiones', 'RevisionesController');
	Route::get('/revisiones/{id}', 'RevisionesController@revisiones');

	//Mail
	//Route::resource('mails', 'MailController');
	Route::get('mails', 'MailController@notiPiezaGraficaDesap');

	//Estadisticas
	Route::get('/estadisticas/planeacion/{idplaneacion}', 'EstadisticaController@index');

});


Route::get('/', function () {
  return redirect('iniciar-sesion');
});

//Iniciar sesion
Route::get('/iniciar-sesion', 'LoginController@index');
Route::resource('login', 'LoginController');