@extends('layouts.layout0')

@section('title/addFile')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                    <th id="id">Code commande</th>
                    <th id="id">Fournisseur</th>
                    <th id="id">Vehicule</th>
                    <th id="id">Total</th>
                    <th id="id">Reception status</th>
                    <th id="id">Action</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($cmds as $cmd)
                    <form action="{{route('commande.destroy', ['id' => $cmd->id])}}" method="post">
                        @csrf
                        @method('delete')
                        <tr>
                            <td id="id">
                                <a @if ($cmd->status != 2)
                                    href="/commandes/{{$cmd->id}}"
                                @endif>{{$cmd->code_commande}}
                                </a>
                            </td>
                            <td id="id">
                                {{$cmd->code_fournisseur}}
                            </td>
                            <td id="id">
                                {{$cmd->vehicules->matricule}}
                            </td>
                            <td id="id">
                                {{$cmd->total}} Dhs
                            </td>
                            <td id="id">
                                {{$cmd->status}}
                            </td>
                            <td id="id" id="id">
                                <button value='{{$cmd->id}}' class="iconAct" type="submit"><i class='bx bxs-trash'></i></button>
                            </td>
                        </tr>
                    </form>
                    @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('tabs')
    <div class="yard2 yardcmd">
        <div id="tsum-tabs">
            <form id="myForm" action="{{(isset($id)) ?  route('commande.update', ['id' => $id]) : route('commande.store')}}" method="post">
                @csrf
                @if (isset($id))
                    @method('PUT')
                @endif
                <main>
                <input id="tab1" type="radio" name="tabs" checked>
                <label for="tab1">Commande</label>

                <input id="tab2" type="radio" name="tabs">
                <label for="tab2">Vehicule</label>

                <input id="tab3" type="radio" name="tabs">
                <label for="tab3">Articles</label>

                <section id="content1">
                    <div class="myForm">
                            {{-- <input id="store_route" type="hidden" id="store_route" value="{{route('article.store')}}"> --}}
                            <div class="form-group">
                                <span>Code fournisseurs : </span>
                                <select id="code" name="code_fournisseur" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Code Fournisseur</option>
                                    @foreach ($fournisseurs as $fournisseur)
                                        <option value="{{$fournisseur->code}}" @if (isset($id) && $data->code_fournisseur == $fournisseur->code)
                                            selected
                                        @endif>{{$fournisseur->code}}</option>
                                    @endforeach
                                </select>

                                <span>Remise : </span>
                                <select id="rm" name="remise" class="form-select" aria-label="Default select example">
                                    @if (isset($id))
                                        <option value="{{$fr->remise_1}}" @if ($cmd->remise == $fr->remise_1)
                                            selected
                                        @endif>{{$fr->remise_1}}</option>
                                        <option value="{{$fr->remise_2}}" @if ($cmd->remise == $fr->remise_2)
                                            selected
                                        @endif>{{$fr->remise_2}}</option>
                                        <option value="{{$fr->remise_3}}" @if ($cmd->remise == $fr->remise_3)
                                            selected
                                        @endif>{{$fr->remise_3}}</option>
                                    @endif
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
                            <div class="form-group">
                                <span>Matricule : </span>
                                <input id="matricule" name="matricule" type="text" class="form-control" value="{{((isset($id)) ? $vh->matricule : '')}}" placeholder="Matricule">

                                <span>MEC : </span>
                                <input id="mec" name="mec" type="text" class="form-control" value="{{((isset($id)) ? $vh->mec : '')}}" placeholder="MEC">
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
                </section>

                <section id="content3">
                    <div class="myForm">
                        <div class="dataField datacmd2">
                            <table class="art" id="articles">
                                <tbody>
                                    <tr id="end" class="fix">
                                        <td id="id" style="width: 119px">
                                            <select id="designation" name="designation" class="form-select icmd" aria-label="Default select example" placeholder="text">
                                                <option value="" selected>Designation</option>
                                                @foreach ($articles as $article)
                                                    <option value="{{$article->designation}}">{{$article->designation}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td id="id" style="width: 92px">
                                            <input id="quantite" name="quantite" type="text" class="form-control icmd" placeholder="Quantite">
                                        </td>
                                        <td id="id" style="width: 71px">
                                            <input id="remise_article" name="remise_article" type="text" class="form-control icmd" placeholder="Remise" readonly>
                                        </td>
                                        <td id="id" style="width: 179px">
                                            <input id="remise_utilisateur" name="remise_utilisateur" type="text" class="form-control icmd" placeholder="Remise utilisateur">
                                        </td>
                                        <td id="id"><span id="sub" class="iconAct"><i class='bx bx-plus-circle'></i></span></td>

                                    </tr>
                                </tbody>
                            </table>
                            <table class="art" id="articles">
                                <thead>
                                    <tr>
                                        <th id="id">DESIGNATION</th>
                                        <th id="id">QUANTITE</th>
                                        <th id="id">REMISE</th>
                                        <th id="id">REMISE UTILISATEUR</th>
                                        <th id="id">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="show">
                                    @if (isset($id))
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($data->articles->all() as $art)
                                            <tr>
                                                <td id="id" >{{$art->designation}}</td>
                                                <input id="des{{$i}}" type="hidden" name='d[]' value="{{$art->designation}}">
                                                <td id="id" >{{$art->pivot->quantite}}</td>
                                                <input id="q{{$i}}" type="hidden" name='q[]' value="{{$art->pivot->quantite}}">
                                                <td id="id" >{{$art->pivot->remise}}</td>
                                                <input id="ra{{$i}}" type="hidden" name='ra[]' value="{{$art->pivot->remise}}">
                                                <td id="id" >{{$art->pivot->remise_utilisateur}}</td>
                                                <input id="ru{{$i}}" type="hidden" name='ru[]' value="{{$art->pivot->remise_utilisateur}}">
                                                <td id="id"><span onclick='delUp({{$i}})' class="iconAct"><i class='bx bxs-trash'></i></span></td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        <input type="hidden" id="size" value="{{$i}}">
                                    @endif
                                </tbody>
                            </table>
                            </form>

                        </div>
                        <br>
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
            </main>
        </div>
    </div>
@endsection

@section('jsFiles')
    <script src="/js/add.js"></script>
@endsection