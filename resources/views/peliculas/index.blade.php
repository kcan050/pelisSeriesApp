@extends('base')





@section('content')
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:black;">
               <h5 class="modal-title" style="color:#e53637; text-transform:uppercase; ">Confirmar borrado de <span class="tipo"></span></h5>
              
            </div>
            <div class="modal-body">
                  <p>Desea borrar <span class="titulo" >XXX</span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <form id="form" action="" method="post">
                  @method('delete')
                  @csrf
                  <input type="submit" class="btn btn-danger" value="Borrar"/>
              </form>
            </div>
        </div>
    </div>
</div>


<div class="titulo-index ">
         <div class="section-title" >
                <h4 >Peliculas</h4>
          </div>
          
 </div>


 

<div class="col-md-8" style="margin: 0 auto;">
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Numeracion</th>
      <th scope="col">ID</th>
      <th scope="col">Titulo</th>
      <th scope="col">Fecha</th>
      <th scope="col">Duracion</th>
      <th scope="col">Puntaje</th>
      <th scope="col">Es premium</th>
      <th scope="col">Categoria</th>
     
    </tr>
  </thead>
  <tbody>
    @foreach($peliculas as $peli)
     <tr>
          <td>{{ $loop->iteration }}</td>
      
        
         
          <td>{{ $peli->id }}</td>
          
        
          
          <td>{{ $peli->titulo }}</td>
         
     
          
          <td>{{ $peli->fecha }}</td>
         
      
          <td>{{ $peli->duracion }}</td>
       
          <td>{{ $peli->puntaje }}</td>
         
       
          <td >{{ $peli->espremium }}</td>
         
   
          
          <td>{{ $peli->categoria }}</td>
     
    
          
       
          <td>
               <a type="button" class="btn btn-info" href="{{ url('pelicula/' . $peli->id . '/edit') }}">Editar</a>
          </td>
          

          <td>
            <a href="#" class="btn btn-danger" data-toggle="modal" onclick="deleteElement({{$peli->id}}, '{{$peli->titulo}}','pelicula','pelicula')" data-target="#confirm-delete">Borrar</a>
          </td>
        </tr>
        
    @endforeach
  </tbody>
</table>
</div>
<div class="titulo-index">
         <div class="section-title" >
                       <h4 >Series</h4>
          </div>
 </div>

<div class="col-md-8" style="margin: 0 auto;">
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Numeracion</th>
      <th scope="col">ID</th>
      <th scope="col">Titulo</th>
      <th scope="col">Fecha</th>
      <th scope="col">Duracion</th>
      <th scope="col">Puntaje</th>
      <th scope="col">Es premium</th>
      <th scope="col">Temporadas</th>
      <th scope="col">Categoria</th>

    </tr>
  </thead>
  <tbody>
    @foreach($series as $serie)
     <tr>
          <td>{{ $loop->iteration }}</td>
      
        
         
          <td>{{ $serie->id }}</td>
          
        
          
          <td>{{ $serie->titulo }}</td>
         
     
          
          <td>{{ $serie->fecha }}</td>
         
      
          <td>{{ $serie->duracion }}</td>
       
          <td>{{ $serie->puntaje }}</td>
         
       
          <td >{{ $serie->espremium }}</td>
         
          <td >{{ $serie->temporadas }}</td>
           
          
          <td>{{ $serie->categoria }}</td>
     
          
        
          
       
          <td>
               <a type="button" class="btn btn-info" href="{{ url('serie/' . $serie->id . '/edit') }}">Editar</a>
          </td>
         <td>
            <a href="#" class="btn btn-danger" data-toggle="modal" onclick="deleteElement({{$serie->id}}, '{{$serie->titulo}}','serie','serie')" data-target="#confirm-delete">Borrar</a>
          </td>
        </tr>
        
    @endforeach
  </tbody>
</table>
</div>


<div class="titulo-index @error('generico') is-invalid @enderror">
         <div class="section-title" >
                       <h4 >Usuarios</h4>
          </div>
 </div>
 
           @error('generico') 
            
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="margin-left:45%">{{ $message }}</strong>
                                    </span>
                                    
                              
         @enderror                 
 
 
<div class="col-md-8" style="margin: 0 auto;">
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Numeracion</th>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Esta verificado?</th>
      <th scope="col">Rol</th>
      <th scope="col">Tipo de paquete</th>
         <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($usuarios as $usuario)
     <tr>
          <td>{{ $loop->iteration }}</td>
      
        
         
          <td>{{ $usuario->id }}</td>
          
        
          
          <td>{{ $usuario->name }}</td>
         
     
          
          <td>{{ $usuario->email }}</td>
         
          @if($usuario->email_verified_at == null)
             <td>No</td>
          @else
             <td>Si</td>
          @endif
          <td>{{ $usuario->rol }}</td>
         
       
          <td >{{ $usuario->espremium }}</td>
         
          
          
          <td>
            <a href="#" class="btn btn-danger" data-toggle="modal" onclick="deleteElement({{$usuario->id}}, '{{$usuario->name}}','user','user')" data-target="#confirm-delete">Dar baja</a>
          </td>
          <td>
            <a class="btn btn-info"  href="{{ url('privilegios/'. $usuario->id) }}">Dar privilegios</a>
          </td>
        </tr>
        
    @endforeach
  </tbody>
