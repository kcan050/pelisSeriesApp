@extends('base')


@section('content')

 <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form" style="color:white;">
                        <h3>Registro de Series</h3>
                        <form action="{{ route('serie.store') }}" method="POST" enctype="multipart/form-data">
                             @csrf
                             
                             <label for="peli" class="input_create" >Titulo: </label>
                            <div class="input__item " >
                               
                                <input id="peli" name="titulo" class=" @error('titulo') is-invalid @enderror input-color" type="text" placeholder="Titulo Serie:">
                                <span class="icon_book input-color" ></span>
                                 @error('titulo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <label for="studio" class="input_create">Estudio de la serie: </label>
                            <div class="input__item ">
                                
                                <input id="studio" name="studio" class=" @error('studio') is-invalid @enderror input-color"  type="text" placeholder="Estudio Serie:">
                                <span class="icon_puzzle input-color" ></span>
                                 @error('studio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="puntaje" class="input_create">Puntaje (valores permitidos 0.5,1,1.5,2,2.5,3,3.5,4,4.5,5): </label>
                            <div class="input__item ">
                                
                                <input type="number" class=" @error('puntaje') is-invalid @enderror input-color"  step="0.5" min="0.5" max="5" name="puntaje" id="puntaje" placeholder="Puntaje: ">
                                <span class="icon_star input-color"></span>
                                 @error('puntaje')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <label for="duracion" class="input_create" >Duracion en minutos:</label>
                            <div class="input__item ">
                                <input type="number" step="any" min="15" max="420" class=" @error('duracion') is-invalid @enderror input-color" name="duracion" id="duracion" placeholder="Duracion: ">
                                <span class="icon_clock input-color"></span>
                                 @error('duracion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <label for="temporadas" class="input_create" >Temporadas:</label>
                            <div class="input__item ">
                                <input type="number" min='1' class=" @error('temporadas') is-invalid @enderror input-color" name="temporadas" id="temporadas" placeholder="Temporadas: ">
                                <span class="icon_calendar input-color"></span>
                                 @error('temporadas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                         </div>
                        </div>
                  
                      <div class="col-lg-5" style="color:white;">
                          <div class="login__register" style="margin-top:90px;">
                              
                              <label for="premium" class="input_create">Es premium</label>
                              <div class="input__item">
                               
                                <select id="premium" class="form-control input-color" name="espremium" type="text" placeholder="">
                                          <option value=""  @if(old('espremium') == '') selected  @endif disabled >&nbsp;</option>
                                        @foreach($espremium as $premium)
                                            <option value="{{ $premium }}" @if(old('espremium') == $premium)  selected @endif >{{ $premium }}</option>    
                                        
                                        @endforeach
                                </select>
                                
                             </div>
                             <label for="categoria" class=" input_create">Tipo de categoria: </label>
                            <div class="input__item">
                             
                               <select id="categoria" class="form-control input-color" name="categoria" type="text" placeholder="">
                                     <option value=""  @if(old('categoria') == '') selected  @endif disabled >&nbsp;</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria }}" @if(old('categoria') == $categoria)  selected @endif >{{ $categoria }}</option>    
                                        
                                        @endforeach
                                </select>
                              </div>
                              <label for="categoria2" class=" input_create">Tipo de categoria: </label>
                              <div class="input__item">
                                
                                   <select id="categoria2" class="form-control input-color" name="categoria2" type="text" placeholder="">
                                         <option value=""  @if(old('categoria2') == '') selected  @endif disabled >&nbsp;</option>
                                            @foreach($categorias as $categoria)
                                                <option value="{{ $categoria }}" @if(old('categoria2') == $categoria)  selected @endif >{{ $categoria }}</option>    
                                            
                                            @endforeach
                                    </select>
                              </div>
                             <label for="edad" class=" input_create">Clasificacion por edades: </label>
                              <div class="input__item">

                                   <select id="edad" class="form-control input-color" name="edad" type="text" placeholder="">
                                         <option value=""  @if(old('edad') == '') selected  @endif disabled >&nbsp;</option>
                                            @foreach($edades as $edad)
                                                <option value="{{ $edad }}" @if(old('edad') == $edad)  selected @endif >{{ $edad }}</option>    
                                            
                                            @endforeach
                                    </select>
                                </div>
                                
                                <div class="input__item input_create">
                                   
                                   
                                    <label for="archivo">Imagen Pelicula:</label>
                                    <input id="archivo" class="form-control" type="file" class=" @error('duracion') is-invalid @enderror "  accept="image/png , image/jpeg" enctype="multipart/form-data" name="archivo" required/>
                                    <i class="far fa-file-image"></i>
                                     @error('archivo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                
                                </div>
                                
                                <div class="input__item">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Descripcion:</label>
                                        <textarea class="form-control input-color  @error('descripcion') is-invalid @enderror" name="descripcion" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                     @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                    
                                    
                                </div>
                            </div>
                        </div>
                         <button type="submit" style="margin-left:20%; margin-top:80px" class="site-btn">Crear Serie</button>
                       
                       
                        </form>
                      
                
            </div>
           
        </div>
</section>



@endsection
@section('js')


<script src="{{ url('assets/js/functions.js') }}"></script>



@endsection