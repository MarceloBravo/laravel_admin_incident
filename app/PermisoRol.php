<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $rol_id
 * @property int $permiso_id
 * @property string $created_at
 * @property string $updated_at
 */
class PermisoRol extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'permisos_rol';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['rol_id', 'permiso_id', 'created_at', 'updated_at'];

}
