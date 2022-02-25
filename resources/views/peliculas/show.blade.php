@extends('base')


@section('content')





<section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{ asset('storage/ImgPeliculas/'. $peliculas->extensionImg) }}">
                             @if($peliculas->espremium == 'premium')
                               <div class="tipo-pelicula">{{ $peliculas->espremium }}</div>
                            @endif
                          
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3 style="color:#e53637; text-transform:uppercase;">{{ $peliculas->titulo }}</h3>
                                <span style="text-transform:uppercase;">{{ $peliculas->studio }}</span>
                            </div>
                            <div class="anime__details__rating">
                                <div class="rating">
                                    @if($peliculas->puntaje == '5')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                    @endif
                                     @if($peliculas->puntaje == '4.5')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star-half-o"></i></a>
                                    @endif
                                    @if($peliculas->puntaje == '4')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                       
                                    @endif
                                    
                                     @if($peliculas->puntaje == '3.5')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star-half-o"></i></a>
                                  
                                       
                                    @endif
                                    @if($peliculas->puntaje == '3')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        
                                       
                                    @endif
                                     @if($peliculas->puntaje == '2.5')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star-half-o"></i></a>
                                        
                                       
                                    @endif
                                     @if($peliculas->puntaje == '2')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                       
                                        
                                       
                                    @endif
                                    
                                    @if($peliculas->puntaje == '1.5')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                       <a href="#"><i class="fa fa-star-half-o"></i></a>
                                       
                                        
                                       
                                    @endif
                                    
                                     @if($peliculas->puntaje == '1')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                     
                                       
                                        
                                       
                                    @endif
                                     @if($peliculas->puntaje == '0.5')
                                       <a href="#"><i class="fa fa-star-half-o"></i></a>
                                     
                                       
                                        
                                       
                                    @endif
                                    
                                </div>
                           
                            </div>
                            <p>{{ $peliculas->descripcion }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Tipo:</span> Pelicula</li>
                                            <li><span>Studios:</span> {{ $peliculas->studio }}</li>
                                            <li><span>Fecha de subida: </span> {{ $peliculas->fecha }}</li>
                                            <li><span>Edad:</span> {{ $peliculas->edad }} </li>
                                            <li><span>Genero:</span>{{ $peliculas->categoria }}, {{ $peliculas->categoria2 }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Puntaje:</span>{{ $peliculas->puntaje }}</li>
                                            <li><span>Duration:</span> {{ $peliculas->duracion }} min</li>
                                            
                                            <li><span>Calidad:</span> HD</li>
                                            @if(Auth::check())
                                                @if($peliculaUsuario != null)
                                                
                                                    <li><span>Cantidad de veces vista:</span>{{ $peliculaUsuario->cantidad_veces }}</li>
                                                    
                                              @endif
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                            
                                
                            @if(Auth::check())    
                              <form method="post" action="{{ route('pelicula.vista') }}">
                                  @csrf
                                  @method('post')
                                  <input type="number" name="usuarioId" value="{{ auth()->user()->id }}" hidden/>
                                  <input type="number" name="peliculaId" class="@error('generico') is-invalid @enderror" value="{{ $peliculas->id }}" hidden/>
                                  
                                   @error('generico') 
            
                                            <span class="invalid-feedback" role="alert">
                                                <strong style="margin-left:45%">{{ $message }}</strong>
                                            </span>
                                    
                              
                                     @enderror       
                                    <button type="submit" class="watch-btn btn-ver-pelicula"> Ver ahora<i
                                    class="fa fa-angle-right"></i></button>
                                
                              </form>
                            @endif  
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" >
                    
                    <div class="col-lg-6 col-md-4" style="margin:0 auto;">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>Peliculas Relacionadas</h5>
                            </div>
                            @foreach($pelisR as $pelis)
                            <a href="{{url('pelicula/ ' . $pelis->id)}}">
                                <div class="product__sidebar__view__item set-bg" data-setbg="{{ asset('storage/ImgPeliculas/'. $pelis->extensionImg) }}">
                                    <div class="ep">{{ $pelis->edad }}</div>
                                    <div class="view"><i class="icon_clock"></i> {{ $pelis->duracion }}</div>
                                    <h5><a href="{{url('pelicula/ ' . $pelis->id)}}" style="color:#e53637; text-transform:uppercase;">{{ $pelis->titulo }}</a></h5>
                                </div>
                            </a>
                           @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>



@endsection