</table>
</div>

<div class="titulo-index">
         <div class="section-title" >
                       <h4 >Peliculas Borradas</h4>
          </div>
 </div>
<div class="col-md-8" style="margin: 0 auto;">
<table class="table table-hover table-dark">
  <thead>
    <tr>
       <th scope="col">Numeracion</th>
      <th scope="col">ID</th>
      <th scope="col">Titulo</th>
      <th scope="col">Fecha</th>
      <th scope="col">Duracion</th>
      <th scope="col">Puntaje</th>
      <th scope="col">Es premium</th>
      <th scope="col">Categoria</th>
    
    </tr>
  </thead>
  <tbody>
    @foreach($peliculasBorradas as $peliBorrada)
     <tr>
           <td>{{ $peliBorrada->id }}</td>
          
        
          
          <td>{{ $peliBorrada->titulo }}</td>
         
     
          
          <td>{{ $peliBorrada->fecha }}</td>
         
      
          <td>{{ $peliBorrada->duracion }}</td>
       
          <td>{{ $peliBorrada->puntaje }}</td>
         
       
          <td >{{ $peliBorrada->espremium }}</td>
         
   
          
          <td>{{ $peliBorrada->categoria }}</td>
         
          
           <td>
               <a type="button" class="btn btn-info" href="{{ url('recuperar/' . $peliBorrada->id) }}">Recuperar</a>
          </td>
       
         
        </tr>
        
    @endforeach
  </tbody>
</table>
</div>
<div class="titulo-index">
         <div class="section-title" >
                       <h4 >Series Borradas</h4>
          </div>
 </div>

<div class="col-md-8" style="margin: 0 auto;">
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Numeracion</th>
      <th scope="col">ID</th>
      <th scope="col">Titulo</th>
      <th scope="col">Fecha</th>
      <th scope="col">Duracion</th>
      <th scope="col">Puntaje</th>
      <th scope="col">Es premium</th>
      <th scope="col">Temporadas</th>
      <th scope="col">Categoria</th>

    </tr>
  </thead>
  <tbody>
    @foreach($seriesBorradas as $serie)
     <tr>
          <td>{{ $loop->iteration }}</td>
      
        
         
          <td>{{ $serie->id }}</td>
          
        
          
          <td>{{ $serie->titulo }}</td>
         
     
          
          <td>{{ $serie->fecha }}</td>
         
      
          <td>{{ $serie->duracion }}</td>
       
          <td>{{ $serie->puntaje }}</td>
         
       
          <td >{{ $serie->espremium }}</td>
         
          <td >{{ $serie->temporadas }}</td>
           
          
          <td>{{ $serie->categoria }}</td>
     
          
        
          
       
          <td>
               <a type="button" class="btn btn-info" href="{{ url('recuperar/serie/' . $serie->id) }}">Recuperar</a>
          </td>
        </tr>
        
    @endforeach
  </tbody>
</table>
</div>
<div class="titulo-index">
         <div class="section-title" >
                       <h4 >Usuarios Borrados</h4>
          </div>
 </div>
<div class="col-md-8" style="margin: 0 auto;">
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Numeracion</th>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Esta verificado?</th>
      <th scope="col">Rol</th>
      <th scope="col">Tipo de paquete</th>
    
    </tr>
  </thead>
  <tbody>
    @foreach($usuariosBorrados as $usuarioBorrado)
     <tr>
          <td>{{ $loop->iteration }}</td>
      
        
         
          <td>{{ $usuarioBorrado->id }}</td>
          
        
          
          <td>{{ $usuarioBorrado->name }}</td>
         
     
          
          <td>{{ $usuarioBorrado->email }}</td>
         
          @if($usuarioBorrado->email_verified_at == null)
             <td>No</td>
          @else
             <td>Si</td>
          @endif
          <td>{{ $usuarioBorrado->rol }}</td>
         
       
          <td >{{ $usuarioBorrado->espremium }}</td>
         
          
        
           <td>
               <a type="button" class="btn btn-info" href="{{ url('recuperar/user/' . $usuarioBorrado->id) }}">Recuperar</a>
          </td>
        </tr>
        
    @endforeach
  </tbody>
</table>
</div>


@endsection


@section('js')


  <script src="{{ url('assets/js/functions.js') }}"></script>



@endsection