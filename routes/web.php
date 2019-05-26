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

Route::group(['middleware'=>['auth','checkrol']],function(){
    Route::resource("incidencias","IncidenciasController");
    
    Route::resource("roles","RolesController");    
    Route::post("roles/filtro","RolesController@filtrar");
    
    Route::resource("usuarios","UsuariosController");
    Route::post("usuarios/filtro","UsuariosController@filtrar");
    
    Route::resource("proyectos","ProyectosController");
    Route::post("proyectos/filtro","ProyectosController@filtrar");
    Route::get("listar_proyectos","ProyectosController@listar");
    Route::get('get_options_proyects',"ProyectosController@optionsSelect");
    
    Route::resource('categorias','CategoriasController');
    Route::get('listar_categorias','CategoriasController@listar');
    Route::post("categorias/filtro","CategoriasController@filtrar");
    
    Route::resource('permisos','PermisosController');
    Route::get('listar_permisos','PermisosController@listar');
    Route::post("permisos/filtro","PermisosController@filtrar");
    
    Route::resource('pantallas','PantallaController');
    Route::get('listar_pantallas','PantallaController@listar');
    Route::post("pantallas/filtro","PantallaController@filtrar");
    
    Route::resource('menus','MenuController');
    Route::get('listar_menus', 'MenuController@listar');
    Route::get('menus_disponibles', 'MenuController@menusSinAsignar');
    Route::post("menus/filtro","MenuController@filtrar");
    
    Route::resource('incidencias' ,'IncidenciasController');
    
    Route::resource('niveles','NivelController');
    Route::get('listar_niveles','NivelController@listar');
    Route::post("niveles/filtro","NivelController@filtrar");
    
    Route::resource('asignar_proyecto', 'UserProjectController');
    Route::get('listar_asignaciones', 'UserProjectController@listar');
    
});

