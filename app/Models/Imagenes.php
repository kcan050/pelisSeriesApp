<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    use HasFactory;
    
    
    protected $table = 'imagenes';
    
    protected $fillable = ['nombreArchivo', 'nombreImagen', 'mimeType', 'id_usuario', 'id_pelicula' , 'id_serie'  ];
    
    public function peliculas() {
        return $this->belongsTo('App\Models\pelicula' , 'id_pelicula');
    }
    
    public function usuarios() {
        return $this->belongsTo('App\Models\User' , 'id_usuario');
    }
    
    public function series() {
        return $this->belongsTo('App\Models\serie' , 'id_serie');
    }
}
