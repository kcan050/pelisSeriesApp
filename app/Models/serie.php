<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class serie extends Model
{
    use HasFactory,SoftDeletes;
    
    
     protected $table = 'series';
    
    protected $fillable = ['titulo', 'fecha', 'duracion','studio', 'puntaje', 'extensionImg','descripcion','temporadas', 'espremium','categoria','categoria2','edad','id_usuario_serie'];
    
    
    
    
    public function usuario_serie() {
        return $this->hasMany('App\Models\UsuarioSerie', 'id_usuario_serie');
    }
}
