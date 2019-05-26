<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Rol;
use App\Http\Controllers\MenuController;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function setPasswordAttribute($value){        
        $this->attributes['password'] = bcrypt($value);
    }
    
    public static function filtro($criterio){
        return DB::select("SELECT u.id, u.name, u.email, u.role_id, r.nombre as rol, u.created_at "
                . "FROM users u "
                . "INNER JOIN roles r ON u.role_id = r.id "
                . "WHERE u.deleted_at IS NULL AND CONCAT(u.name, ' ', u.email, ' ', r.nombre, ' ', u.created_at) "
                . "LIKE :filtro", ["filtro"=>"%".$criterio."%"]);
    }
    /*
    public function roles()
    {
        return $this->belongsToMany(Rol::class)->withTimestamps();
    }
    */
    /* Autenticación de roles */
    public function autorizarRol($rol_id)
    {
        abort_unless($this->hasRol($rol_id), 401);
        return true;
    }
    
    
    private function hasRol($rol_id)
    {
        return !is_null(Rol::find($rol_id));
    }
    
    public function menus(){
        $menus = Menu::getMenu();
        return $menus;
    }
}
