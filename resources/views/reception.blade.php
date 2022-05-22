@extends('layouts.layout0')

@section('title/addFile')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>XManager - Reception</title>
@endsection

@section('reception')
    active
@endsection

@section('nav')
    <div class="navtous">
        <div class="navtous1">
            <span class="txt">Receptions</span>
        </div>
        <div class="navtous2">
            <i class="f1 fa-solid fa-house fcmd1"></i>
            <span class="f2 fcmd2">|</span>
            <p class="f3 fcmd3">Receptions</p>
        </div>
    </div>
@endsection

@section('table')
    <div class="dataField datacmd">
        <table id="articles">
            <thead>
                <tr>
                    <th id="id">Code reception</th>
                    <th id="id">Code commande</th>
                    <th id="id">Code fournisseur</th>
                    <th id="id">Date reception</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($receptions as $reception)
                    <tr>
                        <td id="id">{{$reception->code}}</td>
                        <td id="id">{{$reception->commande_id}}</td>
                        <td id="id">{{$data[$i][0]->code_fournisseur}}</td>
                        <td id="id">{{$reception->date}}</td>
                    </tr>
                    @php
                        $i = $i + 1;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('tabs')
    <div class="yard2 yardcmd">
        <div id="tsum-tabs">
            <form id="myForm" action="{{route('reception.store')}}" method="post">
                @csrf
                <main>
                <input id="tab1" type="radio" name="tabs" checked>
                <label for="tab1">Commande</label>

                <input id="tab2" type="radio" name="tabs" disabled>
                <label for="tab2">Article</label>

                <section id="content1">
                    <div class="myForm">
                            {{-- <input id="store_route" type="hidden" id="store_route" value="{{route('article.store')}}"> --}}
                            <div class="form-group">
                                <span>Code Commande : </span>
                                <select id="code" name="code_commande" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Code Commande</option>
                                    @foreach ($cmds as $cmd)
                                        <option  value="{{$cmd->id}}">{{$cmd->code_commande}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button onMouseOver="this.style.color='#7c73e6' ; this.style.background='white'; this.style.borderColor='#7c73e6'"
                            onMouseOut="this.style.color='white' ; this.style.background='#7c73e6'" 
                            style="color: white; background: #7c73e6; transition-duration: 0.4s; border:1px solid #7c73e6 ;" 
                            type="submit" name="action" value="enregistrer" class="btn btn-primary ed"
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
                            <br>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                    </div>
                </section>

                <section id="content2">
                    <div class="myForm">
                        <div class="rece">
                            <table class="art" id="articles">
                                <thead>
                                    <tr>
                                        <th id="id">CLICK ARTICLE</th>
                                        <th id="id">DESIGNATION</th>
                                        <th id="id">QUANTITE</th>
                                        <th id="id">REMISE</th>
                                        <th id="id">REMISE UTILISATEUR</th>
                                        <th id="id">QUANTITE RECEPTION</th>
                                    </tr>
                                </thead>
                                <tbody id="show">
                                    
                                </tbody>
                            </table>
                        </div> <br>
                            <div id="inp" class="form-group">
                                
                            </div>
                            <button onMouseOver="this.style.color='#7c73e6' ; this.style.background='white'; this.style.borderColor='#7c73e6'"
                            onMouseOut="this.style.color='white' ; this.style.background='#7c73e6'" 
                            style="color: white; background: #7c73e6; transition-duration: 0.4s; border:1px solid #7c73e6 ;" 
                            type="submit" class="btn btn-primary ed"
                            id="submit_btn">
                                Enregistrer
                            </button>
                            <button onMouseOver="this.style.color='white' ; this.style.background='#7c73e6'; this.style.borderColor='#7c73e6'"
                            onMouseOut="this.style.color='#7c73e6' ; this.style.background='white'" 
                            style="float: right; color: #7c73e6; background: white; transition-duration: 0.4s; border:1px solid #7c73e6 ;" 
                            type="button" class="btn btn-primary ed"
                            id="clear_btn">
                                Annuler
                            </button>
                    </div>
                </form>
                </section>
            </main>
        </div>
    </div>
@endsection

@section('jsFiles')
    <script src="/js/res.js"></script>
@endsection