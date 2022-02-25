@extends('base')





@section('content')
<div class="col-md-8" style="margin: 0 auto;">
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Numeracion</th>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Rol</th>
      <th scope="col">Esta verificado</th>
      <th scope="col">Tipo de cuenta</th>

    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
     <tr>
          <td>{{ $loop->iteration }}</td>
      
        
         
          <td>{{ $user->id }}</td>
          
        
          
          <td>{{ $user->name }}</td>
         
     
          
          <td>{{ $user->email }}</td>
         
      
          <td>{{ $user->rol }}</td>
       
          <td>{{ $user->email_verified_at }}</td>
         
       
          <td >{{ $user->espremium }}</td>
         
   
          
        
         
        </tr>
        
    @endforeach
  </tbody>
</table>
</div>
<div class="col-md-2" style="margin: 0 auto; margin-bottom:100px;">
  <a  href="{{ url('pelicula/create') }}" class="site-btn">Crear Nueva Pelicula</a>
</div>
@endsection