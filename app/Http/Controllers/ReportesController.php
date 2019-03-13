<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

use Khill\Lavacharts\Lavacharts;

class ReportesController extends Controller
{
    public function consultarResultadosDe($clave){
        
    }
    public function index()
    {
    	$user = Auth::user();

    	$this->grafica1();
        $this->grafica2();
       
         $ninios = DB::table('ninios')->get();
        $itemPregunta = DB::table('preguntas')->get();
         $textoCsv = "id,nombre,";
         

            if(count($itemPregunta)>0){//si textoCsvs tiene datos para mostrar
                 
           
                for($i = 0 ; $i<count($itemPregunta);$i++){
                     $textoCsv = $textoCsv . $itemPregunta[$i]->clave. ",";
                     $comparar[]= $itemPregunta[$i]->clave;
                }
                $textoCsv =  $textoCsv . "salto";

                for($i = 0 ; $i<count($ninios);$i++){

                    $textoCsv = $textoCsv. $ninios[$i]->id_nino. ",". $ninios[$i]->nombre."," ;
                     $reportes = DB::table('reportes')->where('id_ninio','=',$ninios[$i]->id_nino)->get();


                     for($j = 0 ; $j<count($comparar);$j++){
                      
                        if($j<count($reportes)){
                                if($comparar[$j]== $reportes[$j]->respuesta){
                            $textoCsv =  $textoCsv . "1". ",";
                        }
                        else{
                            $textoCsv =  $textoCsv . "0". ",";   
                        }
                        }
                        else {
                           $textoCsv =  $textoCsv . "-". ",";   
                        }
                        

                        
                        


                   
                 }
                    $textoCsv =  $textoCsv . "salto";

                }





                printf($textoCsv);   




            }else{
                //se debe mostrar una garfica vacia
            }



       
        
		
        return view('reporte', compact('user'));
    }
    //Grafica de total de aciertos por pregunta en una prueba
    private function grafica1(){
    	$aciertos  = \Lava::DataTable();
        $claves = DB::table('preguntas')->get();
        //$consulta='kj';

        //
        
            

		$aciertos->addStringColumn('Cantidad Aciertos')
	      ->addNumberColumn('Aciertos')
	      ->addNumberColumn('Fallas');
	    
            foreach ($claves as $clave) {
                  
                   $aciertos->addRow([ '¿Donde dice '.$clave->clave.' ?' , $this->aciertosDe($clave->clave),$this->fallosDe($clave->clave) ]); 
                   //aqui tengo la clave para consultar los aciertos y los errores en otra funcion
                 }	 
        
  

		\Lava::BarChart('Aciertos', $aciertos,
            ['title' => 'Resultados en la prueba',
            'titleTextStyle' => ['color' => 'black','fontSize' => 16],
            'legend' => ['position' => 'bottom'],
            'vAxis' => ['title' => 'Pregunta'],
            'chartArea' => ['width'=> '60%'],
            'colors'=> ['#2EFE2E', '#F7BE81'],
            'height' => (50*count($claves))
            ]);

        \Lava::BarChart('Aciersdfsfdstos', $aciertos,
            ['title' => 'Resultados en la prueba',
            'titleTextStyle' => ['color' => 'black','fontSize' => 16],
            'legend' => ['position' => 'bottom'],
            'vAxis' => ['title' => 'Pregunta'],
            'chartArea' => ['width'=> '60%'],
            'colors'=> ['#2EFE2E', '#F7BE81'],
            'height' => (80*count($claves))
            ]);


    }

    //Grafica de lineas
    private function grafica2(){
    	$items  = \Lava::DataTable();

		$items->addStringColumn('Cantidad Respuestas')
         ->addNumberColumn('Respuestas')
         ->addRow(['Clave: a', 5])
         ->addRow(['Distractor 1: e', 2])
         ->addRow(['Distractor 2: o', 1]);

		\Lava::ColumnChart('Items', $items,
            ['title' => 'Resultados en la pregunta: ¿Donde dice a?',
            'titleTextStyle' => ['color' => 'black','fontSize' => 16],
            'chartArea' => ['width'=> '50%']]);
		
    }


    private function grafica3(){


 
        
      


       // $users = DB::table('ninios')->where('id_nino', '!=', '99999')->get();
        $ninios = DB::table('ninios')->get();
        $itemPregunta = DB::table('preguntas')->get();
         $reporte = "";


            if(count($itemPregunta)>0){//si reportes tiene datos para mostrar
                foreach($itemPregunta as $item){
                   $reporte = $reporte + $item->clave;
                }
           






            }else{
                //se debe mostrar una garfica vacia
            }
     
    }


    public function aciertosDe($clave){
       $aciertos = DB::table('reportes')->where([
                    ['clave', '=', $clave],
                    ['respuesta', '=', $clave]
                ])->get();
        

        return count($aciertos);
    }

    public function fallosDe($clave){
       $aciertos = DB::table('reportes')->where([
                    ['clave', '=', $clave],
                    ['respuesta', '!=', $clave]
                ])->get();
        

        return count($aciertos);
    }
    public function union(){

      $users = DB::table('users')
                     ->select(DB::raw('count(*) as user_count, status'))
                     ->where('status', '<>', 1)
                     ->groupBy('status')
                     ->get();
        return $query;
    }


    public function generaText(){

    }
  

    
}
