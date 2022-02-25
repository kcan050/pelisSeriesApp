<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfOldUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $url = $request->getPathInfo();
        $urlNormal = '/categoria/'.$request->categoria .'/'.$request->ordenar.'/'. $request->busqueda;
        $busqueda = $request->busqueda;
        
        
        
        
        
        if($request->categoria == 'titulo' || $request->categoria == 'categoria'){
                
                  
                if($request->ordenar == 'asc' || $request->ordenar == 'desc' ){
               
                if($busqueda == null){
                     $urlNormal = '/categoria/'.$request->categoria .'/'.$request->ordenar;
                     
                      if($url == $urlNormal){
                          
                          
                     
            
                                     return $next($request);
            
                              }else{
                                  
                                  
                                      return redirect('pelicula');
                              }
                          
                          
                      }else{
                          
                            if($url == $urlNormal){
                          
                          
                     
            
                                     return $next($request);
            
                              }else{
                                  
                                  
                                      return redirect('pelicula');
                              }
                          
                      }
                        
                    
                }else{
                         
                    return redirect('pelicula');
                    
                    
                } 
       
            
        }else{
            
            
            
             
               return redirect('pelicula');
            
            
        }   
        
   
        
        
        
     
        
       
        
        
        
    
       
    }
}
