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
class Nivel extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'niveles';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'created_at', 'updated_at', 'deleted_at'];

    
    public static function filtro($criterio)
    {
        return DB::select("SELECT id, nombre FROM niveles WHERE deleted_at IS NULL AND nombre LIKE :filtro",["filtro"=>"%".$criterio."%"]);
    }
}
