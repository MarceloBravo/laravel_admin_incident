<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $proyecto_id
 * @property string $created_at
 * @property string $updated_at
 */
class Categoria extends Model
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
    protected $fillable = ['nombre', 'descripcion',  'created_at', 'updated_at'];

    public static function filtro($criterio){
        return DB::select("SELECT c.id, c.nombre, c.descripcion "
                . "FROM categorias c "                
                . "WHERE c.deleted_at IS NULL AND "
                . "CONCAT(c.nombre, ' ', c.descripcion) LIKE :filtro", ["filtro"=>"%".$criterio."%"]);
    }
    
}
