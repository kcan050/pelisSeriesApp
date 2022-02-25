<?php

namespace App\Models;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class pelicula extends Model
{
    use HasFactory,SoftDeletes;
    
    
    
    protected $table = 'peliculas';
    
    protected $fillable = ['titulo', 'fecha', 'duracion','studio', 'puntaje', 'extensionImg','descripcion', 'espremium','categoria','categoria2','edad'];
    

    
   
    
    public function usuario_pelicula() {
        return $this->hasMany('App\Models\UsuarioPelicula', 'id_pelicula');
    }
}
