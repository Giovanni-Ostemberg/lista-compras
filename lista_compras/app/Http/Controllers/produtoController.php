<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\produto;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class produtoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = produto::get();
        return view('produtos.index', ['produtos'=> $produtos->sortBy('nome')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newProduct = new produto();
        $newProduct -> nome = $request -> nome;
        $newProduct -> save();
        return redirect() -> route('produto_index') -> with('message', 'Produto salvo com sucesso');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, produto $produto)
    {
        $produto = produto::findOrFail($produto->id);
        $produto->nome = $request -> nome;
        $produto->save();
        return redirect() -> route('produto_index') -> with('message', 'Produto atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(produto $produto)
    {
        $produto = produto::findOrFail($produto->id);
        $produto->delete();
        return redirect() -> route('produto_index') -> with('message', 'Produto excluído com sucesso');

    }

    public function listByPeriod(Request $request){
        if($request->period){
            $startTimeStamp = new Carbon($request->period[0]);
            $endTimeStamp = new Carbon($request->period[1]);

            $startTimeStamp = $startTimeStamp ->startOfDay();
            $endTimeStamp = $endTimeStamp->endOfDay();

        }else{
            $startTimeStamp = Carbon::now()->startOfMonth();
            $endTimeStamp = Carbon::now();
        }


        $endTimeString = $endTimeStamp->toDateString();
        $startTimeString = $startTimeStamp->toDateString();

        $listaProdutos = DB::table('items')
            ->join('listas', 'items.lista_id', '=', 'listas.id')
            ->join('produtos', 'items.produto_id', '=', 'produtos.id')
            ->where("listas.created_at", '>=', $startTimeStamp)
            ->where("listas.created_at", '<=', $endTimeStamp->addDay())
            ->select('produtos.nome as produto', DB::raw('SUM(items.qtd) as produto_qtd'))
            ->groupBy('produtos.id', 'produtos.nome')
            ->get();



        return view('produtos.listarPorPeriodo', ['produtos'=> $listaProdutos->sortBy('produto'), 'startTimestamp'=>$startTimeString, 'endTimestamp'=>$endTimeString]);
    }
}


