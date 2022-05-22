<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commande;
use App\Models\Reception;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class receptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $cmd = Commande::where('status', '<>', 2)->get();
        $rece = Reception::all();
        $arr = [];
        foreach ($rece as $rec) {
            array_push($arr, Reception::find($rec->id)->commandes);
        }
        return view('reception', ['data' => $arr ,'receptions' => $rece, 'cmds' => $cmd]);
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
    public function store(Request $request)
    {
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
                $rece->save();
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
