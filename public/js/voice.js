$(document).ready(function() {

/*
 	var letraComparar =  $("#preguntaVoice").text();
 	letra = letraComparar.substring(7,letraComparar.lenght);
 	if(letraComparar !="Fin de la prueba" && letraComparar!= "No existen preguntas disponible"){
 		responsiveVoice.speak(letra , "Spanish Latin American Female", {rate: 0.8});
 		
 	}
 	*/
 		var letraComparar =  $("#preguntaVoice").text(); // Donde dice, a?
	 	var sinComa = letraComparar.split(", ");
	 	var claveSola = sinComa[1].replace('?','');

	 	var definitiva = claveSola;

		if(letraComparar !="Fin de la prueba" && letraComparar!= "No existen preguntas disponible"){
	 	responsiveVoice.speak("¿Donde dice? "+ claveSola, "Spanish Latin American Female", {rate: 0.7});
	 	//window.setTimeout(decir(definitiva), 500);
	 }








 	$("#imgPlayAgain").click(function(){
	 		var letraComparar =  $("#preguntaVoice").text(); // Donde dice, a?
	 		var sinComa = letraComparar.split(", ");
	 		var claveSola = sinComa[1].replace('?','');
	 		var definitiva = claveSola;
	 		console.log(letraComparar + "este es latra +++ " + definitiva);
	 		

		 	

		 	if(letraComparar !="Fin de la prueba" && letraComparar!= "No existen preguntas disponible"){
	 		responsiveVoice.speak("¿Donde dice ", "Spanish Latin American Female", {rate: 0.7});
	 		window.setTimeout(decir(definitiva), 500);
	 		
	 	}
 	});	
 	
 	function decir(clave){
 		responsiveVoice.speak(clave, "Spanish Latin American Female", {rate: 0.6});
 	}
 	

});


