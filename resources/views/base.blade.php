<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cuevana</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('assets/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('assets/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('assets/css/plyr.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('assets/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('assets/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('assets/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('assets/css/all.min.css')}}" type="text/css">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    
    <style type="text/css">
        .contenedor-register{
            	margin-top:100px;
                margin-bottom:100px;
            }
            
            
        .contenedor-register .card-header{
            background-color:black;
            color:white;
            
        }
         .contenedor-register .card-body{
             background-color:#0b0c2a;
             color:white;
             
         }
         
        .contenedor-perfil{
            	margin-top:100px;
                margin-bottom:100px;
        } 
        .input_create{
            
            margin-top:70px;
            
        }
        
        
        .input__item .invalid-feedback{
       
            margin-top:50px;
        }
        .input__item .invalid-feedback strong{
                 color:red;
        }
        
        
        .pagination .page-item{
            color:black !important;
        }
        
        .page-item.active .page-link {
          z-index: 3;
          color: #e53637;
          background-color: black;
          border-color: #fff;
        }
        
        .icono-perfil{
            width:20%;
            height:20%;
            margin:0 auto;
        }
        .icono-perfil img{
            width:50px;
            height:50px;
        }
        
        .header__right{
            width:400px;
            margin-left:-40%;
          
        }
        
        
        .carta-perfil{
            
            background-color:#070720;
        }
        
        
        .product__page__filter{
            margin-left:60%;
            margin-bottom:10%;
            
        }
        
        
        .filter__controls{
            top:40px !important;
        }
        .filter__gallery{
           margin-top:100px;
        }
        
        .input-color{
            color:black !important;
        }
        
        .titulo-index{
            display:flex;
            justify-content:center;
            margin-top:100px;
            
        }
        .login__form form .input__item input::placeholder {
              color: #e53637 !important;
            }
            
        .product__page__filter{
            width:100%;
            
        }
        .ordenacion-pelis{
            width:120%;
            height:100px;
            display:flex;
            justify-content:space-between;
            
        }
        
        
        .tipo-pelicula{
            font-size: 13px;
            color: #ffffff;
            background: #e53637;
            display: inline-block;
            padding: 2px 12px;
            border-radius: 4px;
            position: absolute;
            right: 10px;
            top: 10px;
            text-transform:uppercase;
        }
        
        .carta-perfil .card-body{
            background-color:black;
            color:white;
            border-radius:20px;
            
            
        }
        
        
        .carta-info-perfil{
            
            background-color:black;
            color:white;
            border-radius:20px;
            
        }
        
        .carta-info-perfil .mb-0{
            color:white;
        }
        
        
        .btn-ver-pelicula{
            
            background-color:#e53637;
            border:1px solid #e53637;
            border-radius:4px;
            
            
            
        }
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}

    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="#">
                            <img width="100" height="100" src="{{ url('assets/img/logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="#">Inicio</a></li>
                               
                                 @if(Auth::check())
                               
                                      @if(auth()->user()->rol == 'admin')
                               
                                            <li><a href="#">Opciones Admin <span class="arrow_carrot-down"></span></a>
                                                <ul class="dropdown">
                                                    <li><a href="{{ route('pelicula.create') }}">Agregar Pelicula</a></li>
                                                    <li><a href="{{ route('serie.create') }}">Agregar Serie</a></li>
                                                    <li><a href="{{ route('pelicula.datos') }}">Ver Base De Datos</a></li>
                                                    <li><a href="{{ url('pelicula') }}">Ver Catalogo</a></li>
                                                   
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('users.perfil') }}">Ver Perfil</a></li> 
                                     @endif 
                                     
                                     @if(auth()->user()->rol == 'user')
                                            <li><a href="#">Opciones Usuario<span class="arrow_carrot-down"></span></a>
                                                <ul class="dropdown">
                                                    <li><a href="{{ url('pelicula') }}">Ver Catalogo</a></li>
                                                 
                                               
                                                </ul>
                                            </li>
                                            
                                              <li><a href="{{ route('users.perfil') }}">Ver Perfil</a></li> 
                                       @endif 
                                            
                                 @endif
                             
                                
                             
                                
                                 @guest
                                  <li><a href="{{ url('user') }}">Registrarse</a></li> 
                                     @if (Route::has('login'))
                                     
                                        <li><a href="{{ route('users.login') }}">Ingresar</a></li>
                                     @endif
                                 @endguest
                                 
                                 
                            </ul>
                        </nav>
                    </div>
                </div>
            
                
                <div class="col-lg-2">
                    <div class="header__right">
                        @if(Auth::check())
                            <a href="{{ route('users.perfil') }}" class="icono-perfil">

                                            <img class="rounded-circle z-depth-2" alt="100x100" src="{{ asset('storage/ImgUsuarios/'. Auth()->User()->extensionImg) }}"
                                              data-holder-rendered="true">
                            
                            </a>
                            <a>{{ auth()->user()->name }}</a>
                            <a href="#" class="search-switch"><span class="icon_search"></span></a>
                            
                             @if(auth()->user()->rol == 'admin')
                                <a href="{{ route('pelicula.datos')  }}"><i class="fas fa-database"></i></a>
                            @endif
                        @endif
                        
                        @guest
                            @if (Route::has('register'))
                                 <a href="{{ url('user') }}"><span class="icon_profile"></span></a>
                            @endif
                        @else
                                <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" ><i class="fas fa-sign-out-alt"></i> </a>
                        
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                     </form>
                                    
                                      
                                  
                        @endguest
                       
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->
    <div class="titulo-index">
         <div class="section-title" >
                       <h4 >Vive la experiencia cuevana</h4>
          </div>
     </div>
  
    <!-- Hero Section Begin -->
     @if($ultimasPelis != null)
    <section class="hero" style="margin-bottom:200px;">
        <div class="container">
            <div class="hero__slider owl-carousel">
               
                    @foreach($ultimasPelis as $ultimaPeli)
                    <div class="hero__items set-bg" data-setbg="{{ asset('storage/ImgPeliculas/'. $ultimaPeli->extensionImg) }}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="hero__text">
                                    <div class="label" style="background-color:black;">{{ $ultimaPeli->categoria }}</div>
                                    <div class="label" style="background-color:black;">{{ $ultimaPeli->categoria2 }}</div>
                                    <h2 style="color:#e53637; text-transform:uppercase;">{{ $ultimaPeli->titulo }}</h2>
                                    <p>{{$ultimaPeli->descripcion}}</p>
                                    <a href="{{url('pelicula/ ' . $ultimaPeli->id)}}"><span>Ver más</span> <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endforeach
             
            </div>
        </div>
    </section>
      @else
    
   <section class="hero" style="margin-bottom:200px;">
        <div class="container">
            <div class="hero__slider owl-carousel">
               
                    <div class="hero__items set-bg" data-setbg="">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="hero__text">
                                   
                                    <h2 style="color:#e53637; text-transform:uppercase;">No hay peliculas en la base de datos</h2>
                           
                                
                                </div>
                            </div>
                        </div>
                    </div>
                
             
            </div>
        </div>
    </section>
    
    
    
      @endif
    <!-- Hero Section End -->

    

    
    @yield('content')
