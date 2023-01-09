<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceptionValidationRequest;
use App\Models\Article;
use App\Models\Commande;
use App\Models\Depot;
use App\Models\Reception;
use App\Models\Stock;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class receptionController extends Controller
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
    public function index($id = null)
    {
        $dep = Depot::all();
        $cmd = Commande::where('status', '<>', 2)->get();
        $rece = Reception::all();
        return view('reception', ['depots' => $dep,'receptions' => $rece, 'cmds' => $cmd]);
    }

    public function receptionCommande(Request $request)
    {
        $id = $request['id'];
        $cmd = Commande::findOrFail($id);
        return response()->json([
            'commandes' => $cmd->articles,
        ]);

        // dd($request['id']);
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
    public function store(ReceptionValidationRequest $request)
    {
        $request->validated();
        $cmd = Commande::findOrFail(request('code_commande'));
        $rece = new Reception();
        $etat = 0;
        $ids_Articles = [];

        if (isset($request['des'])) {
            for ($i=0; $i < count(request('des')); $i++) { 
                $article = Article::where('designation', request('des')[$i])->first();
                array_push($ids_Articles, $article->id);
                $attributes = ['quantite_reception' => request('qr')[$i]];
                $cmd->articles()->updateExistingPivot($article->id, $attributes);
                if (request('qr')[$i] == request('q')[$i]) {
                    $etat++;
                }
            }

            if ($etat == (count(request('des')))) {
                $cmd->status = 2;
                $cmd->save();
                $c = Reception::count() + 1;
                if($c < 10) {
                    $f = "0000".$c;
                } else if ($c < 100) {
                    $f = "000".$c;
                } else if ($c < 1000) {
                    $f = "00".$c;
                } else if ($c < 10000) {
                    $f = "0".$c;
                } else {
                    $f = $c;
                }

                $rece->code = "RECE200".date('y').date('m')."-".$f;
                $rece->commande_id = request('code_commande');
                $rece->date = now();
                $rece->status = 0;
                $rece->depot_id = request('depot');
                $rece->save();
                $articles = [];
                foreach ($rece->commandes as $cmds) {
                    foreach ($cmds->articles as $cmd) {
                        $articles[] = [
                            'id_article' => $cmd->id,
                            'quantite' => $cmd->pivot->quantite
                        ];
                    }
                }
                $dep = Depot::find($rece->depot_id);
                $stocks = Stock::where('id_depot', $dep->id)->get();
                foreach ($stocks as $stock) {
                    $i = 0;
                    $ss = Stock::findOrFail($stock->id);
                    foreach ($ss->articles as $stock_article) {
                        foreach ($articles as $article) {
                            if ($article['id_article'] == $stock_article->id) {
                                $exist = [
                                    $stock_article->pivot->id => [
                                        'stock_id' => $stock_article->pivot->stock_id,
                                        'article_id' => $stock_article->pivot->article_id,
                                        'quantite' => $stock_article->pivot->quantite + $article['quantite'],
                                        'date' => now(),
                                        'created_at' => $stock_article->pivot->created_at,
                                        'updated_at' => $stock_article->pivot->updated_at,
                                    ]
                                ];
                                // $new_quantite = $stock_article->pivot->quantite + ;
                                // $attributes = ['quantite' => $new_quantite];
                                Stock::findOrFail($stocks[$i]->id)->articles()->syncWithoutDetaching($exist);
                            }
                        }
                    }
                    $i++;
                }

                $r = Reception::findOrFail($rece->id);
                $r->articles()->sync($ids_Articles);
            } else {
                $cmd->status = 1;
                $cmd->save();
            }
        }
        return redirect('/receptions');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
