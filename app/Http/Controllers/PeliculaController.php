<?php

namespace App\Http\Controllers;

use App\Models\pelicula;
use App\Models\UsuarioPelicula;
use App\Models\User;
use App\Models\serie;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PeliculaCreateRequest;
use App\Http\Requests\PeliculaEditRequest;
use Illuminate\Http\Request;
use App\Models\Imagenes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     public function __construct(){
         
        //  $this->middleware('guest')->only('database');
        //  $this->middleware('auth')->only('index');
        //  $this->middleware('auth')->only('show');
        $this->middleware('verified')->only('index','show','busqueda','ordenar');
        $this->middleware('admin')->only('datos','create','edit','destroy','recuperarPelicula');
     }
     
     
     
    public function index()
    
    
    {

        $data = [];

        $data['peliculas'] = pelicula::select("*")->where('deleted_at', null)->paginate(6, ['*'], 'peliculas')->appends(request()->except('peliculas'));
        $data['series']  = serie::paginate(6, ['*'], 'series')->appends(request()->except('series'));
        $data['busqueda'] = null;
        if(pelicula::select("*")->where('deleted_at', null)->exists()):
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
        else:
            
            $data['ultimasPelis'] = null;
        endif;       
                        
        return view('peliculas.pelis',$data);
    }
    
    
    public function ultimosRegistros(){
        
        if(pelicula::select("*")->where('deleted_at', null)->exists()):
            $ultimasPelis = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
          else:
            
            $ultimasPelis = null;
        endif;                        
                 
                        
            return view('base', ['ultimasPelis' => $ultimasPelis]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     
     public function addPeliculaVista(Request $request){
         
        $user = User::find(auth()->user()->id);
        $data = [];
        $isExist = UsuarioPelicula::select("*")->where("id_usuario", $request->usuarioId)->exists();
        $usuarioList =  UsuarioPelicula::select("*")->get();  
        $usuarioCount = $usuarioList->count();
        $pelicula = pelicula::find($request->peliculaId);
        if($user->espremium == 'premium' && $pelicula->espremium == 'premium' || $pelicula->espremium == 'estandar'):
      
               if($isExist){
                   
                   $isExistPelicula = UsuarioPelicula::select("*")->where("id_usuario", $request->usuarioId)->where('id_pelicula',$request->peliculaId)->exists();
                   
                   $cantidad = UsuarioPelicula::select("*")->where("id_usuario", $request->usuarioId)->where('id_pelicula',$request->peliculaId)->first();
                  
                   if($isExistPelicula){
                       
                        DB::update('update usuarioPeliculas set cantidad_veces = :cantidad where id_pelicula = :idpelicula and id_usuario = :idusuario', 
                        ['cantidad' => $cantidad->cantidad_veces + 1 ,'idpelicula' => $request->peliculaId,'idusuario' => $request->usuarioId]);
                       
                   }else{
                      
                                $data['id_usuario'] = $request->usuarioId;  
                                $data['id_pelicula'] = $request->peliculaId;
                                $data['cantidad_veces'] = 1;
                                
                                $usuarioPelicula = new UsuarioPelicula($data);
                                $usuarioPelicula->id = $usuarioCount + 1 ;
                                try{
                                    $usuarioPelicula->save();
                                 
                                }
                                catch(\Exception $e){
                                            return back()->with();
                                }
                        
                   }
                   
                   
               }else{
            
                       
                        $data['id_usuario'] = $request->usuarioId;  
                        $data['id_pelicula'] = $request->peliculaId;
                        $data['cantidad_veces'] = 1;
                       
                        $usuarioPelicula = new UsuarioPelicula($data);
                        $usuarioPelicula->id = $usuarioCount + 1;
                        try{
                            $usuarioPelicula->save();
                            
                     
                           
                        }
                        catch(\Exception $e){
                                    return back()->with();
                        }
                       
                  
                   
               }
              elseif($pelicula->espremium != $user->espremium):
                  
                    return  back()->withInput()->withErrors(['generico' => 'No puedes ver una pelicula de tipo premium, tienes que cambiar de paquete']);
                  
              endif;
       return redirect('pelicula/'.$request->peliculaId);
        
        
         
         
     }
     
     public function busqueda(Request $request){
         
         $data =[];
         $data['busqueda'] = null;
         
          
         
         if($request->input('busqueda') != null){
       
            
            $busqueda = trim($request->input('busqueda'));
            
            
            $data['peliculas'] = DB::table('peliculas')
            ->select('*')
            ->where('titulo','LIKE','%'. $busqueda .'%')
            ->orWhere('categoria','LIKE','%'. $busqueda .'%')
            ->orderBy('titulo', 'desc')
            ->paginate(6, ['*'], 'peliculas')->appends(request()->except('peliculas'));
            
             $data['series'] = DB::table('series')
            ->select('*')
            ->where('titulo','LIKE','%'. $busqueda .'%')
            ->orWhere('categoria','LIKE','%'. $busqueda .'%')
            ->orderBy('titulo', 'desc')
            ->paginate(6, ['*'], 'series')->appends(request()->except('series'));
            
            $data['busqueda'] = $request->input('busqueda') ;
            
            
        } else {
            
            $data['peliculas'] = DB::table('peliculas')
            ->select('*')
            ->orderBy('titulo', 'desc')
            ->paginate(6);
            
             $data['series'] = DB::table('series')
            ->select('*')
            ->orderBy('titulo', 'desc')
            ->paginate(6);
        }

        
       if(pelicula::select("*")->where('deleted_at', null)->exists()):
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
         else:
            
            $data['ultimasPelis']  = null;
        endif;           
                        
        return view('peliculas.pelis',$data);
         
         
     }
     
     
     public function ordenar($categoria,$ordenar,$busqueda = null){
         
        
         
         
         if($busqueda == null){
             
             $data['peliculas'] = DB::table('peliculas')
            ->select('*')
            ->orderBy($categoria, $ordenar)
            ->paginate(6 , ['*'], 'peliculas')->appends(request()->except('peliculas'));
            
            $data['series'] = DB::table('series')
            ->select('*')
            ->orderBy($categoria, $ordenar)
            ->paginate(6, ['*'], 'series')->appends(request()->except('series'));
             
           
            $data['busqueda'] = null;
             
         }else{
             
             
             $data['peliculas'] = DB::table('peliculas')
            ->select('*')
            ->where('titulo','LIKE','%'. $busqueda .'%')
            ->orWhere('categoria','LIKE','%'. $busqueda .'%')
            ->orderBy($categoria, $ordenar)
            ->paginate(6, ['*'], 'peliculas')->appends(request()->except('peliculas'));
            
             $data['series'] = DB::table('series')
            ->select('*')
            ->where('titulo','LIKE','%'. $busqueda .'%')
            ->orWhere('categoria','LIKE','%'. $busqueda .'%')
            ->orderBy($categoria, $ordenar)
            ->paginate(6, ['*'], 'series')->appends(request()->except('series'));
             
             $data['busqueda'] = $busqueda;
         }
        
         
          
       if(pelicula::select("*")->where('deleted_at', null)->exists()):
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
        else:
            
            $data['ultimasPelis']  = null;
        endif;           
                        
        return view('peliculas.pelis',$data);
         
         
         
     }
     
     
    public function create()
    {
       
        $data = [];
        
        $data['categorias'] = ['Terror','Accion','Animacion','Ciencia Ficcion','Suspense','Drama','Comedia'];
        
        $data['edades'] = ['APT','+9','+12','+16','+18'];
        
        $data['espremium'] = ['estandar','premium'];
        
        if(pelicula::select("*")->where('deleted_at', null)->exists()):
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
        else:
            
            $data['ultimasPelis']  = null;
        endif;                 
        
        return view('peliculas.create',$data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeliculaCreateRequest $request)
    {
        
        $input = 'archivo';
        $data = [];
      
        $fechaActual = Carbon::now();
        $fechaActual = $fechaActual->format('Y-m-d');
 
        

        
       
        
        
        $pelicula = new pelicula($request->all());
       
        $pelicula->fecha = $fechaActual;
     
        try {
            
            $result = $pelicula->save();
            
            /*-------------------------------------------------Imagen-Pelicula*/
            if($result){
                 if($request->hasFile($input) && $request->file($input)->isValid()) {
                         
                         $archivo = $request->file($input);
                         $this->subirImg($pelicula,$archivo);
                      
                      }
              }
              
              
        } catch(Exception $e) {
            $result = false;
        }
        if(!$result) {
      
            return back()->withInput()->with($data);
        }
        return redirect('pelicula')->with($data);
    }
    
    
    private function subirImg( $pelicula, $archivo){
        
        
           $nombre = $archivo->getClientOriginalName();
                            
                        
                                $data=[];//creas un array donde metes los datos
                                $data['nombreArchivo']= $this->createId().'.'.$archivo->getClientOriginalExtension();//crear nombre unico para la imagen
                                $data['nombreImagen']= $archivo->getClientOriginalName();
                                $data['mimeType']= 'image/'.$archivo->getClientOriginalExtension();//cogemos la extension y la concatenamos con la imagen
                                $data['id_pelicula']= $pelicula->id;
                                $data['id_usuario']= null;
                                $data['id_serie']= null;
                                DB::update('update peliculas set extensionImg = :nombreArchivo where id = :id', ['nombreArchivo' => $data['nombreArchivo'],'id' => $pelicula->id]);
                                $img= new Imagenes( $data);
                                $img->save();//guardas la imagen
                                $archivo->storeAs('public/ImgPeliculas', $data['nombreArchivo']);//lo metes en el storage
                                
        
    }
    
    
    private function updateImg( $pelicula, $archivo ){
        
        $input = 'archivo';
        
        
        
       
        if(Imagenes::select("*")->where("id_pelicula", $pelicula->id)->exists()){  // esta seccion de codigo es para actualizar la foto de perfil de dicho empleado si ya a subido una foto
            
            
            $imgNombre = Imagenes::select("nombreArchivo")->where("id_pelicula", $pelicula->id)->get();
              
               $img = DB::table('imagenes')
                        ->where('id_pelicula', $pelicula->id)
                        ->select('nombreArchivo')
                        ->first();
                        
                        
                        
               if( Storage::exists('/public/ImgPeliculas/' . $img->nombreArchivo)){
               
                   Storage::delete('/public/ImgPeliculas/' . $img->nombreArchivo);
                
               }
               
             try{
                  
                    $nombre = $archivo->getClientOriginalName();
                    $data=[];
                    $data['nombreArchivo']= $this->createId().'.'.$archivo->getClientOriginalExtension();
                    $data['nombreImagen']= $archivo->getClientOriginalName();
                    $data['mimeType']= 'image/'.$archivo->getClientOriginalExtension();
                    DB::update('update imagenes set nombreArchivo = :nombreArchivo , nombreImagen = :nombreImagen , mimeType = :mimeType  where id_pelicula = :id', ['nombreArchivo' => $data['nombreArchivo'],'nombreImagen' => $data['nombreImagen'],'mimeType'
                    => $data['mimeType'],'id' => $pelicula->id]);
                    DB::update('update peliculas set extensionImg = :nombreArchivo  where id = :id', ['nombreArchivo' => $data['nombreArchivo'],'id' => $pelicula->id]);
                   
                $archivo->storeAs('public/ImgPeliculas', $data['nombreArchivo']);
                
                }
                catch(\Exception $e){
                   
                    return back()->with($data);
                }
            
        }
        
        
        
    }
    public function database(){
        
        
         $data = [];

        $data['peliculas'] = pelicula::all();
        $data['series'] = serie::all();
        $data['usuarios'] = User::all();
        $data['peliculasBorradas'] = DB::table('peliculas')->where('deleted_at', '<>', null)->get();
        $data['usuariosBorrados'] = DB::table('users')->where('deleted_at', '<>', null)->get();
         $data['seriesBorradas'] = DB::table('series')->where('deleted_at', '<>', null)->get();
        if(pelicula::select("*")->where('deleted_at', null)->exists()):
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
       else:
            
            $data['ultimasPelis']  = null;
        endif;          
                        
        return view('peliculas.index',$data);
    }

    
    
  
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function show(pelicula $pelicula)
    
    {  
        
        if(Auth::check()){
            
             $peliculaUsuario = UsuarioPelicula::select("*")->where('id_pelicula', $pelicula->id)->where('id_usuario', auth()->user()->id)->first();
        }else{
            
            $peliculaUsuario = null;
            
        }
       
        if(pelicula::select("*")->where('deleted_at',null)->exists()):
        
           $ultimasPelis = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
                            
                  $pelisRelacionadas = DB::table('peliculas')
                        ->where('id','<>' , $pelicula->id)
                        ->where( 'categoria', '=', $pelicula->categoria)
                        ->select('*')->get();           
                            
        else:
            
            $ultimasPelis = null;
            $pelisRelacionadas = null;
        endif;     
        
     
                     
        return view('peliculas.show', [ 'peliculas' => $pelicula, 'pelisR' => $pelisRelacionadas,'ultimasPelis' => $ultimasPelis,'peliculaUsuario' => $peliculaUsuario]);
    }
    
    
    public function createId(){
        $x = 0;
        $y = 5;
        $Strings = '0123456789abcdefghijklmnopqrstuvwxyz';
        $random =substr(str_shuffle($Strings), $x, $y);
        $id = uniqid($random,true);
        return $id;
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function edit(pelicula $pelicula)
    {
        $data = [];
        
        $data['pelicula'] = $pelicula;
        $data['categorias'] = ['Terror','Accion','Animacion','Ciencia Ficcion','Suspense','Drama','Comedia'];
        
        $data['edades'] = ['APT','+9','+12','+16','+18'];
        
        $data['espremium'] = ['estandar','premium'];
        
         if(pelicula::select("*")->where('deleted_at', null)->exists()):
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
           else:
                
               $data['ultimasPelis']  = null;
            endif;           
        
        return view('peliculas.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function update(PeliculaEditRequest $request, pelicula $pelicula)
    {
        $data = [];
        $input = 'archivo';
        $fechaActual = Carbon::now();  //obtenemos la fecha actual con carbon
        $fechaActual = $fechaActual->format('Y-m-d');  
         
         
         
        $pelicula->fecha = $fechaActual;
     
        try {
            
            $result = $pelicula->update($request->all());
            
            /*-------------------------------------------------Imagen-Pelicula*/
            if($result){
                 if($request->hasFile($input) && $request->file($input)->isValid()) {
                         
                         $archivo = $request->file($input);
                         $this->updateImg($pelicula,$archivo);
                      
                      }
              }
              
              
        } catch(Exception $e) {
            $result = false;
        }
        if(!$result) {
      
            return back()->withInput()->with($data);
        }
        return redirect('datos')->with($data);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
     
     public function recuperarPelicula($id){
         
        
         try {
            
            $result = DB::update('update peliculas set deleted_at = :null  where id = :id', ['null' => null,'id' => $id]);
            
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
         $pelicula = pelicula::find($id);
         $users = User::all();
         $isExistPelicula = UsuarioPelicula::select("*")->where('id',$pelicula->id_pelicula_usuario)->exists();
        
         
        //  if(Imagenes::select("*")->where("id_pelicula", $pelicula->id)->exists()){  
                 
        //       $imgNombre = Imagenes::select("nombreArchivo")->where("id_pelicula", $pelicula->id)->get();
              
        //       $img = DB::table('imagenes')
        //                 ->where('id_pelicula', $pelicula->id)
        //                 ->select('*')
        //                 ->first();
                        
        //       $img = Imagenes::find($img->id);
                        
        //       if( Storage::exists('/public/ImgPeliculas/' . $img->nombreArchivo)){
               
        //           Storage::delete('/public/ImgPeliculas/' . $img->nombreArchivo);
                
        //       }
        //       try {
        //         $img->delete();
                
            
        //         } catch(Exception $e) {
        //              return back()->withInput()->with();
        //         }
        //       if($isExistPelicula){
                   
                   
        //          $usuarioPelicula =  UsuarioPelicula::find($pelicula->id_pelicula_usuario);
                 
                     
                 
        //          try{
                     
        //              $usuarioPelicula->delete();
                     
        //          }catch(Exception $e) {
        //                  return back()->withInput()->with();
        //             }
                    
                      
                    
        //           foreach($users as $user){
        //                  $isExistUsuario = UsuarioPelicula::select("*")->where('id_usuario',$user->id)->where('id_pelicula', $id)->exists();
                      
        //                 if($isExistUsuario){
                            
                            
                            
        //                 }else{
                            
        //                     DB::update('update users set id_usuario_pelicula = :id  where id = :idusuario', ['id' => null,'idusuario' => $user->id]);
        //                 }                        
                        
        //             } 
        //       }
                 
        //      }
        
         try {
            $pelicula->delete();
          
            
        } catch(Exception $e) {
             return back()->withInput()->with();
        }
        return redirect('datos');
    }
}
