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
class Proyecto extends Model
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
    protected $fillable = ['nombre', 'descripcion', 'fecha_inicio', 'created_at', 'updated_at', 'deleted_at'];
    
    public static function filtro($criterio){
        return DB::select("SELECT id, nombre, descripcion, date_format(fecha_inicio,'%d/%m/%Y') fecha_inicio, created_at, updated_at "
                . "FROM proyectos "
                . "WHERE deleted_at IS NULL AND "
                . "CONCAT(nombre, descripcion, fecha_inicio, created_at, ' ', updated_at) LIKE :filtro", ["filtro"=>"%".$criterio."%"]);
    }
    
    public static function listar(){
        return DB::select("SELECT id, nombre, descripcion, date_format(fecha_inicio,'%d/%m/%Y') fecha_inicio, created_at, updated_at "
                . "FROM proyectos "
                . "WHERE deleted_at IS NULL");
    }
    
}
