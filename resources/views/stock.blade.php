@extends('layouts.layout0')

@section('title/addFile')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>XManager - Stock</title>
@endsection

@section('stock')
    active
@endsection

@section('nav')
    <div class="navtous">
        <div class="navtous1">
            <span class="txt">Stock</span>
        </div>
        <div class="navtous2">
            <i class="f1 fa-solid fa-house fcmd1"></i>
            <span class="f2 fcmd2">|</span>
            <p class="f3 fcmd3">Stock</p>
        </div>
    </div>
@endsection

@section('table')
    <div class="dataField datacmd">
        <table id="articles">
            <thead>
                <tr>
                    <th id="id">Nom stock</th>
                    <th id="id">Nom Depot</th>
                    <th id="id">Date</th>
                    <th id="id">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stocks as $stock)
                    <form action="{{ route('stock.destroy', ['id' => $stock->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <tr>
                            <td id="id">{{$stock->nom}}</td>
                            <td id="id">{{$stock->depot->site}}</td>
                            <td id="id">{{$stock->created_at}}</td>
                            <td id="id">
                                <button value='{{$stock->id}}' class="iconAct" type="submit"><i class='bx bxs-trash'></i></button>
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
            <form id="myForm" action="{{route('stock.store')}}" method="post">
                @csrf
                <main>
                <input id="tab1" type="radio" name="tabs" checked>
                <label style="width: 100%;" for="tab1">Stock</label>

                <section id="content1">
                    <div class="form-group">
                        <span>Depot : </span>
                        <select id="depot" name="depot" class="form-select" aria-label="Default select example">
                            <option value="" selected>Depot</option>
                            @foreach ($depots as $depot)
                                <option  value="{{$depot->id}}">{{$depot->site}}</option>
                            @endforeach
                        </select>

                        <span>Nom : </span>
                        <input id="nom" name="nom" type="text" class="form-control" placeholder="Nom">
                    </div>
                    <br>
                    <div class="dataField datacmd2">
                        <table class="art" id="articles">
                            <tbody>
                                <tr id="end" class="fix">
                                    <td id="id" style="width: 119px">
                                        <select style="margin-top: -1px" id="designation" name="designation" class="form-select icmd" aria-label="Default select example" placeholder="text">
                                            <option value="" selected>Designation</option>
                                            @foreach ($articles as $article)
                                                <option value="{{$article->designation}}">{{$article->designation}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 18.9%" id="id"><span id="sub" class="iconAct"><i class='bx bx-plus-circle'></i></span></td>
                                    <input type="hidden" id="date" value="{{now()}}">
                                </tr>
                            </tbody>
                        </table>
                        <table class="art" id="articles">
                            <thead>
                                <tr>
                                    <th id="id">DESIGNATION</th>
                                    <th id="id">Quantite</th>
                                    <th id="id">Date</th>
                                </tr>
                            </thead>
                            <tbody id="show">
                                
                            </tbody>
                        </table>
                    </div>
                    <br>
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
                </form>
                </section>
            </main>
        </div>
    </div>
@endsection

@section('jsFiles')
    <script src="/js/stock.js"></script>
@endsection