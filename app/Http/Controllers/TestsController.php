<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prueba;
use App\Item;
use App\Resultado;
use Illuminate\Support\Facades\DB;
Use Session;

class TestsController extends Controller
{

    public function index(Request $request)
    {

        $ids = $request->nombreNinoRegistrer; //aqui se obtiene el valor ingresado;
        $users2 = DB::table('ninios')->where('id_nino', '=', $ids)->get();
     
        if(count($users2)>0){
            foreach ($users2 as $user) {
            $nombreJugador =$user->nombre;
            $idJugadorActual = $user->id;
            print_r($idJugadorActual);
            
            }
            Session::put('nombreJugador', $nombreJugador. " " . $idJugadorActual);
            
        }

        else{
            return back()->with('msj', 'El id ingresado no se encuentra registrado');

        }

        // el codigo en la parte de arriba es agregado por Ivan ERaso

    	$prueba = Prueba::where('visible', 1)->get();
    	if($prueba->isEmpty()){
    		$lblPregunta="No existe un prueba disponible";
            $nvs=$ids=$its=0;
    	}else{
            $nvs=$this->niveles($prueba[0]->id);
            if($nvs!=null){
    		$items = Item::where('prueba_id', $prueba[0]->id)->orderBy('nivel', 'ASC')->get();
            $item = $items[0];
            $its = $this->aleatorio($item);
            $ids = $items->pluck('id')->toArray();
            $ids[count($ids)]=$prueba[0]->porcentaje;
            $ids[count($ids)]=100;
	    	$lblPregunta="Nivel ".$nvs[0]." ¿Donde dice, ".$item->clave."? ";
            //echo "esta es la clave; ".$item->clave;	
        }
        else{
            $lblPregunta="No existen preguntas disponible";
            $nvs=$ids=$its=0;
        }

    }
    	return view('test', compact('lblPregunta','its','ids','nvs'));
    }

    public function cambiar(Request $request){
        $ids = $request->ids;//Id's de las preguntas faltantes        
        $ids = unserialize($ids);
        $nvs = $request->nvs;//cantidad de preguntas por nivel        
        $nvs = unserialize($nvs);
        //Si aún existen preguntas y el porcentaje de aciertos es mayor al propuesto
        if(count($ids)>3){
            $item = Item::find($ids[0]);
            $this->registrarResultado($item->id,$request->rta);
            // AQUI se registra la respuesta con el nombre del jugador actual 
            DB::table('reporte')->insert(['nombre' => Session::get('nombreJugador'), 'clave'=>$item->clave, 'esperado' => $request->rta ]);

            //Si no acierta
            if($request->rta!=$item->clave){
                $valorPregunta = 100/($nvs[1]);
                $ids[count($ids)-1]=$ids[count($ids)-1]-$valorPregunta;
            }
            array_splice($ids, 0, 1);
            //para determinar el nivel
            if($nvs[2]>1){
                $nvs[2]--;
            }else{
                array_splice($nvs, 0, 3);
                if($ids[count($ids)-1]>=$ids[count($ids)-2]){
                    $ids[count($ids)-1]=100;    
                }else{
                    $lblPregunta="Fin de la prueba";
                    $nvs=$its=0;
                    $ids = -1;
                    return view('test', compact('lblPregunta','its','ids','nvs'));
                }
            }
        	$item = Item::find($ids[0]);
            $its = $this->aleatorio($item);
        	$lblPregunta="Nivel ".$nvs[0]." ¿Donde dice, ".$item->clave."? ";
        }else{
            $item = Item::find($ids[0]);
            $this->registrarResultado($item->id,$request->rta);
            $lblPregunta="Fin de la prueba";
            $nvs=$its=0;
            $ids = -1;
        }
        return view('test', compact('lblPregunta','its','ids','nvs'));
    }
    //Se encarga de ubicar de forma aleatoria las opciones de respuesta
    private function aleatorio($item){
        $its2[0]=$item->clave;
        $its2[1]=$item->distractor1;
        $its2[2]=$item->distractor2;
        $its[0]="0";
        $its[1]="0";
        $its[2]="0";
        for ($i=0;$i<3;$i++){
            $pos = rand(0, 2);
            if($its[$pos]=="0"){
                $its[$pos]=$its2[$i];
            }else{
                $i--;
            }
        }
        return $its;
    }
    //Se encarga de determinar la cantidad de preguntas por nivel
    private function niveles($prueba_id){
        $nvs=null;
        $items = Item::select(DB::raw('count(*) as cantidad, nivel'))
                     ->where('prueba_id', '=', $prueba_id)
                     ->groupBy('nivel')
                     ->orderBy('nivel', 'ASC')
                     ->get();
        $i=0;
        if($items!=null){
        foreach ($items as $item) {
            $nvs[$i]=$item->nivel;
            $nvs[$i+1]=$item->cantidad;
            $nvs[$i+2]=$item->cantidad;
            $i+=3;
        }}
        
        return $nvs;
    }

    private function registrarResultado($itemId,$respuesta){
        $resultado = new Resultado();
        $resultado->respuesta = $respuesta;
        $resultado->item_id = $itemId;
        $resultado->save();
    }
}
