<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $titulo
 * @property string $descripcion
 * @property string $severidad
 * @property int $categoria_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $nivel_id
 * @property int $cliente_id
 * @property int $soporte_id
 */
class Incidente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'incidencias';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['titulo', 'descripcion', 'severidad', 'categoria_id', 'created_at', 'updated_at', 'deleted_at', 'nivel_id', 'cliente_id', 'soporte_id'];

}
