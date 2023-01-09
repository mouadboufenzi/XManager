@extends('layouts.layout0')

@section('title/addFile')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
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
                    <th id="id">Depot</th>
                    <th id="id">Date reception</th>
                    <th id="id">Facture status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($receptions as $reception)
                    <tr>
                        <td id="id">{{$reception->code}}</td>
                        <td id="id">{{$reception->commandes[0]->code_commande}}</td>
                        <td id="id">{{$reception->commandes[0]->code_fournisseur}}</td>
                        <td id="id">{{$reception->depot->site}}</td>
                        <td id="id">{{$reception->date}}</td>
                        <td id="id">{{$reception->status}}</td>
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

                            <div style="display: flex; width: 100%;" class="form-group">
                                <div style="width: 90%;" class="add">
                                    <span>Depot : </span>
                                    <select id="depot" name="depot" class="form-select" aria-label="Default select example">
                                        <option value="" selected>Depot</option>
                                        @foreach ($depots as $depot)
                                            <option  value="{{$depot->id}}">{{$depot->site}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="width: 10%; margin-top: 21px; margin-left: 10px;"  class="addButton">
                                    <button style="border: none; background-color: white;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                        <span id="sub" class="iconAct"><i style="font-size: 30px;" class='bx bx-plus-circle'></i></span>
                                    </button>
                                 </div>
                                <!-- Button trigger modal -->
                                
                                
                                <!-- Modal -->
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
                        </form>
                    </div>
                </section>
            </main>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('depot.store')}}" method="post">
                @csrf
            <div class="modal-header">
            <h5 style="text-align: center;" class="modal-title" id="exampleModalLongTitle">Ajout Depot</h5>
            <button type="button" style="border: none; background-color: white;" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" ><box-icon name='x-circle' style="color: #7c73e6; margin-top: 8px" ></box-icon></span>
            </button>
            </div>
            <div class="modal-body">
                <span>Site : </span>
                <input id="site" name="site" type="text" class="form-control" value="{{(isset($id)) ? $that_client->raison_social : ''}}" placeholder="Site">
                <span>Adresse : </span>
                <input id="adresse" name="adresse" type="text" class="form-control" value="{{(isset($id)) ? $that_client->raison_social : ''}}" placeholder="Adresse">
            </div>
            <div class="modal-footer">
            
            <button type="submit" class="btn btn-primary ed" onMouseOver="this.style.color='#7c73e6' ; this.style.background='white'; this.style.borderColor='#7c73e6'"
            onMouseOut="this.style.color='white' ; this.style.background='#7c73e6'" 
            style="color: white; background: #7c73e6; transition-duration: 0.4s; border:1px solid #7c73e6 ;">Ajouter</button>
            </div>
          </form>
        </div>
        </div>
    </div>
@endsection

@section('jsFiles')
    <script src="/js/res.js"></script>
@endsection