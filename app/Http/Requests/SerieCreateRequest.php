<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerieCreateRequest extends FormRequest
{
     function attributes() {
        return [
            'titulo'  => 'titulo de la serie',
            'duracion'    => 'duracion de la serie',
            'puntaje'      => 'puntaje de la serie',
            'studio'      => 'estudio de la serie',
            'archivo'    => 'flyer de la serie',
            'descripcion' => 'descripcion de la serie',
            'temporadas' => 'temporadas de la serie'
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
        $unique   = 'El campo :attribute debe ser único en la tabla de serie.';
        $regex  = 'El campo :attribute no es un :attribute valido.';
        $numeric = 'El campo :attribute tiene que ser numerico.';
        $in = 'El campo :attribute tiene que tener los valores indicados arriba.';
        $mime = 'No sirve ese formato.';
        $string = 'El campo :attribute no es un string valido';
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
             'espremium.in' => $in,
            'espremium.required' => $required,
            'edad.required' => $required,
            'edad.in' => $in,
            'edad.string' => $string,
            'archivo.max'  => $max,
            'archivo.mime'  => $mime,
            'archivo.file'  => $file,
            'descripcion.min' => $min,
            'descripcion.max' => $max,
            'temporadas.required' => $required
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
            
            'titulo'     => 'required|unique:series,titulo,' . $this->id ,
            'duracion' => 'required|numeric|min:15|max:420',
            'puntaje' => 'required|numeric|min:0.5|in:0.5,1,1.5,2,2.5,3,3.5,4,4.5,5|max:5' ,
            'categoria' => 'required|in:Terror,Accion,Animacion,Ciencia Ficcion,Suspense,Drama,Comedia',
            'categoria2' => 'required|in:Terror,Accion,Animacion,Ciencia Ficcion,Suspense,Drama,Comedia',
            'edad' => 'required|in:APT,+9,+12,+16,+18',
            'espremium' => 'required|in:estandar,premium',
            'studio'   => 'required|min:2|max:30',
             'archivo' => 'required|mimes:jpg,png,jpge|file|max:2000',
             'descripcion' => 'required|min:3|max:1000',
             'temporadas' => 'required'
            
        ];
    }
}
