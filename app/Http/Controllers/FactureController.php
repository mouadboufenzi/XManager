<?php

namespace App\Http\Controllers;

use App\Http\Requests\FactureValidationRequest;
use App\Models\Facture;
use App\Models\Reception;
use App\Models\Commande;
use Illuminate\Http\Request;

class FactureController extends Controller
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
        //
        $reception = Reception::where('status', '<>', 1)->get();
        $factures = Facture::all();


        if ($id != null) {
            $cmd = Commande::findOrFail($id);
            return view('facture', ['receptions'=> $reception, 'factures'=> $factures, 'commandes' => $cmd->articles]);
        }
        return view('facture', ['receptions'=> $reception, 'factures'=> $factures]);
    }

    public function factureCreate(Request $request)
    {
        $facture = Facture::findOrFail(request('id'));
        $num_facture = $facture->id;
        $date_facture = $facture->date_facture;
        $code_reception = $facture->reception->code;
        $date_reception = $facture->reception->date;
        $cmd = Commande::findOrFail($facture->reception->commande_id);
        $cmd_date = $cmd->date;
        $code_commande = $cmd->code_commande;
        $total_commande = $cmd->total;
        $code_fournisseur = $cmd->code_fournisseur;
        return response()->json([
            'num_facture' => $num_facture,
            'date_facture' => $date_facture,
            'code_reception' => $code_reception,
            'date_reception' => $date_reception,
            'code_commande' => $code_commande,
            'date_commande' => $cmd_date,
            'total_commande' => $total_commande,
            'code_fournisseur' => $code_fournisseur,
            'articles' => $cmd->articles,
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

    public function factureTotal(Request $request)
    {
        $id = $request['id'];
        $reception = Reception::findOrFail($id);

        return response()->json([
            'reception'=> $reception->commandes,
        ]);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FactureValidationRequest $request)
    {
        $request->validated();
        $fact = new Facture();
        $rec = Reception::findOrFail($request['code_reception']);
        $fact->id_reception = $request['code_reception'];
        $fact->montant_total = $request['mt'];
        $fact->date_facture = now();
        if ($fact->save()) {
            $rec->status = 1;
            $rec->save();
        }
        return redirect('/facture');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        //
    }
}
