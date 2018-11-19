@extends('layouts.app')

@section('content')

	<div class="container">
	    <h2>Modificar una prueba</h2>
      @if ($errors->any())
          <div class="alert alert-danger">
              Los datos ingresados no son válidos, por favor ingrese los datos correctamente
          </div>
      @endif
      @if (Auth::check())
		<form method="POST" action="prueba_edit/{{ $prueba->id }}">
		    <div class="form-group">		    	
  				<div class="input-group mb-2 mr-sm-2 mb-sm-0">
    				<div class="input-group-addon">Nombre</div>
    				<input name="nombre" type="text" required pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" class="form-text form-control" placeholder="Digita el nombre" value="{{$prueba->nombre}}" >
  				</div>
  				<small class="form-text text-muted">Será el nombre que diferenciará a esta prueba</small>
  				<div class="input-group mb-2 mr-sm-2 mb-sm-0">
    				<div class="input-group-addon">Descripción</div>
    				<textarea name="descripcion" type="text" required pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,190}" class="form-text form-control" placeholder="Digita la descripción de la prueba">{{$prueba->descripcion}}</textarea>
  				</div>
  				<small class="form-text text-muted">Será una texto que presentará detalles sobre la prueba</small>
  				<div class="input-group mb-2 mr-sm-2 mb-sm-0">
    				<div class="input-group-addon">Porcentaje</div>
    				<input name="porcentaje" type="number" required class="form-text form-control" placeholder="Digita el porcentaje" max="100" min="0" value="{{$prueba->porcentaje}}">
  				</div>
  				<small class="form-text text-muted">Será el porcentaje de aciertos para cada nivel de dificultad</small>
		    </div>
		    <div class="form-group">
		        <button type="submit" name="update" class="btn btn-primary">Modificar</button>
            <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
            <button type="button" class="btn btn-default" onclick="history.go(-1); return false;">Cancelar</button>
		    </div>
			{{ csrf_field() }}
		</form>
    @else
             <h3>
              Debe iniciar sesión para ver el contenido. 
              <a href="login">Click aqui para acceder</a>
          </h3>
    @endif
	</div>

@endsection