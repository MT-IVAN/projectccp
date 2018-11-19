@extends('layouts.app')

@section('content')

<div class="container">
	<h1>Modificar una pregunta</h1>
  @if ($errors->any())
          <div class="alert alert-danger">
              Los datos ingresados no son válidos, por favor ingrese los datos correctamente
          </div>
  @endif
  @if (Auth::check())
	<form method="POST" action="pregunta/{{ $pregunta->id }}">
	 	<div class="form-group">
		    <label class="sr-only" for="inlineFormInputGroup">Digita la clave</label>
  			<div class="input-group mb-2 mr-sm-2 mb-sm-0">
    			<div class="input-group-addon">Clave</div>
    			<input name="clave" type="text" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+*" class="form-text form-control" value="{{$pregunta->clave}}" placeholder="Digita la clave">
  			</div>
  			<small class="form-text text-muted">Será la opción correcta de la pregunta</small>
		    <label class="sr-only" for="inlineFormInputGroup">Digita el distractor 1</label>
  			<div class="input-group mb-2 mr-sm-2 mb-sm-0">
    			<div class="input-group-addon">Distractor 1</div>
    			<input name="distractor1" type="text" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+*" class="form-text form-control" value="{{$pregunta->distractor1}}" placeholder="Digita el primer distractor">
  			</div>
  			<small class="form-text text-muted">Será una opción incorrecta de la pregunta</small>
  			<label class="sr-only" for="inlineFormInputGroup">Digita el distractor 2</label>
  			<div class="input-group mb-2 mr-sm-2 mb-sm-0">
    			<div class="input-group-addon">Distractor 2</div>
    			<input name="distractor2" type="text" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+*" class="form-text form-control" value="{{$pregunta->distractor2}}" placeholder="Digita el segundo distractor">
  			</div>
  			<small class="form-text text-muted">Será una opción incorrecta de la pregunta</small>
		    <label class="sr-only" for="inlineFormInputGroup">Digita el nivel de dificultad</label>
  			<div class="input-group mb-2 mr-sm-2 mb-sm-0">
    			<div class="input-group-addon">Dificultad</div>
    			<input name="nivel" type="number" class="form-text form-control" value="{{$pregunta->nivel}}" min="1" max="9" placeholder="Digita el nivel de dificultad" required>
  			</div>
  			<small class="form-text text-muted">Determinará el orden de aparición de la pregunta</small>
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

@stop