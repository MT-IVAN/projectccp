<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Pregunta;
use DB;

class PreguntasController extends Controller
{
    public function inicio()
    {
        $users2 = DB::table('ninios')->where('id', '=', 1)->get();  
        $users = DB::table('ninios')->get();           
        return view('welcome', compact('users'));
    }
    public function pruebaNino(){
        return redirect('welcome');
    }

    public function index()
    {
        $user = Auth::user();
        $preguntas = Pregunta::orderBy('nivel', 'ASC')->paginate(20);
       // $preguntas = Pregunta::paginate(1);
        return view('preguntas', compact('user','preguntas'));
    }

    public function add()
    {
    	return view('add');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'clave' => 'bail|required|max:190',
            'distractor1' => 'bail|required|max:190',
            'distractor2' => 'bail|required|max:190',
            'nivel' => 'required|max:11',
        ]);
    	$pregunta = new Pregunta();
    	$pregunta->clave = $request->clave;
    	$pregunta->distractor1 = $request->distractor1;
    	$pregunta->distractor2 = $request->distractor2;
        $pregunta->nivel = $request->nivel;
    	$pregunta->save();
    	return redirect('/preguntas'); 
    }

    public function edit($id)
    {
        $pregunta = Pregunta::find($id);
        if (Auth::check())
        {            
                return view('edit', compact('pregunta'));
        }           
        else {
             return redirect('/preguntas');
        }  
    }

    public function update(Request $request, $id)
    {
        $pregunta = Pregunta::find($id);
        if(isset($_POST['delete'])) {
            $pregunta->delete();
        }
        else
        {
            $this->validate($request, [
                'clave' => 'bail|required|max:190',
                'distractor1' => 'bail|required|max:190',
                'distractor2' => 'bail|required|max:190',
                'nivel' => 'required|max:11',
            ]);
            $pregunta->clave = $request->clave;
            $pregunta->distractor1 = $request->distractor1;
            $pregunta->distractor2 = $request->distractor2;
            $pregunta->nivel = $request->nivel;
            $pregunta->save();
            $pregunta->save();
        }
        return redirect('/preguntas');
    }

}
