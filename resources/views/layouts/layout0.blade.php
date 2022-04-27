<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset("../../css/app.css")}}">
    <script src="https://kit.fontawesome.com/39383a79c4.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    @yield('title/addFile')
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
                        <a href="/" class="nav_link"> <i class='bx bxs-home-alt-2 bx-tada bx-flip-vertical nav_icon' ></i> <span class="nav_name">Home</span> </a> 
                        <a href="/articles" class="nav_link @yield('articles')"> <i class='bx bxs-package bx-tada bx-flip-vertical nav_icon'></i> <span class="nav_name">Articles</span> </a> 
                        <a href="/clients" class="nav_link @yield('clients')"> <i class='bx bxs-face bx-tada bx-flip-vertical nav_icon' ></i><span class="nav_name">Clients</span> </a> 
                        <a href="/fournisseurs" class="nav_link @yield('fournisseurs')"> <i class='bx bx-store-alt bx-tada bx-flip-vertical nav_icon' ></i> <span class="nav_name">Fournisseurs</span> </a>
                        <a href="/commandes" class="nav_link @yield('commande')"> <i class='bx bxs-cart bx-tada bx-flip-vertical nav_icon' ></i>  <span class="nav_name">Commandes</span> </a>  
                    </div>
                </div>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="king">
            <div class="shape">
                <div class="navDiv">
                    @yield('nav')
                </div>
                <div class="prince">
                    <div class="part1">
                        @yield('table')
                    </div>
    
                    <div class="part2">
                        @yield('tabs')
                    </div>
                </div>
            </div>
        </div>
        <!--Container Main end-->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="{{asset("../../js/app.js")}}"></script>
        @yield('jsFiles')
    </body>
</html>