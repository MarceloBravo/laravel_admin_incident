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
    protected $fillable = ['titulo', 'descripcion', 'severidad', 'categoria_id', 'proyecto_id', 'nivel_id', 'created_at', 'updated_at', 'deleted_at', 'nivel_id', 'cliente_id', 'soporte_id'];
        
    public function categoria()
    {
        return $this->belongsTo('App\Categoria')->first();
    }
    
    public function getSeveridadNombreAttribute()   //Crea una nueva propiedad o campo no físico llamado severidad_nombre (No es necesario definira nada en otra clase o modelo)
    {
        switch($this->severidad)
        {
            case "B":
                return "Baja";
            case "M":
                return "Media";
            default:
                return "Alta";
        }
    }
    
    public function getTituloCortoAttribute()
    {
        return mb_strimwidth($this->titulo,0,70,"...");
    }
    
    public function getNombreSoporteAttribute()
    {
        if(is_null($this->soporte()))
                return "Sin asignar";
        
        return $this->soporte()->name;
    }
    
    public function soporte()
    {
        return $this->belongsTo('App\User','soporte_id')->first(); //Retorna un objeto User
    }
    
    public function cliente()
    {
        return $this->belongsTo('App\User','cliente_id')->first(); //Retorna un objeto User
    }
    
    public function proyecto()
    {
        return $this->belongsTo('App\Proyecto')->first();
    }
    
    public function nivel()
    {
        return $this->belongsTo('App\Nivel')->first();
    }
    
    public function getEstadoAttribute()
    {
        if($this->activa)
        {
            return is_null($this->soporte_id) ? "Pendiente" : "En curso";
        }else{
            return "Finalizada";
        }
    }
    
    public function getInfoIncidenteAttribute()
    {
        return  [
                "titulo"=>$this->titulo, 
                "descripcion"=>$this->descripcion, 
                "categoria_id"=>$this->categoria_id,
                "categoria"=>$this->categoria()->nombre,
                "codigo_severidad"=>$this->severidad,
                "severidad"=>$this->getSeveridadNombreAttribute(),                
                "estado"=>$this->getEstadoAttribute(),
                "soporte"=>is_null($this->soporte()) ? "Sin asignar" : $this->soporte()->name
                    ];
    }
}
