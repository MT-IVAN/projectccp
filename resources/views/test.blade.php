@extends('layouts.app')

@section('content')

	<div class="container">
        <h2>Test</h2>
        <div class="test row">
        	<script src="{{ asset('js/saveLocalStorage.js') }}"></script>
        	<div id="pregunta"><p id="preguntaVoice">{{$lblPregunta}}</p></div>
        	@if($ids>=0)
        	<form method="POST" action="test">
        		<input type="hidden" name="ids" value="{{serialize($ids)}}">
        		<input type="hidden" name="nvs" value="{{serialize($nvs)}}">
	            <div id="clave1" class="clave">
	            	<button class="botonSinBorde" type="submit" name="rta" value="{{$its[0]}}">{{$its[0]}}</button>
	            </div>
	            <div id="clave2" class="col-xs-6">
	            	<button class="botonSinBorde" type="submit" name="rta" value="{{$its[1]}}">{{$its[1]}}</button>
	            </div>
	            <div id="clave3" >
	            	<button class="botonSinBorde" type="submit" name="rta" value="{{$its[2]}}">{{$its[2]}}</button>
	            </div>
	        	{{ csrf_field() }}
			</form>
			@else
				<div class="imagen text-center">
					<img class="imagen rounded mx-auto d-block img-fluid" src="images/winner.jpg">
				</div>
			@endif
        </div>
        	@if(session()->has('nombreJugador') )
				<p id="nombreJugador">{{session('nombreJugador')}}</p>
			@else
				<p>ya</p>
			@endif
	</div>
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
        <script src="{{ asset('js/voice.js') }}"></script>
        
        

@endsection