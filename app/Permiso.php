<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property int $rol_id
 * @property boolean $ver
 * @property boolean $crear
 * @property boolean $modificar
 * @property boolean $eliminar
 * @property string $created_at
 * @property string $updated_at
 */
class Permiso extends Model
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
    protected $fillable = ['rol_id', 'pantalla_id', 'ver', 'crear', 'modificar', 'eliminar', 'created_at', 'updated_at'];

    public static function listar(){
        return DB::select("SELECT
                            r.id as rol_id, 
                            r.nombre as rol
                        FROM roles r");
    }
    
    
    public static function getPermisosPorRol($rolId){
        return DB::select("SELECT 
                                pr.id, 
                                qry.rol, 
                                qry.pantalla_id, 
                                qry.pantalla, 
                                qry.boton_nuevo, qry.boton_grabar, qry.boton_eliminar,
                                pr.ver, pr.crear, pr.modificar, pr.eliminar
                            FROM 
                                (SELECT 
                                p.id as pantalla_id, p.nombre as pantalla, 
                                p.boton_nuevo, p.boton_grabar, p.boton_eliminar,
                                r.id as rol_id, r.nombre as rol 
                                from pantallas p, roles r 
                                WHERE p.deleted_at IS NULL AND r.deleted_at IS NULL) as qry 
                            LEFT JOIN permisos pr ON pr.pantalla_id = qry.pantalla_id and pr.rol_id = qry.rol_id 
                            WHERE qry.rol_id = :id", ["id"=>$rolId]);
    }
    
    /*
    public static function buscar($id){
        $res = DB::select("SELECT prol.id, 
                                p.id, p.nombre, 
                                p.boton_nuevo, p.boton_grabar, p.boton_actualizar, p.boton_eliminar,
                                pr.ver, pr.crear, pr.modificar, pr.eliminar 
                            FROM pantallas p 
                            LEFT JOIN permisos pr ON p.id = pr.pantalla_id 
                            LEFT JOIN permisos_rol prol ON pr.rol_id = prol.permiso_id 
                            prol.id = :id",["id"=>$id]);
    }
     * 
     */
}
