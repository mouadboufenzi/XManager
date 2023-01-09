<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/back.css">
    <title>XManager - Home</title>
    <script src="https://kit.fontawesome.com/39383a79c4.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
    <body id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div> 
                    <a href="#" class="nav_logo"> 
                        <i class='bx bxs-hot nav_logo-icon'></i> <span class="nav_logo-name eEduction">XManager</span>
                    </a>
                    <div class="nav_list"> 
                        {{--active--}}
                        <a href="/" class="nav_link active"> <i class='bx bxs-home-alt-2 bx-tada bx-flip-vertical nav_icon' ></i> <span class="nav_name">Home</span> </a> 
                        <a href="/articles" class="nav_link @yield('articles')"> <i class='bx bxs-package bx-tada bx-flip-vertical nav_icon'></i> <span class="nav_name">Articles</span> </a> 
                        <a href="/clients" class="nav_link @yield('clients')"> <i class='bx bxs-face bx-tada bx-flip-vertical nav_icon' ></i><span class="nav_name">Clients</span> </a> 
                        <a href="/fournisseurs" class="nav_link @yield('fournisseurs')"> <i class='bx bx-store-alt bx-tada bx-flip-vertical nav_icon' ></i> <span class="nav_name">Fournisseurs</span> </a>
                        <a href="/commandes" class="nav_link @yield('commande')"> <i class='bx bxs-cart bx-tada bx-flip-vertical nav_icon' ></i>  <span class="nav_name">Commandes</span> </a>  
                        <a href="/receptions" class="nav_link @yield('reception')"> <i class='bx bx-notepad bx-tada nav_icon' ></i>  <span class="nav_name">Receptions</span> </a>
                        <a href="/facture" class="nav_link @yield('facture')"> <i class='bx bx-file-blank bx-tada bx-flip-horizontal nav_icon' ></i>  <span class="nav_name">Factures</span> </a>
                        <a href="/stock" class="nav_link @yield('stock')"> <i class='bx bx-layer bx-tada nav_icon' ></i>  <span class="nav_name">Stock</span> </a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav_link"> <i class='bx bx-log-out-circle nav_icon'></i>  <span class="nav_name">Deconnexion</span> </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="king">
            <div class="shape">
                <div class="navDiv">
                    <div class="navtous">
                        <div class="navtous1">
                            <span class="txt">Welcome</span>
                        </div>
                        <div style="margin-left: 25px;" class="navtous2">
                            <i class="f1 fa-solid fa-house"></i>
                            <span class="f2">|</span>
                            <p class="f3">Welcome</p>
                        </div>
                    </div>
                </div>
                <div class="p">
                    <div class="welBlocks">
                        <div class="welBlock">
                            <div class="blockIcons">
                                <div class="weliconDiv">
                                    <i class='bx bxs-package blockIcon'></i>
                                </div>
                            </div>
                            <div class="blockInfo">
                                <span style="font-size: 30px;">{{$arts}}</span> <br>
                                <span>Articles</span>
                            </div>
                        </div>

                        <div class="welBlock">
                            <div class="blockIcons">
                                <div class="weliconDiv">
                                    <i class='bx bxs-face blockIcon'></i>
                                </div>
                            </div>
                            <div class="blockInfo">
                                <span style="font-size: 30px;">{{$cls}}</span> <br>
                                <span>Clients</span>
                            </div>
                        </div>

                        <div class="welBlock">
                            <div class="blockIcons">
                                <div class="weliconDiv">
                                    <i class='bx bxs-store blockIcon'></i>
                                </div>
                            </div>
                            <div class="blockInfo">
                                <span style="font-size: 30px;">{{$frs}}</span> <br>
                                <span>Fournisseurs</span>
                            </div>
                        </div>

                        <div class="welBlock">
                            <div class="blockIcons">
                                <div class="weliconDiv">
                                    <i class='bx bxs-cart blockIcon'></i>
                                </div>
                            </div>
                            <div class="blockInfo">
                                <span style="font-size: 30px;">{{$cmds}}</span> <br>
                                <span>Commandes</span>
                            </div>
                        </div>
                    </div>

                    <div class="welBlocks">
                        <div class="welBlock">
                            <div class="blockIcons">
                                <div class="weliconDiv">
                                    <i class='bx bxs-cart blockIcon'></i>
                                </div>
                            </div>
                            <div style="padding-top: 18px;" class="blockInfo">
                                <span style="font-size: 30px;">{{$_cmds}}</span> <br>
                                <span>Commandes non réceptionnée</span>
                            </div>
                        </div>

                        <div class="welBlock">
                            <div class="blockIcons">
                                <div class="weliconDiv">
                                    <i class='bx bxs-notepad blockIcon'></i>
                                </div>
                            </div>
                            <div class="blockInfo">
                                <span style="font-size: 30px;">{{$recs}}</span> <br>
                                <span>Réceptions</span>
                            </div>
                        </div>

                        <div class="welBlock">
                            <div class="blockIcons">
                                <div class="weliconDiv">
                                    <i class='bx bxs-file-blank blockIcon'></i>
                                </div>
                            </div>
                            <div class="blockInfo">
                                <span style="font-size: 30px;">{{$facs}}</span> <br>
                                <span>Factures</span>
                            </div>
                        </div>

                        <div class="welBlock">
                            <div class="blockIcons">
                                <div class="weliconDiv">
                                    <i class='bx bxs-layer blockIcon'></i>
                                </div>
                            </div>
                            <div class="blockInfo">
                                <span style="font-size: 30px;">{{$sts}}</span> <br>
                                <span>Stocks</span>
                            </div>
                        </div>
                    </div>

                    <div class="welBlocks">
                        
                    </div>
                </div>
            </div>
        </div>
        <!--Container Main end-->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="{{asset("../../js/app.js")}}"></script>
    </body>
</html>