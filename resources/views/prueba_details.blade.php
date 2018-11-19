@extends('layouts.app')

@section('content')

	<div class="container">
	    <h2>Detalles prueba</h2>
      @if (Auth::check())
		  <form method="POST" action="prueba_edit/{{ $prueba->id }}">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Nombre</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{$prueba->nombre}}</p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Descripción</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{$prueba->descripcion}}</p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Porcentaje</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{$prueba->porcentaje}}</p>
          </div>
        </div>
         <div class="form-group">
            <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
            <a href="../prueba" class="btn btn-default">Volver</a>
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