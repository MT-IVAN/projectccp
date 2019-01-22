<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Prueba;
use App\Item;
use App\Pregunta;
//use App\Http\Controllers\View;
class PruebasController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $pruebasEditable=Prueba::where('editable', '=', 1)->paginate(100);
        $pruebasNoEditable=Prueba::where('editable', '=', 0)->paginate(100);
        //$pruebas = Prueba::all();

        //$pruebas = Prueba::paginate(4);
        //return view('prueba', compact('user','pruebasEditable','pruebasNoEditable'));

        if ($request->ajax())
        {
        //devolvemos la vista renderizada en formato json
        //$renderPagination = View::make('pruebas_ajax','pruebasEditable','pruebasNoEditable')->render();

        //  return Response::json(array('renderPagination' => $renderPagination));
        return Response::json(array('body' => View::make('prueba',array('pruebasNoEditable'=>$pruebasNoEditable))->render()));
         }
         //si ha sido una recarga de la página devolvemos la vista de forma normal
         else
         {
         return view('prueba', compact('pruebasEditable','pruebasNoEditable'));
         }
            


    }

    public function add()
    {
    	return view('prueba_add');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'bail|required|max:190',
            'descripcion' => 'bail|required|max:190',
            'porcentaje' => 'required|max:11',
        ]);
    	$prueba = new Prueba();
    	$prueba->nombre = $request->nombre;
    	$prueba->descripcion = $request->descripcion;
    	$prueba->porcentaje = $request->porcentaje;
        $prueba->visible = false;
        $prueba->editable = true;
    	$prueba->save();
    	return redirect('/prueba'); 
    }

    public function activar($id)
    {
        $prueba = Prueba::find($id);
        Prueba::where('visible', '=', 1)->update(['visible' => 0]);
        if($prueba->visible)
            $prueba->visible=false;
        else
            $prueba->visible=true;
        $prueba->save();
        //return redirect('/prueba'); 
    }

    public function publicar($id)
    {
        $prueba = Prueba::find($id);
        $prueba->editable=false;
        $prueba->save();
        return redirect('/prueba'); 
    }

    public function edit($id)
    {
        $prueba = Prueba::find($id);
        if (Auth::check())
        {            
                return view('prueba_edit', compact('prueba'));
        }           
        else {
             return redirect('/prueba');
        }  
    }

    public function update(Request $request, $id)
    {
        $prueba = Prueba::find($id);
        if(isset($_POST['delete'])) {
            $prueba->delete();
        }
        else
        {
            $this->validate($request, [
                'nombre' => 'bail|required|max:190',
                'descripcion' => 'bail|required|max:190',
                'porcentaje' => 'required|max:11',
            ]);
            $prueba->nombre = $request->nombre;
            $prueba->descripcion = $request->descripcion;
            $prueba->porcentaje = $request->porcentaje;
            $prueba->visible = false;
            $prueba->editable = true;
            $prueba->save();
        }
        return redirect('/prueba');
    }

    public function delete(Request $request, $id)
    {
        $prueba = Prueba::find($id);
        if(isset($_POST['delete'])) {
            $prueba->delete();
        }
        return redirect('/prueba');
    }

    public function details($id)
    {
        $prueba = Prueba::find($id);
        if (Auth::check())
        {            
                return view('prueba_details', compact('prueba'));
        }           
        else {
             return redirect('/prueba');
        }  
    }

    public function preguntas(Request $request, $id)
    {
        
        if(isset($_POST['datos'])) {
            $indexes = explode(" ", $_POST['datos']);
            foreach ($indexes as $index) {
                $pregunta = Pregunta::find($index);
                $item = new Item();
                $item->clave = $pregunta->clave;
                $item->distractor1 = $pregunta->distractor1;
                $item->distractor2 = $pregunta->distractor2;
                $item->nivel = $pregunta->nivel;
                $item->prueba_id = $id;
                $item->save();
            }
        }
        return redirect('/items/'.$id);
    }

    public function prueba(Request $request){
        $id=explode("/",$request->id);
        $this->activar($id[1]);
        $prueba = Prueba::where('editable', 0)->get();
        return response()->json($prueba);
    }
}
