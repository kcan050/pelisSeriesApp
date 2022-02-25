<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\DB;
use App\Models\pelicula;
class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::INDEX;

    /**
     * Create a new controller instance.
     *
     * @return void
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    
    
    
    
      public function index(){
        
        
        $data = [];
        
        if(pelicula::select("*")->exists()):
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get();
           else:
                
               $data['ultimasPelis']  = null;
            endif;           
        
        
        return view('auth.verify',$data);
    }
}
