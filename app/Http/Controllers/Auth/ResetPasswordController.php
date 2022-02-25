<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::INDEX;
    
    
    
    
     public function index(){
        
        
        $data = [];
        
         if(pelicula::select("*")->where('deleted_at', null)->exists()):
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
           else:
                
               $data['ultimasPelis']  = null;
            endif;   
        
        return view('auth.passwords.reset',$data);
    }
}
