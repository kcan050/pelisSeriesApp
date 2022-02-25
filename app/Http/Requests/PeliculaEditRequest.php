<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeliculaEditRequest extends FormRequest
{
    
     function attributes() {
        return [
            'titulo'  => 'titulo de la pelicula',
            'duracion'    => 'duracion de la pelicula',
            'puntaje'      => 'puntaje de la pelicula',
            'studio'      => 'estudio de la pelicula',
            'archivo'    => 'flyer de la pelicula',
            'descripcion' => 'descripcion de la pelicula'
        ];
    }
    
    
    
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }



    function messages() {
        
        $max = 'El campo :attribute no puede tener más de :max caracteres.';
        $min = 'El campo :attribute no puede tener menos de :min caracteres.';
        $required = 'El campo :attribute es obligatorio.';
        $unique   = 'El campo :attribute debe ser único en la tabla de peliculas.';
        $regex  = 'El campo :attribute no es un :attribute valido.';
        $numeric = 'El campo :attribute tiene que ser numerico.';
        $in = 'El campo :attribute no existe';
        $mime = 'No sirve ese formato.';
        $file = 'No es una imagen valida.';
        return [
            
            'studio.max'            => $max,
            'studio.min'            => $min,
            'duracion.max'          => $max,
            'duracion.min'          => $min,
            'duracion.numeric'      => $numeric,
            'puntaje.numeric'      => $numeric,
            'puntaje.in'            => $in,
            'titulo.required'       => $required,
            'duracion.required'    => $required,
            'puntaje.required'        => $required,
            'studio.required'     => $required,
            'titulo.unique'         => $unique,
            'categoria.required' => $required,
            'categoria.in' => $in,
       
            'categoria2.required' => $required,
            'categoria2.in' => $in,
        
            'edad.required' => $required,
            'edad.in' => $in,
             'espremium.in' => $in,
            'espremium.required' => $required,
            'archivo.max'  => $max,
            'archivo.mime'  => $mime,
            'archivo.file'  => $file,
            'descripcion.min' => $min,
            'descripcion.max' => $max
        ];
    }




    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
    {
    
        return [
            
             'titulo'     => 'required|unique:peliculas,titulo,' . $this->pelicula->id ,
             'duracion' => 'required|numeric|min:15|max:420',
             'puntaje' => 'required|numeric|min:0.5|in:0.5,1,1.5,2,2.5,3,3.5,4,4.5,5|max:5' ,
            'categoria' => 'required|in:Terror,Accion,Animacion,Ciencia Ficcion,Suspense,Drama,Comedia',
            'categoria2' => 'required|in:Terror,Accion,Animacion,Ciencia Ficcion,Suspense,Drama,Comedia',
            'edad' => 'required|in:APT,+9,+12,+16,+18',
            'espremium' => 'required|in:estandar,premium',
             'studio'   => 'required|min:2|max:30',
             'archivo' => 'mimes:jpg,png,jpge|file|max:2000',
             'descripcion' => 'required|min:3|max:1000'
            
        ];
    }
}
