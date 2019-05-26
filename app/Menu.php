<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * @property integer $id
 * @property string $nombre
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $menu_padre_id
 * @property string $ruta
 */
class Menu extends Model
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
    protected $fillable = ['nombre', 'created_at', 'updated_at', 'deleted_at', 'menu_padre_id', 'ruta', 'posicion'];
    
    public static function listar(){
        return DB::select("SELECT m.id, m.nombre, m.posicion, m.ruta, m2.nombre as menu_padre "
                . "FROM menus m "
                . "LEFT JOIN menus m2 ON m.menu_padre_id = m2.id");
    }
    
    public static function listarSinPantalla(){
        return DB::select("SELECT  m.id, m.nombre, m.posicion, m.ruta
                            FROM menus m 
                            WHERE m.id NOT IN 
                            (SELECT  m.id
                            FROM menus m 
                            INNER JOIN pantallas p ON m.id = p.menu_id)");
    }
    
    
    public static function filtrar($criterio){
        return DB::select("SELECT m.id, m.nombre, m.posicion, m.ruta, m2.nombre as menu_padre "
                . "FROM menus m "
                . "LEFT JOIN menus m2 ON m.menu_padre_id = m2.id "
                . "WHERE CONCAT(m.id, m.nombre, m.posicion, m.ruta, m2.nombre) LIKE :filtro",["filtro"=>"%".$criterio."%"]);
    }

    public static function getMenu()
    {
        $res = "";
        $arrMenus = Array();
        $menuQry = DB::select("SELECT m.id, m.nombre, m.ruta, m.posicion, (SELECT COUNT(*) FROM menus WHERE menu_padre_id = m.id) menus_hijos, m.menu_padre_id  
                            FROM menus m 
                            LEFT JOIN menus m2 ON m.menu_padre_id = m2.id 
                            WHERE m.menu_padre_id IS NULL");
        
        foreach($menuQry as $menu)
        {
            $subMenu = Menu::getSubMenus($menu->id);
            
            $menu = ["id"=>$menu->id,"nombre"=>$menu->nombre,"ruta"=>$menu->ruta,"posicion"=>$menu->posicion,"menus_hijos"=>$menu->menus_hijos,"submenu"=>$subMenu, "profundidad"=>0, "menu_padre_id"=>$menu->menu_padre_id];
            array_push($arrMenus, $menu); 
        }
        
        return $arrMenus;
    }
    
    
    private static function getSubMenus($id){
        $res = "";
        $arrMenus = Array();
        static $profundidad = 0;
        $profundidad++;
        $menuQry = DB::select("SELECT m.id, m.nombre, m.posicion, m.ruta, m.menu_padre_id, (SELECT COUNT(*) FROM menus WHERE menu_padre_id = m.id) menus_hijos, qry.*
                                FROM menus m 
                                LEFT JOIN (
                                SELECT 
                                    p.menu_id,
                                    p.nombre as pantalla, 
                                    pr.ver, 
                                    pr.crear, 
                                    pr.modificar, 
                                    pr.eliminar
                                FROM pantallas p 
                                LEFT JOIN permisos pr ON p.id = pr.pantalla_id 
                                WHERE pr.rol_id = ".Auth::user()->role_id."                                 
                                ) qry ON m.id = qry.menu_id
                                WHERE m.menu_padre_id = :id 
                                ORDER BY m.menu_padre_id, posicion
                                ", ["id"=>$id]);
        foreach($menuQry as $menu)
        {
            $subMenu = $menu->menus_hijos > 0 ? Menu::getSubMenus($menu->id) : "";
            $menu = ["id"=>$menu->id,"nombre"=>$menu->nombre,"ruta"=>$menu->ruta,"posicion"=>$menu->posicion,"submenu"=>$subMenu,"menus_hijos"=>$menu->menus_hijos,"profundidad"=>$profundidad, "menu_padre_id"=>$menu->menu_padre_id];
            array_push($arrMenus, $menu);
        }
        $profundidad--;
        return $arrMenus;
        
    }
}
