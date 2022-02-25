<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userEditRequest extends FormRequest
{
    function attributes() {
        return [
            'name'  => 'nombre usuario',
            'email'    => 'email usuario',
            'password'      => 'contraseña usuario',
            'archivo'    => 'foto del usuario',
           
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
        $unique   = 'El campo :attribute debe ser único en la tabla de usuarios.';
        $email  = 'El campo :attribute no es un :attribute valido.';
        
        $string = 'El campo :attribute tiene que ser string.';
        $mime = 'No sirve ese formato.';
        $file = 'No es una imagen valida.';
        return [
            
            'name.required'          => $required,
            'name.string'            => $string,
            'name.max'               => $max,
            'email.max'              => $max,
            'email.required'         => $required,
            'email.string'           => $string,
            'password.string'        => $string,
            'password.unique'        => $unique,
            'archivo.max'            => $max,
            'archivo.mime'           => $mime,
            'archivo.file'           => $file,
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
            
            'name'     => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . auth()->user()->id ,
            'password'   => '',
             'archivo' => 'mimes:jpg,png,jpge|file|max:2000',
          
            
        ];
        
           
    }
}
