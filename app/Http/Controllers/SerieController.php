<?php

namespace App\Http\Controllers;

use App\Models\serie;
use App\Models\pelicula;
use App\Models\UsuarioSerie;
use App\Models\User;
use App\Http\Requests\SerieCreateRequest;
use App\Http\Requests\SerieEditRequest;
use Illuminate\Http\Request;
use App\Models\Imagenes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class SerieController extends Controller
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
         $this->middleware('verified')->only('index','show');
         $this->middleware('admin')->only('create','edit','recuperarSerie','destroy');
     }
     
     
     
    public function index()
    
    
    {
            $data = [];

        $data['peliculas'] = pelicula::select("*")->where('deleted_at', null)->paginate(6);
        $data['series']  = serie::paginate(6);
        $data['busqueda'] = null;
        if(pelicula::select("*")->where('deleted_at', null)->exists()):
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get(); 
        else:
            
            $data['ultimasPelis'] = null;
        endif;       
                        
        return view('peliculas.pelis',$data);
   
    }
    
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
 

     
    public function create()
    {
       
        $data = [];
        
        $data['categorias'] = ['Terror','Accion','Animacion','Ciencia Ficcion','Suspense','Drama','Comedia'];
        
        $data['edades'] = ['APT','+9','+12','+16','+18'];
        
        $data['espremium'] = ['estandar','premium'];
        
        if(pelicula::select("*")->where('deleted_at', null)->exists()):
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get();
        endif;                
        
        return view('series.create',$data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SerieCreateRequest $request)
    {
        
        $input = 'archivo';
        $data = [];
      
        $fechaActual = Carbon::now();
        $fechaActual = $fechaActual->format('Y-m-d');
 
        

        
       
    
        
        $serie = new serie($request->all());
       
        $serie->fecha = $fechaActual;
     
        try {
            
            $result = $serie->save();
            
            /*-------------------------------------------------Imagen-Pelicula*/
            if($result){
                 if($request->hasFile($input) && $request->file($input)->isValid()) {
                         
                         $archivo = $request->file($input);
                         $this->subirImg($serie,$archivo);
                      
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
    
    
    private function subirImg( $serie, $archivo){
        
        
                         $nombre = $archivo->getClientOriginalName();
                            
                        
                                $data=[];//creas un array donde metes los datos
                                $data['nombreArchivo']= $this->createId().'.'.$archivo->getClientOriginalExtension();//crear nombre unico para la imagen
                                $data['nombreImagen']= $archivo->getClientOriginalName();
                                $data['mimeType']= 'image/'.$archivo->getClientOriginalExtension();
                                $data['id_pelicula']= null;
                                $data['id_usuario']= null;
                                $data['id_serie']= $serie->id;
                                DB::update('update series set extensionImg = :nombreArchivo where id = :id', ['nombreArchivo' => $data['nombreArchivo'],'id' => $serie->id]);
                                $img= new Imagenes( $data);
                                $img->save();//guardas la imagen
                                $archivo->storeAs('public/ImgSeries', $data['nombreArchivo']);
                                
        
    }
    
    
    private function updateImg( $serie, $archivo ){
        
        $input = 'archivo';
        
        
        
       
        if(Imagenes::select("*")->where("id_serie", $serie->id)->exists()){  // esta seccion de codigo es para actualizar la foto de perfil de dicho empleado si ya a subido una foto
            
            
            $imgNombre = Imagenes::select("nombreArchivo")->where("id_serie", $serie->id)->get();
              
               $img = DB::table('imagenes')
                        ->where('id_serie', $serie->id)
                        ->select('nombreArchivo')
                        ->first();
                        
                        
                        
               if( Storage::exists('/public/ImgSeries/' . $img->nombreArchivo)){
               
                   Storage::delete('/public/ImgSeries/' . $img->nombreArchivo);
                
               }
               
             try{
                  
                    $nombre = $archivo->getClientOriginalName();
                    $data=[];
                    $data['nombreArchivo']= $this->createId().'.'.$archivo->getClientOriginalExtension();
                    $data['nombreImagen']= $archivo->getClientOriginalName();
                    $data['mimeType']= 'image/'.$archivo->getClientOriginalExtension();
                    DB::update('update imagenes set nombreArchivo = :nombreArchivo , nombreImagen = :nombreImagen , mimeType = :mimeType  where id_serie = :id', ['nombreArchivo' => $data['nombreArchivo'],'nombreImagen' => $data['nombreImagen'],'mimeType'
                    => $data['mimeType'],'id' => $serie->id]);
                    DB::update('update series set extensionImg = :nombreArchivo  where id = :id', ['nombreArchivo' => $data['nombreArchivo'],'id' => $serie->id]);
                   
                $archivo->storeAs('public/ImgSeries', $data['nombreArchivo']);
                
                }
                catch(\Exception $e){
                   
                    return back()->with($data);
                }
            
        }
        
        
        
    }
    
    
    public function addSerieVista(Request $request){
        
        $user = User::find(auth()->user()->id);
        $data = [];
        $isExist = UsuarioSerie::select("*")->where("id_usuario", auth()->user()->id)->exists();
        $usuarioList =  UsuarioSerie::select("*")->get();  
        $usuarioCount = $usuarioList->count();
        $serie = serie::find($request->peliculaId);
    
       if($user->espremium == 'premium' && $serie->espremium == 'premium' || $serie->espremium == 'estandar'):
       if($isExist){
           
           $isExistPelicula = UsuarioSerie::select("*")->where("id_usuario", auth()->user()->id)->where('id_serie',$request->peliculaId)->exists();
           
           $cantidad = UsuarioSerie::select("*")->where("id_usuario", auth()->user()->id)->where('id_serie',$request->peliculaId)->first();
          
           if($isExistPelicula){
               
                DB::update('update usuarioSeries set cantidad_veces = :cantidad where id_serie = :idpelicula and id_usuario = :idusuario', 
                ['cantidad' => $cantidad->cantidad_veces + 1 ,'idpelicula' => $request->peliculaId,'idusuario' => auth()->user()->id]);
               
           }else{
              
                        $data['id_usuario'] = auth()->user()->id;  
                        $data['id_serie'] = $request->peliculaId;
                        $data['cantidad_veces'] = 1;
                        
                        $usuarioPelicula = new UsuarioSerie($data);
                        $usuarioPelicula->id = $usuarioCount + 1 ;
                        try{
                            $usuarioPelicula->save();
                         
                        }
                        catch(\Exception $e){
                                    return back()->with();
                        }
                
           }
           
           
       }else{
    
               
                $data['id_usuario'] = auth()->user()->id;  
                $data['id_serie'] = $request->peliculaId;
                $data['cantidad_veces'] = 1;
               
                $usuarioPelicula = new UsuarioSerie($data);
                $usuarioPelicula->id = $usuarioCount + 1;
             
                try{
                    $usuarioPelicula->save();
                    
             
                   
                }
                catch(\Exception $e){
                            return back()->with();
                }
               
          
           
       }
        elseif($serie->espremium != $user->espremium):
                  
                    return  back()->withInput()->withErrors(['generico' => 'No puedes ver una serie de tipo premium, tienes que cambiar de paquete']);
                  
         endif;
              
       return redirect('serie/'.$request->peliculaId);
        
        
        
    }
    
    public function database(){
        
        
         $data = [];

        $data['peliculas'] = pelicula::all();
        if(pelicula::select("*")->where('deleted_at', null)->exists()):
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get();
        endif;       
                        
        return view('peliculas.index',$data);
    }

    
    
  
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function show(serie $serie)
    
    {   if(pelicula::select("*")->where('deleted_at', null)->exists()):
        
           $ultimasPelis = DB::table('peliculas')->where('deleted_at', null)
                            ->select('*')->limit(3)->get();
                            
                  $seriesRelacionadas = DB::table('series')
                        ->where('id','<>' , $serie->id)->where('deleted_at', null)
                        ->where( 'categoria', '=', $serie->categoria)
                        ->select('*')->get();           
                            
        endif;  
         if(Auth::check()){
            
             $serieUsuario = UsuarioSerie::select("*")->where('id_serie', $serie->id)->where('id_usuario', auth()->user()->id)->first();
        }else{
            
            $serieUsuario = null;
            
        }
     
                     
        return view('series.show', [ 'serie' => $serie, 'seriesR' => $seriesRelacionadas,'ultimasPelis' => $ultimasPelis,'serieUsuario' => $serieUsuario]);
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
     * @param  \App\Models\serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit(serie $serie)
    {
       
        $data = [];
        
        $data['serie'] = $serie;
        $data['categorias'] = ['Terror','Accion','Animacion','Ciencia Ficcion','Suspense','Drama','Comedia'];
        
        $data['edades'] = ['APT','+9','+12','+16','+18'];
        
        $data['espremium'] = ['estandar','premium'];
        
         if(pelicula::select("*")->where('deleted_at', null)->exists()):
            $data['ultimasPelis'] = DB::table('peliculas')->where('deleted_at', null)->select('*')->limit(3)->get();
        endif;       
        
        return view('series.edit', $data);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(SerieEditRequest $request, serie $serie)
    {
        $data = [];
        $input = 'archivo';
        $fechaActual = Carbon::now();  //obtenemos la fecha actual con carbon
        $fechaActual = $fechaActual->format('Y-m-d');  
         
         
         
        $serie->fecha = $fechaActual;
     
        try {
            
            $result = $serie->update($request->all());
            
            /*-------------------------------------------------Imagen-Pelicula*/
            if($result){
                 if($request->hasFile($input) && $request->file($input)->isValid()) {
                         
                         $archivo = $request->file($input);
                         $this->updateImg($serie,$archivo);
                      
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
     * @param  \App\Models\serie  $serie
     * @return \Illuminate\Http\Response
     */
     
     
     public function recuperarSerie($id){
         
      
         try {
            
            $result = DB::update('update series set deleted_at = :null  where id = :id', ['null' => null,'id' => $id]);
            
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
        $serie = serie::find($id);
        
        
         try {
            $serie->delete();
          
            
        } catch(Exception $e) {
             return back()->withInput()->with();
        }
        return redirect('datos');
        
        
        
    }
}
