@extends('base')




@section('content')


<div class="container contenedor-perfil">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          
          <!-- /Breadcrumb -->
          @if(Auth::check())
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card carta-perfil">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ asset('storage/ImgUsuarios/'. Auth()->User()->extensionImg) }}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4 style="color:white;">{{ Auth()->User()->name }}</h4>
                      <p class="text-secondary mb-1">{{ Auth()->User()->rol }}</p>
                  
                    <div class="col-sm-12">
                      <a class="btn btn-info "  href="{{ url('editar/'. auth()->user()->id) }}">Editar</a>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body carta-info-perfil">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nombre Completo</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" >
                      {{ Auth()->User()->name }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ Auth()->User()->email }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Rol</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ Auth()->User()->rol }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Tipo de cuenta</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     {{ Auth()->User()->espremium }}
                    </div>
                  </div>

                 
                  <hr>
                 
                </div>
              </div>

             



            </div>
          </div>
               <div class="row" style="margin-top:100px;">
                      
                      <div class="col-lg-6 col-md-4" style="margin:0 auto;">
                          <div class="anime__details__sidebar">
                              <div class="section-title">
                                  <h5>Peliculas Vistas</h5>
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
                      
                        <div class="col-lg-6 col-md-4" style="margin:0 auto;">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>Series Vistas</h5>
                            </div>
                            @foreach($seriesR as $series)
                                <a href="{{url('serie/ ' . $series->id)}}">
                                    <div class="product__sidebar__view__item set-bg" data-setbg="{{ asset('storage/ImgSeries/'. $series->extensionImg) }}">
                                        <div class="ep">{{ $series->edad }}</div>
                                        <div class="view"><i class="icon_clock"></i> {{ $series->duracion }}</div>
                                        <h5><a href="{{url('pelicula/ ' . $pelis->id)}}" style="color:#e53637; text-transform:uppercase;">{{ $series->titulo }}</a></h5>
                                    </div>
                                </a>
                           @endforeach
                        </div>
                    </div>
                  </div>
        </div>
    </div>
@else




@endif








@endsection