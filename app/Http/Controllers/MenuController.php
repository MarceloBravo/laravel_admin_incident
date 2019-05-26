<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MenusRequest;
use App\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return "index";
        return view("mantenedores.menus");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenusRequest $request)
    {
        $menu = Menu::find($request['id']);
        if(is_null($menu)){
            $menu = new Menu();
            $msg = ["message-ok","El registro ha sido creado."];
        }else{
            $msg = ["message-ok","El registro ha sido actualizado."];
        }
        $menu->fill($request->all());
        $menu->save();
        
        return response()->json($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::find($id);
        return response()->json($menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "edit";
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
        /*
        $menu = Menu::find($id);
        if(is_null($menu)){
            $menu = new Menu();
            $msg = ["message-ok","El registro ha sido creado."];
        }else{
            $msg = ["message-ok","El registro ha sido actualizado."];
        }
        $menu->fill($request->all());
        $menu->save();
        
        return response()->json($msg);
         * */
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        
        return response()->json(["message-ok","El registro ha sido eliminado."]);
    }
    
    public function listar(){
        $menus = Menu::listar();
        return response()->json($menus);
    }   
    
    public function filtrar(Request $request){
        $filtro = $request['txtFiltro'];
        if($filtro == ""){
            $menus = Menu::listar();
        }else{
            $menus = Menu::filtrar($filtro);       
        }
        return response()->json($menus);
    }
    
    public function menusSinAsignar(){
        $menus = Menu::listarSinPantalla();
        return response()->json($menus);
    }
    
}
