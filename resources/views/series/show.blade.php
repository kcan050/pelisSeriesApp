@extends('base')


@section('content')





<section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{ asset('storage/ImgSeries/'. $serie->extensionImg) }}">
                            <div class="comment"><i class="fa fa-comments"></i> 11</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3 style="color:#e53637; text-transform:uppercase;">{{ $serie->titulo }}</h3>
                                <span style="text-transform:uppercase;">{{ $serie->studio }}</span>
                            </div>
                            <div class="anime__details__rating">
                                <div class="rating">
                                    @if($serie->puntaje == '5')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                    @endif
                                     @if($serie->puntaje == '4.5')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star-half-o"></i></a>
                                    @endif
                                    @if($serie->puntaje == '4')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                       
                                    @endif
                                    
                                     @if($serie->puntaje == '3.5')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star-half-o"></i></a>
                                       
                                    @endif
                                    @if($serie->puntaje == '3')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        
                                       
                                    @endif
                                     @if($serie->puntaje == '2.5')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star-half-o"></i></a>
                                        
                                       
                                    @endif
                                     @if($serie->puntaje == '2')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                       
                                        
                                       
                                    @endif
                                    
                                    @if($serie->puntaje == '1.5')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                       <a href="#"><i class="fa fa-star-half-o"></i></a>
                                       
                                        
                                       
                                    @endif
                                    
                                     @if($serie->puntaje == '1')
                                        <a href="#"><i class="fa fa-star"></i></a>
                                     
                                       
                                        
                                       
                                    @endif
                                     @if($serie->puntaje == '0.5')
                                       <a href="#"><i class="fa fa-star-half-o"></i></a>
                                     
                                       
                                        
                                       
                                    @endif
                                    
                                </div>
                           
                            </div>
                            <p>{{ $serie->descripcion }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Tipo:</span> Serie</li>
                                            <li><span>Studios:</span> {{ $serie->studio }}</li>
                                            <li><span>Fecha de subida:</span> {{ $serie->fecha }}</li>
                                            <li><span>Edad:</span> {{ $serie->edad }} </li>
                                            <li><span>Genero:</span>{{ $serie->categoria }}, {{ $serie->categoria2 }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Puntaje:</span>{{ $serie->puntaje }}</li>
                                            <li><span>Temporadas:</span>{{ $serie->temporadas }}</li>
                                            <li><span>Duracion total de la serie:</span> {{ $serie->duracion }} min</li>
                                            <li><span>Calidad:</span> HD</li>
                                            @if(Auth::check())
                                                @if($serieUsuario != null)
                                                
                                                    <li><span>Cantidad de veces vista:</span>{{ $serieUsuario->cantidad_veces }}</li>
                                                    
                                              @endif
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                            
                                 @if(Auth::check())    
                                      <form method="post" action="{{ route('serie.vista') }}">
                                          @csrf
                                          @method('post')
                                          <input type="number" name="usuarioId" value="{{ auth()->user()->id }}" hidden/>
                                          <input type="number" name="peliculaId" value="{{ $serie->id }}" hidden/>
                                          
                                          
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
                                <h5>Series Relacionadas</h5>
                            </div>
                            @foreach($seriesR as $series)
                                <a href="{{url('serie/ ' . $series->id)}}">
                                    <div class="product__sidebar__view__item set-bg" data-setbg="{{ asset('storage/ImgSeries/'. $series->extensionImg) }}">
                                        <div class="ep">{{ $series->edad }}</div>
                                        <div class="view"><i class="icon_clock"></i> {{ $series->duracion }}</div>
                                        <h5><a href="{{url('serie/ ' . $series->id)}}" style="color:#e53637; text-transform:uppercase;">{{ $series->titulo }}</a></h5>
                                    </div>
                                </a>
                           @endforeach
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </section>



@endsection