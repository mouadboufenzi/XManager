<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandeValidationRequest;
use App\Http\Requests\Validation;
use App\Models\Fournisseur;
use App\Models\Article;
use App\Models\Commande;
use App\Models\Purchase_order;
use App\Models\Purchase_order_product;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;

class commandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $fournisseurs = Fournisseur::all();
        $articles = Article::all();
        if ($id != null) {
            return view('commandes', ['articles' => $articles, 'fournisseurs' => $fournisseurs, 'id' => $id]);
        }
        return view('commandes', ['articles' => $articles, 'fournisseurs' => $fournisseurs]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        // $request->validated();
        // dd($request['prevData']);
        
        for ($i = 0; $i < $request['designation']; $i++) {
            $that_art = Article::where(['id' => $request['designation'][$i]])->get();
            if (isset($that_art[0])) {
                $products[$i] = [
                    "id" => $that_art[0]->id,
                    "designation" => $that_art[0]->designation,
                    "pa" => $that_art[0]->pa,
                    "remise" => $request['remise_article'][$i],
                    "quantite" => $request['quantite'][$i],
                    "remise_utilisateur" => $request['remise_utilisateur'][$i],
                    "prix_net" => ($that_art[0]->pa - ($that_art[0]->pa * ($request['remise_article'][$i] + $request['remise_utilisateur'][$i]))),
                    "total" => ($request['quantite'][$i] * ($that_art[0]->pa - ($that_art[0]->pa * ($request['remise_article'][$i] + $request['remise_utilisateur'][$i]))))
                ];
            }
        }

        return redirect('/commandes');
        // $products = [
        //     "id" => $that_art[0]->id,
        //     "designation" => $that_art[0]->designation,
        //     "pa" => $that_art[0]->pa,
        //     "remise" => $request['remise_article'],
        //     "quantite" => $request['quantite'],
        //     "remise_utilisateur" => $request['remise_utilisateur'],
        //     "prix_net" => ($that_art[0]->pa - ($that_art[0]->pa * ($request['remise_article'] + $request['remise_utilisateur']))),
        //     "total" => ($request['quantite'] * ($that_art[0]->pa - ($that_art[0]->pa * ($request['remise_article'] + $request['remise_utilisateur']))))
        // ];
        // return redirect('/commandes')->with(['products' => json_encode($products)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommandeValidationRequest $request)
    {
        $request->validated();



        $fr = Fournisseur::where('code', $request['code_fournisseur'])->get();
        // $art = Article::where('code', request('code_article'))->get();
        // $order_product = new Purchase_order_product();
        // $order = new Purchase_order();
        $cmd = new Commande();
        $vehicule = new Vehicule();
        $c = Commande::count() + 1;

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

        $cmd->code_commande = "CD200".date('y').date('m')."-".$f;
        $cmd->code_fournisseur = request('code_fournisseur');
        $cmd->email = $fr[0]->email;
        $cmd->portable = $fr[0]->portable;
        $cmd->adresse = $fr[0]->adresse;

        // $order->code_commande = "CD200".date('y').date('m')."-".$f;
        // $order->code_fournisseur = request('code');
        // $order->date = Carbon::now();
        // $order->email = $fr[0]->email;
        // $order->portable = $fr[0]->portable;
        // $order->adresse = $fr[0]->adresse;
        
        if (request('remise') == $fr[0]->remise_1 || request('remise') == $fr[0]->remise_2 || 
        request('remise') == $fr[0]->remise_3) {
            $cmd->remise = $request['remise'];
            if (!empty(request('matricule')) && !empty(request('mec'))) {
                $vehicule->matricule = request('matricule');
                $vehicule->mec = request('mec');
                $vehicule->save();
                $cmd->id_vehicule = $vehicule->id;
            }
            // $cmd->id_vehicule = null;
            $cmd->id_fournisseur = $fr[0]->id;
            $cmd->date = now();
            $cmd->save();
            return redirect('/commandes');
        //     $order_product->purchase_order_id = $order->id;
        //     $order_product->article_id = $art[0]->id;
        //     if ($art[0]->designation == request('designation') && $art[0]->pa == request('pa') && 
        //         $order->remise == request('remise_article')) {
        //         $order_product->designation = request('designation');
        //         $order_product->quantite = request('quantite');
        //         $order_product->pa = request('pa');
        //         $order_product->remise = request('remise_article');
        //         $order_product->remise_utilisateur = request('remise_utilisateur');
        //         $order_product->prix_net = ((request('pa') * (request('remise_article') + request('remise_utilisateur'))) / 100) 
        //         + ((request('remise_article') + request('remise_utilisateur')));
        //         $order_product->total = $order_product->prix_net * request('quantite');

        //         $order_product->save();
        //         return redirect('/commandes');
        //     }
        } else {
            return redirect('/commandes');
        }
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $pp = Purchase_order_product::find($request->input('delete'));
        // $po = Purchase_order::find($pp->purchase_order_id);
        // $v = Vehicule::find($po->id_vehicule);

        // $v->delete(); $po->delete(); $pp->delete();
        // return redirect('/commandes');
    }
}
