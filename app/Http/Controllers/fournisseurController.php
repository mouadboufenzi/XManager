<?php

namespace App\Http\Controllers;

use App\Http\Requests\FournisseurValidationRequest;
use App\Models\Famille;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class fournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $familles = Famille::all();
        $fournisseurs = Fournisseur::all();
        if ($id != null) {
            $that_fournisseur = Fournisseur::findOrFail($id);
            return view('fournisseurs', ['fournisseurs' => $fournisseurs, 'familles' => $familles, 'that_fournisseur' => $that_fournisseur, 'id' => $id]);
        }
        
        return view('fournisseurs', ['fournisseurs' => $fournisseurs, 'familles' => $familles]);
    }

    public function filtreCode(Request $request, $id = null)
    {
        $fr = Fournisseur::where('code', 'like', request('fournisseur').'%')->get();
        return response()->json([
            'fournisseurs' => $fr
        ]);
    }

    public function filtreNom(Request $request, $id = null)
    {
        $fr = Fournisseur::where('nom', 'like', request('nom').'%')->get();
        return response()->json([
            'fournisseurs' => $fr
        ]);
    }

    public function filtreStatus(Request $request, $id = null)
    {
        $fr = Fournisseur::where('status', request('status'))->get();
        return response()->json([
            'fournisseurs' => $fr
        ]);
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
    public function store(FournisseurValidationRequest $request)
    {
        $fournisseur = new Fournisseur();
        if ($request['famille'] == "Particulier") {
            $fournisseur->code = "CEP".Fournisseur::count() + 1;
        } else {
            $fournisseur->code = "CGC".Fournisseur::count() + 1;
        }
            $fournisseur->famille = $request['famille'];            
            $fournisseur->status = $request['status'];
            $fournisseur->raison_social = $request['raison_social'];
            $fournisseur->if = $request['if'];
            $fournisseur->ice = $request['ice'];
            $fournisseur->rc = $request['rc'];
            $fournisseur->patente = $request['patente'];
            $fournisseur->cin = $request['cin'];
            $fournisseur->mode_paiement = $request['mode_paiement'];
            $fournisseur->nom = $request['nom'];
            $fournisseur->fonction = $request['fonction'];
            $fournisseur->email = $request['email'];
            $fournisseur->fix = $request['fix'];
            $fournisseur->fax = $request['fax'];
            $fournisseur->portable = $request['portable'];
            $fournisseur->adresse = $request['adresse'];
            $fournisseur->ville = $request['ville'];
            $fournisseur->pays = $request['pays'];
            if (request('remise_1') != "" && request('remise_2') == "" && request('remise_3') == "") {
                $fournisseur->remise_1 = request('remise_1');
            } else if (request('remise_1') != "" && request('remise_2') != "" && request('remise_3') == "") {
                $fournisseur->remise_1 = request('remise_1');
                $fournisseur->remise_2 = request('remise_2');
            } else if (request('remise_1') != "" && request('remise_2') != "" && request('remise_3') != "") {
                $fournisseur->remise_1 = request('remise_1');
                $fournisseur->remise_2 = request('remise_2');
                $fournisseur->remise_3 = request('remise_3');
            }
            $fournisseur->save();
            return redirect('/fournisseurs')->with('msg', "Added !");
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
        $newData = $request->all();
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->famille = $newData['famille'];
        $fournisseur->status = $newData['status'];
        $fournisseur->raison_social = $newData['raison_social'];
        $fournisseur->if = $newData['if'];
        $fournisseur->ice = $newData['ice'];
            $fournisseur->rc = $newData['rc'];
            $fournisseur->patente = $newData['patente'];
            $fournisseur->cin = $newData['cin'];
            $fournisseur->mode_paiement = $newData['mode_paiement'];
            $fournisseur->nom = $newData['nom'];
            $fournisseur->fonction = $newData['fonction'];
            $fournisseur->email = $newData['email'];
            $fournisseur->fix = $newData['fix'];
            $fournisseur->fax = $newData['fax'];
            $fournisseur->portable = $newData['portable'];
            $fournisseur->adresse = $newData['adresse'];
            $fournisseur->ville = $newData['ville'];
            $fournisseur->pays = $newData['pays'];
            $fournisseur->remise_1 = $newData['remise_1'];
            $fournisseur->remise_2 = $newData['remise_2'];
            $fournisseur->remise_3 = $newData['remise_3'];
        
        $fournisseur->save();
        return redirect('/fournisseurs');
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
