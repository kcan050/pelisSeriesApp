<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Imagenes;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::INDEX;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'archivo' => ['required','mimes:jpg,png,jpge','file','max:2000']
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if(User::select("*")->exists()){
                    
                    $data['rol'] = 'user';
         }else{
                    
                    $data['rol'] = 'admin';
                }
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rol' => $data['rol'],
            'espremium' => $data['espremium']
        ]);
        
        
    }
    
    public function createId(){
        $x = 0;
        $y = 5;
        $Strings = '0123456789abcdefghijklmnopqrstuvwxyz';
        $random =substr(str_shuffle($Strings), $x, $y);
        $id = uniqid($random,true);
        return $id;
    }
    
    
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        
        
        $input = 'archivo';
        
        
        
        
        event(new Registered($user = $this->create($request->all())));
        
        /*------------------------------------------------------Subir archivo----------------------------------------*/
        
          if($request->hasFile($input) && $request->file($input)->isValid()) {
                         
                         $archivo = $request->file($input);
                    
                         $nombre = $archivo->getClientOriginalName();
                            
                        
                                $data=[];//creas un array donde metes los datos
                                $data['nombreArchivo']= $this->createId().'.'.$archivo->getClientOriginalExtension();//crear nombre unico para la imagen
                                $data['nombreImagen']= $archivo->getClientOriginalName();
                                $data['mimeType']= 'image/'.$archivo->getClientOriginalExtension();//cogemos la extension y la concatenamos con la imagen
                                $data['id_pelicula']= null;
                                $data['id_usuario']= $user->id;
                                $data['id_serie']= null;
                                DB::update('update users set extensionImg = :nombreArchivo where id = :id', ['nombreArchivo' => $data['nombreArchivo'],'id' => $user->id]);
                                $img= new Imagenes( $data);
                                $img->save();//guardas la imagen
                                $archivo->storeAs('public/ImgUsuarios', $data['nombreArchivo']);//lo metes en el storage
                                
                      }
        
        
            
         /*------------------------------------------------------Subir archivo----------------------------------------*/
     
        $request->session()->flash('register1',true);
        
        if ($response = $this->registered($request, $user)) {
            return $response;
        }
        
         


        return $request->wantsJson() ? new JsonResponse([], 201) : redirect($this->redirectPath());
                    
                    
    }
    
    
    
}
