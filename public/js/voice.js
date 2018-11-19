$(document).ready(function() {
 	var letraComparar =  $("#preguntaVoice").text();
 	letra = letraComparar.substring(7,letraComparar.lenght);
 	if(letraComparar !="Fin de la prueba" && letraComparar!= "No existen preguntas disponible"){
 		responsiveVoice.speak(letra , "Spanish Latin American Female", {rate: 0.8});
 	}
 	
 	

});


