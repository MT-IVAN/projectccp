<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Item;
use App\Pregunta;

class ItemsController extends Controller
{
    public function index($id,$item_id=null)
    {
        if($item_id!=null){
            $item = Item::find($item_id);    
            $item->delete();
            return back();
        }
        $user = Auth::user();
        $items = Item::where('prueba_id', $id)->orderBy('nivel', 'ASC')->get();
        return view('items', compact('user','items','id'));
    }

    public function lista($id)
    {
        $user = Auth::user();
        $preguntas = Pregunta::all();
        return view('lista_preguntas', compact('user','id','preguntas'));
    }
}
