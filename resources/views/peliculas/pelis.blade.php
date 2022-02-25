@extends('base')





@section('content')

<section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-10" style="margin:0 auto;">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Peliculas</h4>
                                </div>
                            </div>
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="product__page__filter">
                                        <p>Ordenar:</p>
                                            
                                         @if($busqueda == null)
                                             <div class="ordenacion-pelis">
                                                 <a href="{{ url('categoria/titulo/asc') }}">A-Z Por Titulo</a>
                                                 <a href="{{ url('categoria/titulo/desc') }}">Z-A Por Titulo</a>
                                                 <a href="{{ url('categoria/categoria/asc') }}">A-Z Por Categoria</a>
                                                 <a href="{{ url('categoria/categoria/desc') }}">Z-A Por Categoria</a>
                                             </div>
                                         @else
                                             <div class="ordenacion-pelis">
                                                  <a href="{{ url('categoria/titulo/desc/'. $busqueda) }}">A-Z Por Titulo</a>
                                                  <a href="{{ url('categoria/titulo/asc/'. $busqueda) }}">Z-A Por Titulo</a>
                                                  <a href="{{ url('categoria/categoria/asc/'. $busqueda) }}">A-Z Por Categoria</a>
                                                  <a href="{{ url('categoria/categoria/desc/'. $busqueda) }}">Z-A Por Categoria</a>
                                             </div>
                                         @endif
                                     
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            @if(count($peliculas) <= 0)
                            
                  
                            
                            
                                            <h2><a href="" style="color:#e53637; text-transform:uppercase;">No se han encontrado resultados</a></h2>
                                    
                            @else
                            
                            
                            @foreach ($peliculas as $pelicula)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{url('pelicula/ ' . $pelicula->id)}}">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/ImgPeliculas/'. $pelicula->extensionImg) }}">
                                            <div class="ep">Edad: {{ $pelicula->edad }}</div>
                                            @if($pelicula->espremium == 'premium')
                                                <div class="tipo-pelicula">{{ $pelicula->espremium }}</div>
                                            @endif
                                            <div class="comment"><i class="fa fa-star"></i> {{ $pelicula->puntaje}}</div>
                                            <div class="view"><i class="icon_clock"></i> Duracion: {{ $pelicula->duracion}}</div>
                                        </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>{{ $pelicula->categoria }}</li>
                                                <li>{{ $pelicula->categoria2 }}</li>
                                            </ul>
                                            <h5><a href="" style="color:#e53637; text-transform:uppercase;">{{ $pelicula->titulo }}</a></h5>
                                        </div>
                                        
                                    </div>
                                </div>
                            @endforeach
                            
                          
                            
                        
                        </div>
                      <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                   {{ $peliculas->onEachSide(2)->links() }}
                                </div>
                        </div>
                    @endif
                        
                        
                    </div>
                    
                    
                    
                    
                    
                    <div class="live__product" style="margin-top:100px;">
                        <div class="row">
                            
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Series</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="#" class="primary-btn">Series <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(count($series) <= 0)
                            
                            
                             <h2><a href="" style="color:#e53637; text-transform:uppercase;">No se han encontrado resultados</a></h2>
                            
                            
                            @else
                            @foreach ($series as $serie)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{url('serie/ ' . $serie->id)}}">
                                            <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/ImgSeries/'. $serie->extensionImg) }}">
                                                <div class="ep">Edad: {{ $serie->edad }}</div>
                                                 @if($serie->espremium == 'premium')
                                                    <div class="tipo-pelicula">{{ $serie->espremium }}</div>
                                                @endif
                                                  <div class="comment"><i class="fa fa-star"></i> {{ $serie->puntaje}}</div>
                                            <div class="view"><i class="icon_clock"></i> Duracion: {{ $serie->duracion}}</div>
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>{{ $serie->categoria }}</li>
                                                <li>{{ $serie->categoria2 }}</li>
                                            </ul>
                                            <h5><a href="#" style="color:#e53637; text-transform:uppercase;">{{ $serie->titulo }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                         <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                   {{ $series->onEachSide(2)->links() }}
                                </div>
                         </div>
                        @endif
                    </div>
                   
                </div>
                <div class="col-lg-7 col-md-7 col-sm-8" style="margin:0 auto; margin-top:100px;">
                    <div class="product__sidebar" >
                        <div class="product__sidebar__view" >
                            <div class="section-title">
                                <h5>Peliculas Categorias</h5>
                            </div>
                            <ul class="filter__controls">
                                <li class="active" data-filter="*">Todas</li>
                                <li data-filter=".Ciencia">Ficcion</li>
                                <li data-filter=".Accion">Accion</li>
                                <li data-filter=".Drama">Drama</li>
                                <li data-filter=".Animacion">Animacion</li>
                                <li data-filter=".Terror">Terror</li>
                                <li data-filter=".Comedia">Comedia</li>
                            </ul>
                            <div class="filter__gallery">
                                @foreach($peliculas as $pelicula)
                                    <div class="product__sidebar__view__item set-bg mix {{$pelicula->categoria}} {{$pelicula->categoria2}}"
                                        data-setbg="{{ asset('storage/ImgPeliculas/'. $pelicula->extensionImg) }}">
                                        <div class="ep">{{ $pelicula->edad }}</div>
                                        <div class="view"><i class="fa fa-clock"></i> {{ $pelicula->duracion }}</div>
                                        <h5><a href="#" style="color:#e53637; text-transform:uppercase;">{{ $pelicula->titulo }}</a></h5>
                                    </div>
                                 
                                    
                                  @endforeach
                            </div>
                        </div>
    
                    </div>
                </div>
               

</div>
</div>

</section>


@endsection