<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property string $nombre
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Pantalla extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'menu_id', 'created_at', 'boton_nuevo', 'boton_grabar', 'boton_eliminar', 'updated_at', 'deleted_at'];

    
    public static function listar(){
        return DB::select("SELECT "
                . "p.id, p.nombre, m.nombre as menu "
                . "FROM pantallas p "
                . "INNER JOIN menus m ON p.menu_id = m.id");
    }
    
    public static function filtro($criterio){
        return DB::select("SELECT "
                . "p.id, p.nombre, m.nombre as menu "
                . "FROM pantallas p "
                . "INNER JOIN menus m ON p.menu_id = m.id "
                . "WHERE CONCAT(p.nombre, m.nombre)  LIKE :filtro", ["filtro"=>"%".$criterio."%"]);
    }
}
