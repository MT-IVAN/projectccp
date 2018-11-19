@extends('layouts.app')

@section('content')

	<div class="container">

        @if (Auth::check())
            <h2>Gestión de preguntas</h2>
            <a href="pregunta" class="btn btn-primary">Agregar una nueva pregunta</a>
            <div class="formulario">
                <h3>Listado de preguntas</h3>
                    <table class="table">
                        <thead>
                            <tr data-toggle="tooltip" data-placement="top" title="Clic para ordenar">
                                <th>Pregunta</th>
                                <th>Distractor 1</th>
                                <th>Distractor 2</th>
                                <th>Nivel de dificultad</th>
                                <th>Fecha de creación</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($preguntas as $pregunta)
                                <tr>
                                    <td>
                                        <a href="pregunta/{{$pregunta->id}}" class="list-group-item-action" data-toggle="tooltip" data-placement="top" title="Clic para modificar">
                                            ¿Donde dice {{$pregunta->clave}}?
                                        </a>
                                    </td>
                                    <td>{{$pregunta->distractor1}}</td>
                                    <td>{{$pregunta->distractor2}}</td>
                                    <td>{{$pregunta->nivel}}</td>
                                    <td>{{$pregunta->created_at}}</td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
            {!!$preguntas->render()!!}
		@else
             <h3>
             	Debe iniciar sesión para ver el contenido. 
            	<a href="login">Click aqui para acceder</a>
         	</h3>
		@endif
        
	</div>

@endsection