<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $incident_id
 * @property int $from_user_id
 * @property int $to_user_id
 * @property string $mensaje
 * @property string $created_at
 * @property string $updated_at
 */
class Chat extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'chat';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['incident_id', 'from_user_id', 'to_user_id', 'mensaje', 'created_at', 'updated_at'];

}