<!-- Product Section End -->

<!-- Footer Section Begin -->
<footer class="footer"style="margin-top:200px;">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer__logo" >
                   
                </div>
            </div>
            <div class="col-lg-6">
                <div class="footer__nav">
                    <ul>
                        <li class="active"><a href="./index.html">Homepage</a></li>
                        <li><a href="./categories.html">Categories</a></li>
                        <li><a href="./blog.html">Our Blog</a></li>
                        <li><a href="#">Contacts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Cuevana
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>

              </div>
          </div>
      </div>
  </footer>
  <!-- Footer Section End -->

  <!-- Search model Begin -->
  <div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch"><i class="icon_close"></i></div>
        <form class="search-model-form" method="get" action="{{ route('pelicula.busqueda') }}">
            @csrf
            
            
            <input type="text" name="busqueda" id="search-input" placeholder="Ingrese Titulo o Categoria:">
        </form>
    </div>
</div>
<!-- Search model end -->

<!-- Js Plugins -->
@yield('js')
<script src="{{url('assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/player.js')}}"></script>
<script src="{{url('assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{url('assets/js/mixitup.min.js')}}"></script>
<script src="{{url('assets/js/jquery.slicknav.js')}}"></script>
<script src="{{url('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{url('assets/js/main.js')}}"></script>


</body>

</html>