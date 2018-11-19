@extends('layouts.app')

@section('content')

	<div class="container">
       
         @if (Auth::guest())<a href="test" > <center><img src="images/listosajugar.png"></center> </a>
        
        @endif
	</div>

@endsection