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
class Rol extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'roles';

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
    
    public static function filtro($criterio){
        return DB::select("SELECT id, nombre FROM roles WHERE nombre LIKE :nombre",["nombre"=>"%".$criterio."%"]);
    }
    /*
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    */
    
    public function permisos()
    {
        return $this->belongsTo('App\Permiso','rol_id')->get();
    }
}
