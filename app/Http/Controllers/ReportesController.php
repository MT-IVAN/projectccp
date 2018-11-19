<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use Khill\Lavacharts\Lavacharts;

class ReportesController extends Controller
{
    public function index()
    {
    	$user = Auth::user();

    	$this->grafica1();
        $this->grafica2();
		
        return view('reporte', compact('user'));
    }
    //Grafica de total de aciertos por pregunta en una prueba
    private function grafica1(){
    	$aciertos  = \Lava::DataTable();

		$aciertos->addStringColumn('Cantidad Aciertos')
	      ->addNumberColumn('Aciertos')
	      ->addNumberColumn('Fallas')
	      ->addRow(['1. ¿Donde dice lpm?',  5,3])
	      ->addRow(['2. ¿Donde dice e?',  3,4])
	      ->addRow(['3. ¿Donde dice ma?',  2,3])
	      ->addRow(['4. ¿Donde dice pa?', 1,3])
	      ->addRow(['5. ¿Donde dice sa?',   4,2]);

		\Lava::BarChart('Aciertos', $aciertos, 
            ['title' => 'Resultados en la prueba',
            'titleTextStyle' => ['color' => 'black','fontSize' => 16],
            'legend' => ['position' => 'bottom'],
            'vAxis' => ['title' => 'Pregunta'],
            'chartArea' => ['width'=> '60%'],
            'colors'=> ['#2EFE2E', '#F7BE81']
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
}
