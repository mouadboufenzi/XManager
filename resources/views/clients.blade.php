@extends('layouts.layout')

@section('title/addFile')
    <link rel="stylesheet" href="/style.css">
    <title>XManager - Clients</title>
@endsection

@section('clients')
    active
@endsection

@section('nav')
    <div class="navtous">
        <div class="navtous1">
            <span class="txt">Clients</span>
        </div>
        <div class="navtous2">
            <i class="f1 fa-solid fa-house"></i>
            <span class="f2">|</span>
            <p class="f3">Clients</p>
        </div>
    </div>
@endsection

@section('filter-form')
    <div class="myFilter s">
        <form class="mine" action="" method="post">
            @csrf
            @method('post')
            <div class="form-group0">
                <div class="sec">
                    <span>Code : </span>
                    <input name="code" type="text" class="form-control" placeholder="Code">
                </div>


                <div class="sec0">
                    <span>Nom / Raison Sociale : </span>
                    <input name="nom" type="text" class="form-control" placeholder="Nom / Raison Sociale">
                </div>

                <div class="sec uno">
                    <span>Status : </span>
                    <select name="status" class="form-select" aria-label="Default select example" placeholder="text">
                        <option selected>Status</option>
                        <option value="Actif">Actif</option>
                        <option value="Inactif">Inactif</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('table')
    <div class="dataField dataFieldclient">
        <table id="articles">
            <thead>
                <tr>
                    <th id="id">ID</th>
                    <th id="id">CODE</th>
                    <th id="id">NOM / RAISON SOCIALE</th>
                    <th id="id">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td id="id"><a href="/clients/{{$client->id}}">{{$loop->index + 1}}</a></td>
                        <td id="id">{{$client->code}}</td>
                        <td id="id">{{$client->nom}}</td>
                        <td id="id"><span id="{{($client->status == "Actif") ? "g" : "r"}}">{{$client->status}}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('tabs')
    <input id="tab1" type="radio" name="tabs" checked>
    <label for="tab1">Identifiant</label>

    <input id="tab2" type="radio" name="tabs">
    <label for="tab2">Gestion</label>

    <input id="tab3" type="radio" name="tabs">
    <label for="tab3">Contact</label>

    <input id="tab4" type="radio" name="tabs">
    <label for="tab4">Adresse</label>

    <section id="content1">
        <div class="myForm">
            <form id="myForm" action="{{isset($id) ? route('client.update', ['id' => $id]) : route('client.store')}}" method="post">
                @csrf
                @if (isset($id))
                    @method('put')
                @endif
                <input id="store_route" type="hidden" id="store_route" value="{{route('client.store')}}">
                <div class="form-group">
                    <span>Famille : </span>
                    <select id="categorie" name="categorie" class="form-select" aria-label="Default select example">
                        <option selected>Famille</option>
                        <option value="Particulier" @if (isset($id) && $that_client->categorie == "Particulier")
                            selected
                        @endif>Particulier</option>
                        <option value="GrandCompte" @if (isset($id) && $that_client->categorie == "GrandCompte")
                            selected
                        @endif>GrandCompte</option>
                    </select>

                    <span>Categorie : </span>
                    <select id="categorie" name="categorie" class="form-select" aria-label="Default select example">
                        <option selected>Categorie</option>
                        <option value="Categorie 1" @if (isset($id) && $that_client->categorie == "Categorie 1")
                            selected
                        @endif>Categorie 1</option>
                        <option value="Categorie 2" @if (isset($id) && $that_client->categorie == "Categorie 2")
                            selected
                        @endif>Categorie 2</option>
                        <option value="Categorie 3" @if (isset($id) && $that_client->categorie == "Categorie 3")
                            selected
                        @endif>Categorie 3</option>
                    </select>
                    
                    <span>Agent Commercial : </span>
                    <input id="agentcommercial" name="agentcommercial" type="text" class="form-control" placeholder="Agent Commercial" value="{{isset($id) ? $that_client->agent_commercial : ''}}">
                    {{-- <input id="nom_agent_commercial" name="nom_agent_commercial" type="hidden" class="form-control" placeholder="Nom Agent Commercial" value="{{isset($that_client->agent_commercial) ? '}}"> --}}

                    <span>Status : </span>
                    <select id="status" name="status" class="form-select" aria-label="Default select example" placeholder="text">
                        <option selected>Status</option>
                        <option value="Actif" @if (isset($id) && $that_client->status == "Actif")
                            selected
                        @endif>Actif</option>
                        <option value="Inactif" @if (isset($id) && $that_client->status == "Inactif")
                            selected
                        @endif>Inactif</option>
                    </select>
                </div>
                <button onMouseOver="this.style.color='#7c73e6' ; this.style.background='white'; this.style.borderColor='#7c73e6'"
                onMouseOut="this.style.color='white' ; this.style.background='#7c73e6'" 
                style="color: white; background: #7c73e6; transition-duration: 0.4s; border:1px solid #7c73e6 ;" 
                type="submit" class="btn btn-primary ed"
                id="submit_btn">
                    {{isset($id) ? "Modifier" : "Enregistrer"}}
                </button>
                <button onMouseOver="this.style.color='white' ; this.style.background='#7c73e6'; this.style.borderColor='#7c73e6'"
                onMouseOut="this.style.color='#7c73e6' ; this.style.background='white'" 
                style="float: right; color: #7c73e6; background: white; transition-duration: 0.4s; border:1px solid #7c73e6 ;" 
                type="button" class="btn btn-primary ed"
                id="clear_btnC">
                    Annuler
                </button>
                <br>
                {{session('msg')}}
        </div>
    </section>

    <section id="content2">
        <div class="myForm">
                <div class="form-group">
                    <span>Raison sociale : </span>
                    <input id="raison_social" name="raison_social" type="text" class="form-control" value="{{(isset($id)) ? $that_client->raison_social : ''}}" placeholder="Raison sociale">

                    <span>IF : </span>
                    <input id="if" name="if" type="text" class="form-control" value="{{(isset($id)) ? $that_client->if : ''}}" placeholder="IF">

                    <span>ICE : </span>
                    <input id="ice" name="ice" type="text" class="form-control" value="{{(isset($id)) ? $that_client->uv : ''}}" placeholder="ICE">

                    <span>RC : </span>
                    <input id="rc" name="rc" type="text" class="form-control" value="{{(isset($id)) ? $that_client->rc : ''}}" placeholder="RC">
                
                    <span>Patente : </span>
                    <input id="patente" name="patente" type="text" class="form-control" value="{{(isset($id)) ? $that_client->patente : ''}}" placeholder="Patente">

                    <span>CIN : </span>
                    <input id="cin" name="cin" type="text" class="form-control" value="{{(isset($id)) ? $that_client->cin : ''}}" placeholder="CIN">
                
                
                    <span>Mode de paiements : </span>
                    <select id="mode_paiement" name="mode_paiement" class="form-select" aria-label="Default select example" placeholder="text">
                        <option selected>none</option>
                        <option value="Cheque" @if (isset($id) && $that_client->mode_paiement == "Cheque")
                            selected
                        @endif>Cheque</option>
                        <option value="Espece" @if (isset($id) && $that_client->mode_paiement == "Espece")
                            selected
                        @endif>Espece</option>
                        <option value="Carte Bancaire" @if (isset($id) && $that_client->mode_paiement == "Carte Bancaire")
                            selected
                        @endif>Carte Bancaire</option>
                    </select>
                </div>
                <div class="form-groupPrice">
                    
                </div>
                <button onMouseOver="this.style.color='#7c73e6' ; this.style.background='white'; this.style.borderColor='#7c73e6'"
                onMouseOut="this.style.color='white' ; this.style.background='#7c73e6'" 
                style="color: white; background: #7c73e6; transition-duration: 0.4s; border:1px solid #7c73e6 ;" 
                type="submit" class="btn btn-primary ed"
                id="submit_btn">
                    {{isset($id) ? "Modifier" : "Enregistrer"}}
                </button>
                <button onMouseOver="this.style.color='white' ; this.style.background='#7c73e6'; this.style.borderColor='#7c73e6'"
                onMouseOut="this.style.color='#7c73e6' ; this.style.background='white'" 
                style="float: right; color: #7c73e6; background: white; transition-duration: 0.4s; border:1px solid #7c73e6 ;" 
                type="button" class="btn btn-primary ed"
                id="clear_btnC">
                    Annuler
                </button>
            </form>
        </div>
    </section>

    <section id="content3">
        <div class="myForm">
                <div class="form-group">
                    <span>Nom : </span>
                    <input id="nom" name="nom" type="text" class="form-control" value="{{(isset($id)) ? $that_client->nom : ''}}" placeholder="Nom">

                    <span>Fonction : </span>
                    <input id="fonction" name="fonction" type="text" class="form-control" value="{{(isset($id)) ? $that_client->fonction : ''}}" placeholder="Fonction">

                    <span>Email : </span>
                    <input id="email" name="email" type="text" class="form-control" value="{{(isset($id)) ? $that_client->email : ''}}" placeholder="Email">

                    <span>Fix : </span>
                    <input id="fix" name="fix" type="text" class="form-control" value="{{(isset($id)) ? $that_client->fix : ''}}" placeholder="Fix">
                
                    <span>Fax : </span>
                    <input id="fax" name="fax" type="text" class="form-control" value="{{(isset($id)) ? $that_client->fax : ''}}" placeholder="Fax">

                    <span>Portable : </span>
                    <input id="portable" name="portable" type="text" class="form-control" value="{{(isset($id)) ? $that_client->portable : ''}}" placeholder="Portable">
                
                
                    
                </div>
                <div class="form-groupPrice">
                    
                </div>
                <button onMouseOver="this.style.color='#7c73e6' ; this.style.background='white'; this.style.borderColor='#7c73e6'"
                onMouseOut="this.style.color='white' ; this.style.background='#7c73e6'" 
                style="color: white; background: #7c73e6; transition-duration: 0.4s; border:1px solid #7c73e6 ;" 
                type="submit" class="btn btn-primary ed"
                id="submit_btn">
                    {{isset($id) ? "Modifier" : "Enregistrer"}}
                </button>
                <button onMouseOver="this.style.color='white' ; this.style.background='#7c73e6'; this.style.borderColor='#7c73e6'"
                onMouseOut="this.style.color='#7c73e6' ; this.style.background='white'" 
                style="float: right; color: #7c73e6; background: white; transition-duration: 0.4s; border:1px solid #7c73e6 ;" 
                type="button" class="btn btn-primary ed"
                id="clear_btnC">
                    Annuler
                </button>
            </form>
        </div>
    </section>

    <section id="content4">
        <div class="myForm">
                <div class="form-group">
                    <span>Adresse : </span>
                    <input id="adresse" name="adresse" type="text" class="form-control" value="{{(isset($id)) ? $that_client->adresse : ''}}" placeholder="Adresse">

                    <span>Ville : </span>
                    <input id="ville" name="ville" type="text" class="form-control" value="{{(isset($id)) ? $that_client->ville : ''}}" placeholder="ville">

                    <span>Pays : </span>
                    <input id="pays" name="pays" type="text" class="form-control" value="{{(isset($id)) ? $that_client->pays : ''}}" placeholder="Pays">
                </div>
                <div class="form-groupPrice">
                    
                </div>
                <button onMouseOver="this.style.color='#7c73e6' ; this.style.background='white'; this.style.borderColor='#7c73e6'"
                onMouseOut="this.style.color='white' ; this.style.background='#7c73e6'" 
                style="color: white; background: #7c73e6; transition-duration: 0.4s; border:1px solid #7c73e6 ;" 
                type="submit" class="btn btn-primary ed"
                id="submit_btn">
                    {{isset($id) ? "Modifier" : "Enregistrer"}}
                </button>
                <button onMouseOver="this.style.color='white' ; this.style.background='#7c73e6'; this.style.borderColor='#7c73e6'"
                onMouseOut="this.style.color='#7c73e6' ; this.style.background='white'" 
                style="float: right; color: #7c73e6; background: white; transition-duration: 0.4s; border:1px solid #7c73e6 ;" 
                type="button" class="btn btn-primary ed"
                id="clear_btn">
                    Annuler
                </button>
            </form>
        </div>
    </section>
@endsection