<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property int $user_id
 * @property int $nivel_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class UserProject extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user_project';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'nivel_id', 'proyecto_id', 'created_at', 'updated_at', 'deleted_at'];
    
    public static function listarAsignaciones($userId)
    {
        return DB::select("SELECT up.id, p.nombre proyecto, n.nombre nivel 
                            FROM user_project up 
                            INNER JOIN proyectos p ON up.proyecto_id = p.id 
                            INNER JOIN niveles n ON up.nivel_id = n.id 
                            WHERE up.deleted_at IS NULL
                            AND up.user_id = :userId",["userId"=>$userId]);
    }
    
    public static function filtro($criterio, $userId)
    {
        return DB::select("SELECT up.id, p.nombre proyecto, n.nombre nivel 
                            FROM user_project up 
                            INNER JOIN proyectos p ON up.proyecto_id = p.id 
                            INNER JOIN niveles n ON up.nivel_id = n.id 
                            WHERE up.deleted_at IS NULL 
                            AND up.user_id = :userId
                            AND CONCAT(p.nombre, n.nombre) LIKE :filtro",["userId"=>$userId,"filtro"=>"%".$criterio."%"]);
    }
}
