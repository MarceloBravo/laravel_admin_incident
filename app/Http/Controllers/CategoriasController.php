<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;
use App\Categoria;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view("mantenedores.categorias");
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
    public function store(CategoriaRequest $request)
    {
        return response()->json($this->grabar($request, 0));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);
        return response()->json($categoria->toArray());
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
    public function update(CategoriaRequest $request, $id)
    {
        return response()->json($this->grabar($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();
        return response()->json(["message-ok","El registro ha sido eliminado."]);
    }
    
    
    /*
    public function listar($proyecto_id = null){
        if(is_null($proyecto_id))
        {
            $categorias = Categoria::all();
        }else{
            $categorias = Categoria::where('proyecto_id', $proyecto_id)->get();
        }
        return response()->json($categorias->toArray());
    }
    */
    
    public function listar(){       
        $categorias = Categoria::all();
        return response()->json($categorias->toArray());
    }
    
    
    
    private function grabar(CategoriaRequest $request, $id)
    {
        $categoria = Categoria::find($id);
        if(is_null($categoria)){
            $categoria = new Categoria();
            $resp = ["message-ok","El registro ha sido creado."];
        }else{
            $resp = ["message-ok","El registro ha sido actualizado."];
        }
        $categoria->fill($request->all())->save();
        
        return $resp;
    }
    
    
    public function filtrar(Request $request){
        $filtro = $request['txtFiltro'];
        if($filtro == ""){
            $resp = Categoria::all();            
        }else{
            $resp = Categoria::filtro($filtro);
        }
        return response()->json($resp);
    }
    
}
