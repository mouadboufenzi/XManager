@extends('layouts.layout')

@section('title/addFile')
    <title>XManager - Articles</title>
@endsection

@section('articles')
    active
@endsection

@section('nav')
    <div class="navtous">
        <div class="navtous1">
            <span class="txt">Articles</span>
        </div>
        <div class="navtous2">
            <i class="f1 fa-solid fa-house"></i>
            <span class="f2">|</span>
            <p class="f3">Articles</p>
        </div>
    </div>
@endsection

@section('filter-form')
    <div class="myFilter">
        <form class="mine" action="" method="post">
            @csrf
            @method('post')
            <div class="form-group0">
                <div class="sec">
                    <span>Article : </span>
                    <input name="code" type="text" class="form-control" placeholder="Article">
                </div>
                
    
                <div class="sec">
                    <span>Categorie : </span>
                    <select name="categorie" class="form-select" aria-label="Default select example">
                        <option selected>Categorie</option>
                        <option value="Categorie 1">Categorie 1</option>
                        <option value="Categorie 2">Categorie 2</option>
                        <option value="Categorie 3">Categorie 3</option>
                    </select>
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
            <div class="form-group1">
                <span>Designation : </span>
                <input name="designation" type="text" class="form-control" placeholder="Designation">
            </div>
        </form>
    </div>
@endsection

@section('table')
    <div class="dataField">
        <table id="articles">
            <thead>
                <tr>
                    <th id="id">ID</th>
                    <th>ARTICLE</th>
                    <th>DESIGNATION</th>
                    <th>CATEGORIE</th>
                    <th id="id">STATUS</th>
                    <th id="id">PRIX DE VENTE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td id="id"><a href="/articles/{{$article->id}}">{{$loop->index + 1}}</a></td>
                        <td>{{$article->code}}</td>
                        <td>{{$article->designation}}</td>
                        <td>{{$article->categorie}}</td>
                        <td id="id"><span id="{{($article->status == "Actif") ? "g" : "r"}}">{{$article->status}}</span></td>
                        <td id="id">{{$article->pv}}</td>
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

    <section id="content1">
        <div class="myForm">
            <form id="myForm" action="{{isset($id) ? route('article.update', ['id' => $id]) : route('article.store')}}" method="post">
                @csrf
                @if (isset($id))
                    @method('put')
                @endif
                <input id="store_route" type="hidden" id="store_route" value="{{route('article.store')}}">
                <div class="form-group">
                    <span>Categorie : </span>
                    <select id="categorie" name="categorie" class="form-select" aria-label="Default select example">
                        <option selected>Categorie</option>
                        <option value="Categorie 1" @if (isset($id) && $that_article->categorie == "Categorie 1")
                            selected
                        @endif>Categorie 1</option>
                        <option value="Categorie 2" @if (isset($id) && $that_article->categorie == "Categorie 2")
                            selected
                        @endif>Categorie 2</option>
                        <option value="Categorie 3" @if (isset($id) && $that_article->categorie == "Categorie 3")
                            selected
                        @endif>Categorie 3</option>
                    </select>

                    <span>Code : </span>
                    <input id="code" name="code" type="text" class="form-control" placeholder="Code" value="{{isset($id) ? $that_article->code : ''}}">

                    <span>Designation : </span>
                    <input id="designation" name="designation" type="text" class="form-control" placeholder="Designation" value="{{isset($id) ? $that_article->designation : ''}}">

                    <span>Status : </span>
                    <select id="status" name="status" class="form-select" aria-label="Default select example" placeholder="text">
                        <option selected>Status</option>
                        <option value="Actif" @if (isset($id) && $that_article->status == "Actif")
                            selected
                        @endif>Actif</option>
                        <option value="Inactif" @if (isset($id) && $that_article->status == "Inactif")
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
        <div class="myForm">
                <div class="form-group">
                    <span>Prix de vente: </span>
                    <input id="pv" name="pv" type="text" class="form-control" value="{{(isset($id)) ? $that_article->pv : ''}}" placeholder="P.V.">

                    <span>Prix d'achat : </span>
                    <input id="pa" name="pa" type="text" class="form-control" value="{{(isset($id)) ? $that_article->pa : ''}}" placeholder="P.A.">

                    <span>Unite de vente : </span>
                    <input id="uv" name="uv" type="text" class="form-control" value="{{(isset($id)) ? $that_article->uv : ''}}" placeholder="U.V.">

                    <span>Unite d'achat : </span>
                    <input id="ua" name="ua" type="text" class="form-control" value="{{(isset($id)) ? $that_article->ua : ''}}" placeholder="U.A.">
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