@extends('layouts.layout0')

@section('title/addFile')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>XManager - Factures</title>
@endsection

@section('facture')
    active
@endsection

@section('nav')
    <div class="navtous">
        <div class="navtous1">
            <span class="txt">Factures</span>
        </div>
        <div class="navtous2">
            <i class="f1 fa-solid fa-house fcmd1"></i>
            <span class="f2 fcmd2">|</span>
            <p class="f3 fcmd3">Factures</p>
        </div>
    </div>
@endsection

@section('table')
    <div class="dataField datacmd">
        <table id="articles">
            <thead>
                <tr>
                    <th id="id">N° facture</th>
                    <th id="id">Code Reception</th>
                    <th id="id">Montant total</th>
                    <th id="id">Date facture</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0
                @endphp
                    @foreach ($factures as $fact)
                        <tr>
                            <td id="fact{{$i}}"  onmouseover="this.style.cursor='pointer'" style="text-align: center;">
                                {{$fact->id}}
                            </td>
                            <input type="hidden" id='id{{$i}}' value="{{$fact->id}}">
                            <td id="id">
                                {{$fact->reception->code}}
                            </td>
                            <td id="id">
                                {{$fact->montant_total}} Dhs
                            </td>
                            
                            <td id="id">
                                {{$fact->date_facture}}
                            </td>
                        </tr>
                        @php
                            $i++
                        @endphp
                    @endforeach
                    <input type="hidden" id="size" value="{{$i}}">
            </tbody>
        </table>
    </div>
@endsection

@section('tabs')
    <div class="yard2 yardcmd">
        <div id="tsum-tabs">
            <form id="myForm" action="" method="post">
                @csrf
                <main>
                <input id="tab1" type="radio" name="tabs" checked>
                <label for="tab1">Ajouter une facture</label>

                <input id="tab2" type="radio" name="tabs" disabled>
                <label for="tab2">La facture</label>


                <section id="content1">
                    <div class="myForm">
                            {{-- <input id="store_route" type="hidden" id="store_route" value="{{route('article.store')}}"> --}}
                            <div class="form-group">
                                <span>Code reception : </span>
                                <select id="code" name="code_reception" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Code Reception</option>
                                    @foreach ($receptions as $reception)
                                        <option value="{{$reception->id}}">{{$reception->code}}</option>
                                    @endforeach
                                </select>

                                <span>Montant total : </span>
                                <input id="mt" name="mt" type="text" class="form-control"  placeholder="Montant total" readonly>
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
                            {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif --}}
                    </div>
                </section>

                <section id="content2">
                    <div class="myForm">
                        <div class="dataField datacmd2" style="height: 420px">
                            <table class="art" id="articles">
                                <tr>
                                    <td id="id" style="width: 48%">Num Facture : </td>
                                    <td id="id"><span id="num"></span></td>
                                </tr>
                                <tr>
                                    <td id="id">Code Reception :  </td>
                                    <td id="id"><span id="code_rec"></span></td>
                                </tr>
                                <tr>
                                    <td id="id">Date Reception : </td>
                                    <td id="id"><span id="date_rec"></span></td>
                                </tr>
                                <tr>
                                    <td id="id">Code Commande : </td>
                                    <td id="id"><span id="code_cmd"></span></td>
                                </tr>
                                <tr>
                                    <td id="id">Date Commande : </td>
                                    <td id="id"><span id="date_cmd"></span></td>
                                </tr>
                                <tr>
                                    <td id="id">Code Fournisseur : </td>
                                    <td id="id"><span id="code_four"></span></td>
                                </tr>
                            </table>
                            <table class="art" id="articles">
                                <thead>
                                    <tr>
                                        <th id="id">DESIGNATION</th>
                                        <th id="id">PRIX D'ACHAT</th>
                                        <th id="id">QUANTITE</th>
                                        <th id="id">PRIX NET</th>
                                        <th id="id">TOTAL</th>
                                    </tr>
                                </thead>
                            
                                <tbody id="show">
                                    {{-- @if (isset($id)) --}}
                                        {{-- @php
                                            $i = 0;
                                        @endphp
                                            @foreach ($commandes as $art)
                                                <tr>
                                                    <td id="id" >{{$art->designation}}</td>

                                                    <td id="id" >{{$art->pivot->quantite}}</td>

                                                    <td id="id" >{{$art->pivot->prix_net}}</td>

                                                    <td id="id" >{{$art->pivot->total}}</td>

                                                </tr>
                                    
                                            @endforeach
                                        @php
                                            $i++;
                                        @endphp --}}
                                    {{-- @endif --}}
                                </tbody>
                            </table>
                            </form>
                        

                        </div>
                            {{-- <button onMouseOver="this.style.color='#7c73e6' ; this.style.background='white'; this.style.borderColor='#7c73e6'"
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
                            </button> --}}
                    </div>
                </section>

                
            </main>
        </div>
    </div>
@endsection

@section('jsFiles')
    <script src="/js/fact.js"></script>
@endsection