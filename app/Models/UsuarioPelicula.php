<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioPelicula extends Model
{
    use HasFactory;
    
    
    protected $table = 'usuarioPeliculas';
    
    protected $fillable = ['id_usuario', 'id_pelicula','cantidad_veces'];
    
    
    public function peliculas() {
        return $this->hasMany('App\Models\pelicula', 'id');
    }
    public function usuarios() {
        return $this->hasMany('App\Models\User', 'id_usuario');
    }
}
