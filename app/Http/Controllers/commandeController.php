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
        $fournisseurs = Fournisseur::where('status', 'Actif')->get();
        $articles = Article::where('status', 'Actif')->get();
        $cmds = Commande::all();

        if ($id != null) {
            $cmd = Commande::findOrFail($id);
            $cv = Vehicule::findOrFail($cmd->id_vehicule);
            $fr = Fournisseur::findOrFail($cmd->id_fournisseur);
            // dd($cmd->articles->get(0)->designation);
            return view('commandes', ['fr' => $fr, 'vh' => $cv, 'data' => $cmd, 'cmds' => $cmds, 'articles' => $articles, 'fournisseurs' => $fournisseurs, 'id' => $id]);
        }
        return view('commandes', ['cmds' => $cmds, 'articles' => $articles, 'fournisseurs' => $fournisseurs]);
    }

    public function getRemise(Request $request, $id = null)
    {
        $fr = Fournisseur::where('code', request('code'))->get();
        return response()->json([
            'fournisseur' => $fr,
        ]);
    }

    public function updatePivot(Request $request, $id = null)
    {
        // $cmd = Commande::findOrFail(request('id_commande'));
        // // $cmd->article();
        // return response()->json([
        //     "test1" => $cmd->articles()->sync([request('id_pivot') => ['quantite_reception' => request('quantite_reception')]])
        // ]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        // $request->validated();
        // dd($request['prevData']);
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

        // dd(request('d'));


        $fr = Fournisseur::where('code', $request['code_fournisseur'])->first();
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
        $cmd->email = $fr->email;
        $cmd->portable = $fr->portable;
        $cmd->adresse = $fr->adresse;
        
        if (request('remise') == $fr->remise_1 || request('remise') == $fr->remise_2 || 
        request('remise') == $fr->remise_3) {
            $cmd->remise = $request['remise'];
            if (!empty(request('matricule')) && !empty(request('mec'))) {
                $vehicule->matricule = request('matricule');
                $vehicule->mec = request('mec');
            }
            $cmd->id_fournisseur = $fr->id;
            $cmd->date = now();

            $list = [];
            $cmd_total = 0;

            if (isset($request['d'])) { 
                if (count(request('d')) != 0) {
                    for ($i = 0; $i < count(request('d')); $i++) {
                        $id_article = Article::where('designation', request('d')[$i])->first();
                        $prix_net = ($id_article->pa - $id_article->pa * (request('ra')[$i] - request('ru')[$i]));
                        $total = request('q')[$i] * $prix_net;
                        $list[] = [
                            "article_id" => $id_article->id,
                            "designation" => request('d')[$i],
                            "pa" => $id_article->pa,
                            "remise" => request('ra')[$i],
                            "quantite" => request('q')[$i],
                            "remise_utilisateur" => request('ru')[$i],
                            "prix_net" => $prix_net,
                            "total" => $total,
                            "quantite_reception" => 0
                        ];
                        $cmd_total += $total;
                    }
                    $vehicule->save();
                    $cmd->id_vehicule = $vehicule->id;
                    $cmd->total = $cmd_total;
                    $cmd->status = 0;
                    $cmd->save();
    
                    $cmd->articles()->sync($list);
                    return redirect('/commandes');
                } else {
                    return redirect('/commandes');
                }
            } else {
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
        $data = $request->all();
        $cmd = Commande::findOrFail($id);
        $v = Vehicule::findOrFail($cmd->id_vehicule);
        $fr = Fournisseur::where(['code' => $data['code_fournisseur'], 'status' => 'Actif'])->first();

        $cmd->code_fournisseur = $data['code_fournisseur'];
        $cmd->email = $fr->email;
        $cmd->portable = $fr->portable;
        $cmd->adresse = $fr->adresse;

        if ($data['remise'] == $fr->remise_1 || $data['remise'] == $fr->remise_2 || 
        $data['remise'] == $fr->remise_3) {
            $cmd->remise = $data['remise'];
            if (!empty($data['matricule']) && !empty($data['mec'])) {
                $v->matricule = $data['matricule'];
                $v->mec = $data['mec'];
            }
            $cmd->id_fournisseur = $fr->id;
            $cmd->date = now();

            $list = [];
            $cmd_total = 0;

            if (isset($data['d'])) {
                if (count($data['d']) != 0) {
                    for ($i = 0; $i < count($data['d']); $i++) {
                        $id_article = Article::where('designation', $data['d'][$i])->first();
                        $prix_net = ($id_article->pa - $id_article->pa * ($data['remise'] - $data['ru'][$i]));
                        $total = $data['q'][$i] * $prix_net;
                        $list[] = [
                            "article_id" => $id_article->id,
                            "designation" => $data['d'][$i],
                            "pa" => $id_article->pa,
                            "remise" => $data['remise'],
                            "quantite" => $data['q'][$i],
                            "remise_utilisateur" => $data['ru'][$i],
                            "prix_net" => $prix_net,
                            "total" => $total,
                            "quantite_reception" => 0
                        ];
                        $cmd_total += $total;
                    }
                    $v->save();
                    $cmd->id_vehicule = $v->id;
                    $cmd->total = $cmd_total;
                    $cmd->status = 0;
                    $cmd->save();
    
                    $cmd->articles()->sync($list);
                    // dd($cmd->articles()->sync($list));
                    return redirect('/commandes');
                } else {
                    return redirect('/commandes');
                }
            } else {
                return redirect()->route('commande.update', ['id' => $id]);
            }
        } else {
            return redirect('/commandes');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cmd = Commande::findOrFail($id);
        $v = Vehicule::findOrFail($cmd->id_vehicule);
        $cmd->articles()->sync([]);
        $cmd->delete();
        $v->delete();
        return redirect('/commandes');
    }
}
