@extends('layouts.app')
@section('content')

	<div class="container">
		@if (Auth::check())
        	<h2>Reportes</h2>

           
            <div class="div_grafica">
                 <div id="aciertos_div"></div>
                 <div id="aciertos_div2"></div>
               @barchart('Aciertos', 'aciertos_div') 
            
            </div>


          









        @else
             <h3>
             	Debe iniciar sesión para ver el contenido. 
            	<a href="login">Click aqui para acceder</a>
         	</h3>
		@endif
	</div>

@endsection