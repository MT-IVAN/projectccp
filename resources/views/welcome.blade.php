@extends('layouts.app')

@section('content')

	<div class="container">
       
        <!-- @if (Auth::guest())<a href="/ccpproject/public/" > <center><img src="images/listosajugar.png"></center> </a> -->
					<br>
    				<br>
    				<br>
    				<br>
    		@if (!Auth::check())
         	<form method="GET" action="test">
		    <div class="form-group">
  				
    			<center><div class="input-group-addon form-text form-control " id="ampliar2">INGRESA TU ID ABAJO</div></center>
    			
    			<input name="nombreNinoRegistrer" type="text" required pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"  class="form-text form-control" id="ampliar">
    			<input type="submit" name="nose" class="form-text form-control">
    		@if(session()->has('msj'))
    		<div class="alert alert-danger" role='alert'>{{session('msj')}}</div>
    		@endif
    				
    				<br>
    				<br>
    				<br>
    				<br>
    				<br>

   			</div>
  		 
	<!-- @foreach ($users as $user) 
    <td>{{$user->nombre}}</td>
    @endforeach -->
  			 
  			{{ csrf_field() }}
  		</form>
        @endif
        <!--@endif-->
	</div>

@endsection