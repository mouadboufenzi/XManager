@extends('layouts.layout')

@section('title/addFile')
    <title>XManager - Fournisseurs</title>
@endsection

@section('fournisseurs')
    active
@endsection

@section('nav')
    <div class="navtous">
        <div class="navtous1">
            <span class="txt">Fournisseurs</span>
        </div>
        <div class="navtous2">
            <i class="f1 fa-solid fa-house" style="margin-left: 70px"></i>
            <span class="f2" style="margin-left: 20px">|</span>
            <p class="f3">Fournisseurs</p>
        </div>
    </div>
@endsection

@section('filter-form')
    <div class="myFilter s">
        <form class="mine" action="" method="post">
            @csrf
            @method('post')
            <div class="form-group0">
                <div class="sec form">
                    <span>Code : </span>
                    <input name="code" type="text" class="form-control" placeholder="Code">
                </div>
                
    
                <div class="sec0">
                    <span>Nom / Raison Social : </span>
                    <input name="" type="text" class="form-control" placeholder="Nom / Raison Social :">
                </div>
    
                <div class="sec">
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
    <div class="dataField dataFieldFour">
        <table id="articles">
            <thead>
                <tr>
                    <th id="id">ID</th>
                    <th id="id">Code</th>
                    <th id="id">NOM / RAISON SOCIAL</th>
                    <th id="id">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fournisseurs as $fournisseur)
                    <tr>
                        <td id="id"><a href="/fournisseurs/{{$fournisseur->id}}">{{$loop->index + 1}}</a></td>
                        <td id="id">{{$fournisseur->code}}</td>
                        <td id="id">{{isset($fournisseur->raison_social) ? $fournisseur->raison_social : $fournisseur->nom}}</td>
                        <td id="id"><span id="{{($fournisseur->status == "Actif") ? "g" : "r"}}">{{$fournisseur->status}}</span></td>
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

    <input id="tab5" type="radio" name="tabs">
    <label for="tab5">Remise</label>

    <section id="content1">
        <div class="myForm">
            <form id="myForm" action="{{isset($id) ? route('fournisseur.update', ['id' => $id]) : route('fournisseur.store')}}" method="post">
                @csrf
                @if (isset($id))
                    @method('put')
                @endif
                <input id="store_route" type="hidden" id="store_route" value="">
                <div class="form-group">
                    <span>Famille : </span>
                    <select id="categorie" name="famille" class="form-select" aria-label="Default select example">
                        <option selected>Famille</option>
                        <option value="Particulier" @if (isset($id) && $that_fournisseur->famille == "Particulier")
                            selected
                        @endif>Particulier</option>
                        <option value="GrandCompte" @if (isset($id) && $that_fournisseur->famille == "GrandCompte")
                            selected
                        @endif>GrandCompte</option>
                    </select>

                    <span>Status : </span>
                    <select id="status" name="status" class="form-select" aria-label="Default select example" placeholder="text">
                        <option selected>Status</option>
                        <option value="Actif" @if (isset($id) && $that_fournisseur->status == "Actif")
                            selected
                        @endif>Actif</option>
                        <option value="Inactif" @if (isset($id) && $that_fournisseur->famille == "Inactif")
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
                id="clear_btn">
                    Annuler
                </button>
                <br>
                {{session('msg')}}
        </div>
    </section>

    <section id="content2">
        <div class="myForm" style="height: 500px;">
                <div class="form-group">
                    <span>Raison social : </span>
                    <input id="pv" name="raison_social" type="text" class="form-control" value="" placeholder="Raison social">

                    <span>IF : </span>
                    <input id="pa" name="if" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->if : ''}}" placeholder="IF">

                    <span>ICE : </span>
                    <input id="uv" name="ice" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->ice : ''}}" placeholder="ICE">

                    <span>RC : </span>
                    <input id="ua" name="rc" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->rc : ''}}" placeholder="RC">

                    <span>Patente : </span>
                    <input id="ua" name="patente" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->patente : ''}}" placeholder="Patente">

                    <span>CIN : </span>
                    <input id="ua" name="cin" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->cin : ''}}" placeholder="CIN">

                    <span>Mode de paiment : </span>
                    <select id="status" name="mode_paiment" class="form-select">
                        <option selected>Mode de paiment</option>
                        <option value="Cheque" @if (isset($id) && $that_fournisseur->mode_paiment == "Cheque")
                            selected
                        @endif>Cheque</option>
                        <option value="Espece" @if (isset($id) && $that_fournisseur->mode_paiement == "Espece")
                            selected
                        @endif>Espece</option>
                        <option value="Carte bancaire" @if (isset($id) && $that_fournisseur->mode_paiment == "Carte bancaire")
                            selected
                        @endif>Carte bancaire</option>
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
                id="clear_btn">
                    Annuler
                </button>
        </div>
    </section>

    <section id="content3">
        <div class="myForm">
                <div class="form-group">
                    <span>Nom : </span>
                    <input id="pv" name="nom" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->nom : ''}}" placeholder="Nom">

                    <span>Fonction : </span>
                    <input id="pa" name="fonction" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->fonction : ''}}" placeholder="Fonction">

                    <span>Email : </span>
                    <input id="uv" name="email" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->email : ''}}" placeholder="Email">

                    <span>Fix : </span>
                    <input id="ua" name="fix" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->fix : ''}}" placeholder="Fix">

                    <span>Fax : </span>
                    <input id="ua" name="fax" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->fax : ''}}" placeholder="Fax">

                    <span>Portable : </span>
                    <input id="ua" name="portable" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->portable : ''}}" placeholder="Portable">
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
                <br>
        </div>
    </section>

    <section id="content4">
        <div class="myForm">
                <div class="form-group">
                    <span>Adresse : </span>
                    <input id="pv" name="adresse" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->adresse : ''}}" placeholder="Adresse">

                    <span>Ville : </span>
                    <input id="pa" name="ville" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->ville : ''}}" placeholder="Ville">

                    <span>Pays : </span>
                    <input id="uv" name="pays" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->pays : ''}}" placeholder="Pays">
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
        </div>
    </section>

    <section id="content5">
        <div class="myForm">
                <div class="form-group">
                    <span>Remise 1 : </span>
                    <input id="pv" name="remise_1" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->remise_1 : ''}}" placeholder="Remise 1">

                    <span>Remise 2 : </span>
                    <input id="pa" name="remise_2" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->remise_2 : ''}}" placeholder="Remise 2">

                    <span>Remise 3 : </span>
                    <input id="uv" name="remise_3" type="text" class="form-control" value="{{isset($id) ? $that_fournisseur->remise_3 : ''}}" placeholder="Remise 3">
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