@extends('layouts.app')

@section('content')


	<div class="container">
       
					<br>
    				<br>
    				<br>
    				<br>
    		@if (!Auth::check())
         	<form method="GET" action="test" autocomplete="off">
		    <div class="form-group">
  				
    			<center><div class="input-group-addon form-text form-control " id="ampliar2">INGRESA TU ID ABAJO</div></center>
    			
    			<input name="nombreNinoRegistrer" type="text" required pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"  class="form-text form-control" id="ampliar">
    			<input type="submit" name="nose" class="form-text form-control btn-primary" id="ampliarSubmit">
    		@if(session()->has('msj'))
    		<div class="alert alert-danger" role='alert'>{{session('msj')}}</div>
    		@endif
    				
    				<br>
    				<br>
    				<br>
    				<br>
    				<br>

   			</div>
  		 
	
  			 
  			{{ csrf_field() }}
  		</form>
        @endif
       
	</div>

@endsection