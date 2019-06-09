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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/inicio', 'HomeClienteController@index')->name('home');
Route::get('/inicio_admin', 'HomeAdminController@index')->name('home');

Route::get('/error401','ErroresController@error401');


/*Grupo de rutas en las que se valida que:
 * El usuario esté logueado,
 * El rol sea válido y se encuentre activo y
 * El rol tenga configiurado por programa el acceso a la ruta 
 */
//Route::group(['middleware'=>['auth','checkrol','acceso.pantalla']],function(){
    
//});



/*Grupo de rutas en las que se valida que:
 * El usuario esté logueado,
 * El rol sea válido y se encuentre activo
 */
Route::group(['middleware'=>['auth','checkrol']], function(){
    Route::resource("incidencias","IncidenciasController");
    Route::resource("roles","RolesController");
    Route::resource("usuarios","UsuariosController");
    Route::resource("proyectos","ProyectosController");
    Route::resource('categorias','CategoriasController');    
    Route::resource('pantallas','PantallaController');
    Route::resource('chat','ChatController');
    
    Route::resource('incidencias' ,'IncidenciasController');
    Route::resource('niveles','NivelController');    
    Route::resource('asignar_proyecto', 'UserProjectController');
    
    Route::resource('permisos','PermisosController');
    Route::resource('menus','MenuController');
    Route::get('gestion_incidencias/{id}','GestionarIncidenciasController@show');
    Route::post('gestion_incidencias','GestionarIncidenciasController@atender');
    Route::post('gestion_incidencias/{id}/derivar','GestionarIncidenciasController@derivar');
    Route::post('gestion_incidencias/{id}','GestionarIncidenciasController@update');
    Route::post('gestion_incidencias/{id}/finalizar','GestionarIncidenciasController@finalizar');
    Route::post('gestion_incidencias/{id}/reabrir','GestionarIncidenciasController@reabrir');
    Route::post('gestion_estado_botones/{id}','GestionarIncidenciasController@consultarEstadoBotones');
    
    
    Route::post("roles/filtro","RolesController@filtrar");
    Route::post("proyectos/filtro","ProyectosController@filtrar");

    Route::get('cambio_proyecto/{idProyecto}', 'UsuariosController@cambioDeProyecto'); //Modifica en la base de datos el proyecto actual seleccionado por el usuario.

    Route::get("listar_proyectos","ProyectosController@listar");

    Route::get('listar_categorias','CategoriasController@listar');
    Route::post("categorias/filtro","CategoriasController@filtrar");

    Route::get('listar_permisos','PermisosController@listar');
    Route::post("permisos/filtro","PermisosController@filtrar");
    Route::get("consultar_permisos/{uri}","PermisosController@consultarPermisos");

    Route::get('listar_pantallas','PantallaController@listar');
    Route::post("pantallas/filtro","PantallaController@filtrar");

    Route::get('listar_menus', 'MenuController@listar');
    Route::get('menus_disponibles', 'MenuController@menusSinAsignar');
    Route::post("menus/filtro","MenuController@filtrar");

    Route::get('listar_niveles','NivelController@listar');
    Route::post("niveles/filtro","NivelController@filtrar");

    Route::get('get_options_proyects',"ProyectosController@optionsSelect");

    Route::get('listar_asignaciones/{userId}', 'UserProjectController@listar');
    Route::post('listar_asignaciones/filtro', 'UserProjectController@filtrar');

    Route::post("usuarios/filtro","UsuariosController@filtrar");
});

