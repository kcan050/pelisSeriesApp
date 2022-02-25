<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioSerie extends Model
{
    use HasFactory;
    
    protected $table = 'usuarioSeries';
    
    protected $fillable = ['id_usuario', 'id_serie','cantidad_veces'];
    
    
    public function series() {
        return $this->hasMany('App\Models\serie', 'id_serie');
    }
    public function usuarios() {
        return $this->hasMany('App\Models\User', 'id');
    }
}
