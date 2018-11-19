@extends('layouts.app')

@section('content')

	<div class="container">
        @if (Auth::check())
            <h2>Cuestionario</h2>
            <div class="formulario">
                <h3>TEST DE LECTURA NIVEL TRANSICIÓN I.E.M CIUDAD DE PASTO</h3>
                    <ol>
                        @php ($nivel = 0)
                        @foreach($items as $item)
                            @if ( $item->nivel > $nivel )
                            <div>
                                <h4>Nivel de dificultad {{$item->nivel}}</h4>
                                <div class="list-group">
                                @php ($nivel++)
                            @endif
                                    <li>
                                        <a href="{{$item->prueba_id}}/{{$item->id}}" class="list-group-item left-content-between" data-toggle="tooltip" data-placement="top" title="Clic para quitar">
                                            Audio: ¿Dónde dice {{$item->clave}}? Opciones de respuesta: {{$item->distractor1}} {{$item->distractor2}} {{$item->clave}}    
                                            <span class="badge badge-error badge-pill">x</span>
                                        </a>
                                        
                                    </li>
                            @if ($item->nivel > $nivel)
                                 </div>
                            </div>                                 
                            @endif
                        @endforeach
                    </ol>
                <h4>FIN DE LA PRUEBA</h4>
                <a href="../lista_preguntas/{{$id}}" class="btn btn-primary">Agregar una pregunta</a>
                <a href="../prueba" class="btn btn-default">Volver</a>
            </div>
		@else
             <h3>
             	Debe iniciar sesión para ver el contenido. 
            	<a href="login">Click aqui para acceder</a>
         	</h3>
		@endif
	</div>

@endsection