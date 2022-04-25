<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        //
        $clients = Client::all();
        if ($id != null) {
            $that_client = Client::findOrFail($id);
            return view('clients', ['clients' => $clients, 'that_client' => $that_client, 'id' => $id]);
        }
        return view('clients', ['clients' => $clients]);
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
        //
        $client = new Client();

        try {
            $client->code = request('code');
            $client->famille = request('famille');
            $client->categorie = request('categorie');
            $client->status = request('status');
            $client->raison_social = request('raison_social');
            $client->if = request('if');
            $client->ice = request('ice');
            $client->rc = request('rc');
            $client->patente = request('patente');
            $client->cin = request('cin');
            $client->agent_commercial = request('agent_commercial');
            $client->nom_agent_commercial = request('nom_agent_commercial');
            $client->tel_agent_commercial = request('tel_agent_commercial');
            $client->mode_paiement = request('mode_paiement');
            $client->nom = request('nom');
            $client->fonction = request('fonction');
            $client->email = request('email');
            $client->fix = request('fix');
            $client->fax = request('fax');
            $client->portable = request('portable');
            $client->adresse = request('adresse');
            $client->ville = request('ville');
            $client->pays = request('pays');


            $client->save();
            return redirect('/clients')->with('msg', "Added !");
        } catch (\Throwable $th) {
            return redirect('/clients')->with('msg', "One of these fields is empty !");
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
        $newData = $request->all();

        $client = Client::findOrFail($id);

                $client->code = $newData['code'];
                $client->famille = $newData['famille'];
                $client->categorie = $newData['categorie'];
                $client->status = $newData['status'];
                $client->raison_social = $newData['raison_social'];
                $client->if = $newData['if'];
                $client->ice = $newData['ice'];
                $client->rc = $newData['rc'];
                $client->patente = $newData['patente'];
                $client->cin = $newData['cin'];
                $client->agent_commercial = $newData['agent_commercial'];
                // $client->nom_agent_commercial = $newData['nom_agent_commercial'];
                // $client->tel_agent_commercial = $newData['tel_agent_commercial'];
                $client->mode_paiement = $newData['mode_paiement'];
                $client->nom = $newData['nom'];
                $client->fonction = $newData['fonction'];
                $client->email = $newData['email'];
                $client->fix = $newData['fix'];
                $client->fax = $newData['fax'];
                $client->portable = $newData['portable'];
                $client->adresse = $newData['adresse'];
                $client->ville = $newData['ville'];
                $client->pays = $newData['pays'];

                $client->save();
                 return redirect('/clients');
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