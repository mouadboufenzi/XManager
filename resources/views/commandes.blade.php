@extends('layouts.layout0')

@section('title/addFile')
    <title>XManager - Commandes</title>
@endsection

@section('commande')
    active
@endsection

@section('nav')
    <div class="navtous">
        <div class="navtous1">
            <span class="txt">Commandes</span>
        </div>
        <div class="navtous2">
            <i class="f1 fa-solid fa-house fcmd1"></i>
            <span class="f2 fcmd2">|</span>
            <p class="f3 fcmd3">Commandes</p>
        </div>
    </div>
@endsection

@section('table')
    <div class="dataField datacmd">
        <table id="articles">
            <thead>
                <tr>
                    <th id="id">ARTICLE</th>
                    <th id="id">DESIGNATION</th>
                    <th id="id">P.A.</th>
                    <th id="id">QUANTITE</th>
                    <th id="id">REMISE</th>
                    <th id="id">REMISE UTILISATEUR</th>
                    <th id="id">PRIX NET</th>
                    <th id="id">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr class="fix">
                    <td id="id">
                        <select name="status" class="form-select icmd" aria-label="Default select example" placeholder="text">
                        </select>
                    </td>
                    <td id="id"><input name="" type="text" class="form-control icmd" placeholder="DESIGNATION"></td>
                    <td id="id"><input name="" type="text" class="form-control icmd" placeholder="P.A."></td>
                    <td id="id"><input name="" type="text" class="form-control icmd" placeholder="QUANTITE"></td>
                    <td id="id"><input name="" type="text" class="form-control icmd" placeholder="REMISE"></td>
                    <td id="id"><input name="" type="text" class="form-control icmd" placeholder="REMISE UTILISATEUR"></td>
                    <td id="id"><input name="" type="text" class="form-control icmd" placeholder="PRIX NET"></td>
                    <td id="id"><input name="" type="text" class="form-control icmd" placeholder="TOTAL"></td>
                </tr>
                @for ($i = 0; $i < 100; $i++)
                    <tr>
                        <td id="id">AAAAAA</td>
                        <td id="id">AAAAAA</td>
                        <td id="id">AAAAAA</td>
                        <td id="id">AAAAAAA</td>
                        <td id="id">AAAAAAA</td>
                        <td id="id">AAAAAAA</td>
                        <td id="id">AAAAA</td>
                        <td id="id">AAAAAAAAAAA</td>
                    </tr>
                @endfor
                {{-- @foreach ($articles as $article)
                    <tr>
                        <td id="id"><a href="/articles/{{$article->id}}">{{$loop->index + 1}}</a></td>
                        <td>{{$article->code}}</td>
                        <td>{{$article->designation}}</td>
                        <td>{{$article->categorie}}</td>
                        <td id="id"><span id="{{($article->status == "Actif") ? "g" : "r"}}">{{$article->status}}</span></td>
                        <td id="id">{{$article->pv}}</td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection

@section('tabs')
    <div class="yard2 yardcmd">
        <div id="tsum-tabs">
            <main>
                <input id="tab1" type="radio" name="tabs" checked>
                <label for="tab1">Identifiant</label>

                <input id="tab2" type="radio" name="tabs">
                <label for="tab2">Gestion</label>

                <section id="content1">
                    <div class="myForm">
                        <form id="myForm" action="" method="post">
                            @csrf
                            @if (isset($id))
                                @method('put')
                            @endif
                            <input id="store_route" type="hidden" id="store_route" value="{{route('article.store')}}">
                            <div class="form-group">
                                <span>Categorie : </span>
                                <select id="categorie" name="categorie" class="form-select" aria-label="Default select example">
                                    <option selected>Categorie</option>
                                    {{-- @foreach ($categories as $categorie)
                                        <option value="{{$categorie->categorie}}" @if (isset($id) && $that_article->categorie == "{{$categorie->categorie}}")
                                            selected
                                        @endif>{{$categorie->categorie}}</option>
                                    @endforeach --}}
                                </select>

                                <span>Code : </span>
                                <input id="code" name="code" type="text" class="form-control" placeholder="Code" value="">

                                <span>Designation : </span>
                                <input id="designation" name="designation" type="text" class="form-control" placeholder="Designation" value="">

                                <span>Status : </span>
                                <select id="status" name="status" class="form-select" aria-label="Default select example" placeholder="text">
                                    <option selected>Status</option>
                                    <option value="Actif">Actif</option>
                                    <option value="Inactif">Inactif</option>
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
                    <div class="myForm">
                            <div class="form-group">
                                <span>Prix de vente: </span>
                                <input id="pv" name="pv" type="text" class="form-control" value="" placeholder="P.V.">

                                <span>Prix d'achat : </span>
                                <input id="pa" name="pa" type="text" class="form-control" value="" placeholder="P.A.">

                                <span>Unite de vente : </span>
                                <input id="uv" name="uv" type="text" class="form-control" value="" placeholder="U.V.">

                                <span>Unite d'achat : </span>
                                <input id="ua" name="ua" type="text" class="form-control" value="" placeholder="U.A">
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
            </main>
        </div>
    </div>
@endsection