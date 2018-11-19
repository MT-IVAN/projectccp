@extends('layouts.app')

@section('content')

	<div class="container">
        @if (Auth::check())
            <h2>Gestión de pruebas</h2>
            <a href="prueba_add" class="btn btn-primary">Crear una prueba</a>
            <div class="formulario">
                <h3>Listado de pruebas para editar</h3>
                    <table class="table">
                        <thead>
                             <tr data-toggle="tooltip" data-placement="top" title="Clic para ordenar">
                                <th>Nombre</th>
                                <th>Fecha de creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($pruebasEditable as $prueba)
                                <tr>
                                    <td>{{$prueba->nombre}}</td>
                                    <td>{{$prueba->created_at}}</td>
                                     <td>
                                        <a href="prueba_publicar/{{$prueba->id}}" class="btn btn-warning">Publicar</a>
                                        <a href="prueba_edit/{{$prueba->id}}" class="btn btn-info">Modificar</a>
                                        <a href="items/{{$prueba->id}}" class="btn btn-default">Cuestionario</a>
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!!$pruebasEditable->render()!!}
            </div>
            <div class="formulario">
                <h3>Listado de pruebas publicadas</h3>
                    
                    @include('pruebas_ajax')


                    {!!$pruebasNoEditable->render()!!}
            </div>
		@else
             <h3>
             	Debe iniciar sesión para ver el contenido. 
            	<a href="login">Click aqui para acceder</a>
         	</h3>
		@endif
	</div>

@endsection