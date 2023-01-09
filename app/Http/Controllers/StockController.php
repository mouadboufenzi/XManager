<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockValidationRequest;
use App\Models\Article;
use App\Models\Depot;
use App\Models\Reception;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deps = Depot::all();
        $s = Stock::all();
        $arts = Article::where('status', '=', 'Actif')->get();
        return view('stock', ['stocks' => $s, 'articles' => $arts, 'depots' => $deps]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockValidationRequest $request)
    {
        $request->validated();
        $s = new Stock();
        $s->id_depot = request('depot');
        $s->nom = request('nom');
        if (isset($request['des'])) {
            $s->save();
            $articles = [];
            for ($i=0; $i < count($request['des']); $i++) { 
                $art = Article::where('designation', $request['des'][$i])->first();
                $articles[] = [
                    'stock_id' => $s->id,
                    'article_id' => $art->id,
                    'quantite' => $request['q'][$i],
                    'date' => $request['date'][$i]
                ];
            }
            $s->articles()->sync($articles);
            return redirect('/stock');
        } else {
            return redirect('/stock');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $s = Stock::findOrFail($id);
        $s->articles()->sync([]);
        $s->delete();
        return redirect('/stock');
    }
}
