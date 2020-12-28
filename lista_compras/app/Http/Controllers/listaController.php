<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\lista;
use App\Models\produto;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;


class listaController extends Controller
{

    public function index(){
        $listas = lista::get();


        foreach ($listas as $lista){

            $items = $this->listItems($lista);
            $lista -> availableItems = $items[0];
            $lista -> items = $items[1];
        }

        return view('index', ['listas'=> $listas->sortBy('updated_at')]);

    }
    function listItems($list){

        $itemsList  = item::where('lista_id',$list->id) -> get();
        $allItems = $this->availableItems($itemsList, $list->id);
        return $allItems;

    }

    function availableItems($items, $lista_id){
        $listItems = [];
        foreach ($items as $item){
            array_push($listItems, $item -> produto_id);
        }

        $produtos = produto::get();
        $available = [];
        $onList = [];

        foreach ($produtos as $prod){
            if(!in_array($prod -> id, $listItems)) {
                array_push($available, $prod);
            }else{
                $qtd = item::where('lista_id',$lista_id) -> where('produto_id', $prod->id) -> first();
                $prod -> qtd =  $qtd-> qtd;
                array_push($onList, $prod);
            }
        }

        return [$available, $onList];
    }

    public function create(Request $request)
    {
        $newList = new lista();
        $newList -> Titulo = $request -> Titulo;
        $newList->save();
        return redirect() -> route('lista_index') -> with('message', 'Lista salva com sucesso');
    }

    public function update(Request $request){
        $lista_id = $request -> lista_id;

        foreach (array_keys($request->nome) as $item){

            $listItem = item::where('lista_id', $lista_id) -> where('produto_id', $item) -> first();
            if($listItem===NULL){
                $listItem = new item();
            }
            if($request->qtd[$item] > 0){
                $listItem -> qtd = $request->qtd[$item];
                $listItem -> produto_id = $item;
                $listItem -> lista_id = $lista_id;
               $listItem -> save();
            }

        }

        return redirect() -> route('lista_index') -> with('message', 'Lista atualizada com sucesso');
    }

    public function destroy(lista $lista)
    {
        $lista = lista::findOrFail($lista->id);
        $lista->delete();
        return redirect() -> route('lista_index') -> with('message', 'Lista excluída com sucesso');

    }


    //
}
