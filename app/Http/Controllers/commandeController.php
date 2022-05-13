<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandeValidationRequest;
use App\Models\Fournisseur;
use App\Models\Article;
use App\Models\Purchase_order;
use App\Models\Purchase_order_product;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $op = Purchase_order_product::all();
        $art = Article::find(1);
        foreach ($art->purchase_orders as $role) {
            dd($role->pivot->remise);
        }
        if ($id != null) {
            return view('commandes', [ 'op' => $op, 'articles' => $articles, 'fournisseurs' => $fournisseurs, 'id' => $id]);
        }
        return view('commandes', [ 'op' => $op, 'articles' => $articles, 'fournisseurs' => $fournisseurs, 'id' => $id]);
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
    public function store(CommandeValidationRequest $request)
    {
        $validatedData = $request->validated();
        $fr = Fournisseur::where('code', request('code'))->get();
        $art = Article::where('code', request('code_article'))->get();
        $order_product = new Purchase_order_product();
        $order = new Purchase_order();
        $vehicule = new Vehicule();
        $c = Purchase_order::count() + 1;

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

        $order->code_commande = "CD200".date('y').date('m')."-".$f;
        $order->code_fournisseur = request('code');
        $order->date = Carbon::now();
        $order->email = $fr[0]->email;
        $order->portable = $fr[0]->portable;
        $order->adresse = $fr[0]->adresse;
        
        if (request('remise') == $fr[0]->remise_1 || request('remise') == $fr[0]->remise_2 || 
        request('remise') == $fr[0]->remise_3) {
            $order->remise = request('remise');
            $vehicule->matricule = request('matricule');
            $vehicule->mec = request('mec');
            $vehicule->save();
            $order->id_vehicule = $vehicule->id;
            $order->id_fournisseur = $fr[0]->id;
            $order->save();
            $order_product->purchase_order_id = $order->id;
            $order_product->article_id = $art[0]->id;
            if ($art[0]->designation == request('designation') && $art[0]->pa == request('pa') && 
            $order->remise == request('remise_article')) {
                $order_product->designation = request('designation');
                $order_product->quantite = request('quantite');
                $order_product->pa = request('pa');
                $order_product->remise = request('remise_article');
                $order_product->remise_utilisateur = request('remise_utilisateur');
                $order_product->prix_net = ((request('pa') * (request('remise_article') + request('remise_utilisateur'))) / 100) 
                + ((request('remise_article') + request('remise_utilisateur')));
                $order_product->total = $order_product->prix_net * request('quantite');

                $order_product->save();
                return redirect('/commandes');
            }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $pp = Purchase_order_product::find($request->input('delete'));
        $po = Purchase_order::find($pp->purchase_order_id);
        $v = Vehicule::find($po->id_vehicule);

        $v->delete(); $po->delete(); $pp->delete();
        return redirect('/commandes');
    }
}
