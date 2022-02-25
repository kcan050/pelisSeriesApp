@extends('base')

@section('content')
<div class="container contenedor-register">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                                 @error('generico')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                <div class="card-header">{{ __('Editar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')  
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}"  autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="oldpassword" class="col-md-4 col-form-label text-md-end @error('oldpassword') is-invalid @enderror">Contraseña antigua</label>

                            <div class="col-md-6">
                                <input id="oldpassword" type="password" class="form-control" name="oldpassword" >
                            </div>
                                  @error('oldpassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña Nueva (opcional)</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password" >

                              
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                        <label for="rol" class="col-md-4 col-form-label text-md-end">Tipo de Paquete</label>
                
                        <div class="col-md-6">
                            <select id="espremium" name="espremium" class="form-control" required>
                                <option value=""  @if(old('espremium') == '') selected  @endif disabled >&nbsp;</option>
                                @foreach($espremium as $premium)
                                    <option value="{{ $premium }}" @if(old('espremium', $user->espremium ) == $premium)  selected @endif >{{ $premium }}</option>    
                                
                                @endforeach
                                
                            </select>
                
                            
                        </div>
                    </div>
                         <div class="row mb-3">
                            <label for="archivo" class="col-md-4 col-form-label text-md-end">Subir Foto</label>

                            <div class="col-md-6">
                                
                                 <input id="archivo"  type="file" accept="image/png , image/jpeg" enctype="multipart/form-data" name="archivo"/>

                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="site-btn">
                                   Editar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection