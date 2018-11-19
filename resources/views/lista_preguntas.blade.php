@extends('layouts.app')

@section('content')

	<div id="estadoGuardar" class="container">
        @if (Auth::check())
            <h2>Selección de preguntas</h2>
            <form method="POST" action="{{$id}}">
                <div id="botonDiv" class="formulario">
                    <h3>Listado de preguntas</h3>
                    <table   class="table">
                        <thead>
                            <tr data-toggle="tooltip" data-placement="top" title="Clic para ordenar">
                                <th>Pregunta</th>
                                <th>Distractor 1</th>
                                <th>Distractor 2</th>
                                <th>Nivel de dificultad</th>
                                <th>Fecha de creación</th>
                                <th>Agregar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($preguntas as $pregunta)
                                <tr>
                                    <td>¿Donde dice {{$pregunta->clave}}?</td>
                                    <td>{{$pregunta->distractor1}}</td>
                                    <td>{{$pregunta->distractor2}}</td>
                                    <td>{{$pregunta->nivel}}</td>
                                    <td>{{$pregunta->created_at}}</td>
                                    <td>
                                        <input type="checkbox" value="{{$pregunta->id}}" name="activar" id="activar" class="custom-control-input">
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <input type="hidden" id="datos" name="datos">
                <button type="submit" disabled="true"  name="guardar" id="guardar" class="btn btn-success">Guardar</button>
                <a href="../preguntas" class="btn btn-primary">Gestión de preguntas</a>
                <button type="button" class="btn btn-default" onclick="history.go(-1); return false;">Cancelar</button>
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