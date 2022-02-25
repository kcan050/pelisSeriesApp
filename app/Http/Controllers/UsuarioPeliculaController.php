<?php

namespace App\Http\Controllers;

use App\Models\UsuarioPelicula;
use App\Models\User;
use App\Models\pelicula;
use App\Models\Imagenes;
use Illuminate\Http\Request;
use App\Http\Requests\userEditRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class UsuarioPeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     public function __construct(){
      
        $this->middleware('guest')->only('index');
        $this->middleware('verified')->only('perfil','editUser','userupdate');
        $this->middleware('bloquear')->only('create','store','show','edit','update');
        $this->middleware('admin')->only('darPrivilegios','recuperarUsuario','destroy');
    }
    
    
    public function index()
    {
        $data = [];
        $data['espremium'] = ['estandar','premium'];
        if(pelicula::select("*")->where('deleted_at', null)->exists()){
            
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
        }else{
             $data['ultimasPelis'] = null;
            
        }
       
        return view('auth.register',$data);
    }




    public function perfil(){
        
        
       $data = [];
       
         if(pelicula::select("*")->where('deleted_at', null)->exists()){
            
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
        }else{
             $data['ultimasPelis'] = null;
            
        }
        
        if(Auth::check()){
            
               $data['pelisR'] = DB::table('peliculas')
                             ->select("peliculas.*")
                            ->join('usuarioPeliculas', 'usuarioPeliculas.id_pelicula', '=', 'peliculas.id')
                            ->join('users', 'usuarioPeliculas.id_usuario', '=', 'users.id')
                            ->where('users.id', '=', auth()->user()->id)
                            ->where('peliculas.deleted_at', null)
                            ->get();
              $data['seriesR'] = DB::table('series')
                             ->select("series.*")
                            ->join('usuarioSeries', 'usuarioSeries.id_serie', '=', 'series.id')
                            ->join('users', 'usuarioSeries.id_usuario', '=', 'users.id')
                            ->where('users.id', '=', auth()->user()->id)
                            ->where('series.deleted_at', null)
                            ->get();
                           
        }
     
        return view('users.perfil',$data);
        
    }
    
    
 
    
    public function database(){
        
        $data = [];
        
        $data['users'] = User::all();
        

       
        if(pelicula::select("*")->where('deleted_at', null)->exists()){
            
            $data['ultimasPelis'] =  DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
        }else{
             $data['ultimasPelis'] = null;
            
        }
        
        return view('users.index',$data);
        
    }
    
    
     public function editUser($id)
    {
        $user = User::find($id);
         if(pelicula::select("*")->where('deleted_at', null)->exists()){
            
            $ultimasPelis =  DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
        }else{
             $ultimasPelis = null;
            
        }
        $espremium = ['premium','estandar'];
         return view('users.edit', ['user' => $user, 'espremium' => $espremium, 'ultimasPelis' => $ultimasPelis]);
         
    }
    
    
      public function userupdate(userEditRequest $request)
    {
        
        
        if($request->password != null && $request->oldpassword != null){
           $r =  Hash::check($request->oldpassword, auth()->user()->password);
            if($r){
                
                $this->userSave($request,true);
                
            }else{
            
             return  back()->withInput()->withErrors(['oldpassword' => 'La clave de acceso anterior no es correcta.']);
            }
            
        }elseif($request->password == null && $request->oldpassword == null){
          
           $this->userSave($request,false);
             
        }else{
          return  back()->withInput()->withErrors(['generico' => 'A ingresado datos incorrectos']);
        }
        
        
        return redirect('perfil');
        
    }
    
    
    
    
    private function userSave(Request $request,$isNewPassword){
        $result = true;
        $user = auth()->user();
        $user->name = $request->input('name');
    
        if($user->email != $request->input('email')){
            
             $user->email = $request->input('email');
             $user->email_verified_at = null;
             
        }
        if($isNewPassword){
             $user->password = Hash::make($request->input('password'));
        }
        if($user->espremium != $request->espremium){
            
            $user->espremium = $request->input('espremium');
            
        }
        
        if($request->archivo != null){
            
            $this->updateImg($user, $request->archivo);
            
            
            
        }
        
        try{
            
             $user->save();
             $user->sendEmailVerificationNotification();
             
        }catch(\Exception $e){
            $result = false;
            return  back()->withInput()->with();
        }
        
        return $result;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     private function updateImg( $user, $archivo ){
        
        $input = 'archivo';
        
        
        
       
        if(Imagenes::select("*")->where("id_usuario", $user->id)->exists()){  // esta seccion de codigo es para actualizar la foto de perfil de dicho empleado si ya a subido una foto
            
            
            $imgNombre = Imagenes::select("nombreArchivo")->where("id_usuario", $user->id)->get();
              
               $img = DB::table('imagenes')
                        ->where('id_usuario', $user->id)
                        ->select('nombreArchivo')
                        ->first();
                        
                        
                        
               if( Storage::exists('/public/ImgUsuarios/' . $img->nombreArchivo)){
               
                   Storage::delete('/public/ImgUsuarios/' . $img->nombreArchivo);
                
               }
               
             try{
                  
                    $nombre = $archivo->getClientOriginalName();
                    $data=[];
                    $data['nombreArchivo']= $this->createId().'.'.$archivo->getClientOriginalExtension();
                    $data['nombreImagen']= $archivo->getClientOriginalName();
                    $data['mimeType']= 'image/'.$archivo->getClientOriginalExtension();
                    DB::update('update imagenes set nombreArchivo = :nombreArchivo , nombreImagen = :nombreImagen , mimeType = :mimeType  where id_usuario = :id', ['nombreArchivo' => $data['nombreArchivo'],'nombreImagen' => $data['nombreImagen'],'mimeType'
                    => $data['mimeType'],'id' => $user->id]);
                    DB::update('update users set extensionImg = :nombreArchivo  where id = :id', ['nombreArchivo' => $data['nombreArchivo'],'id' => $user->id]);
                 
                $archivo->storeAs('public/ImgUsuarios', $data['nombreArchivo']);
                
                }
                catch(\Exception $e){
                   
                    return back()->with($data);
                }
            
        }
        
        
        
    }
    
    public function darPrivilegios($id){
        
        $user = User::find($id);
        
        if($user->rol == 'admin'){
            
            
             return  back()->withInput()->withErrors(['generico' => 'Este usuario ya es admin']);
            
        }else{
            
             try{
      
                   DB::update('update users set rol = :rol  where id = :id', ['rol' => 'admin','id' => $id]);
        
                }
                catch(\Exception $e){
                   
                    return back()->with($data);
                }
            
            
        }
      
      return redirect('datos');
               
        
        
        
        
    }
     
    public function createId(){
        $x = 0;
        $y = 5;
        $Strings = '0123456789abcdefghijklmnopqrstuvwxyz';
        $random =substr(str_shuffle($Strings), $x, $y);
        $id = uniqid($random,true);
        return $id;
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsuarioPelicula  $usuarioPelicula
     * @return \Illuminate\Http\Response
     */
    public function show(UsuarioPelicula $usuarioPelicula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsuarioPelicula  $usuarioPelicula
     * @return \Illuminate\Http\Response
     */
    public function edit(UsuarioPelicula $usuarioPelicula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsuarioPelicula  $usuarioPelicula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsuarioPelicula $usuarioPelicula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsuarioPelicula  $usuarioPelicula
     * @return \Illuminate\Http\Response
     */
     
      public function recuperarUsuario($id){
         
        
         try {
            
            $result = DB::update('update users set deleted_at = :null  where id = :id', ['null' => null,'id' => $id]);
            
            /*-------------------------------------------------Imagen-Pelicula*/
       
              
              
        } catch(Exception $e) {
            $result = false;
        }
        if(!$result) {
      
            return back()->withInput()->with();
        }
        return redirect('datos');
         
         
         
         
     }
    public function destroy($id)
    {
            $user = User::find($id);
            $count = DB::table("users")->select("*")->count();
 
            if($user->id == auth()->user()->id){
                
                
                return  back()->withInput()->withErrors(['generico' => 'No puedes eliminarte a ti mismo']);
                
                
            }else{
                
               if($count == 1){
                   
                  
                 return  back()->withInput()->withErrors(['generico' => 'No puedes eliminar al ultimo usuario']);
                   
                   
                   
               }else{
                   
                   
                     try {
                         $user->delete();
                  
                    
                        } catch(Exception $e) {
                             return back()->withInput()->with();
                        }
                        return redirect('datos');  
                   
                   
               }
                
                
            }
            
           
    
    }
}
