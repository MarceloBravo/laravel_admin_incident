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
    protected $fillable = ['user_id', 'nivel_id', 'created_at', 'updated_at', 'deleted_at'];
}
