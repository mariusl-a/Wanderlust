<?php
    $user = Auth::user();
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Wanderlust - @yield('title')</title>
        
        <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    </head>
    <body>
        <div class="container">
            @section('sidebar')
            <div id="divHeader" class="row">
                <div class="col-md-2 hidden-xs hidden-sm">
                    <img src="images/fix1-wander.png" height="200" />
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8">
                    <div class="row" style="height:75px;padding-top:50px;padding-left:20px;">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <small style="vertical-align: bottom;font-size:12px;font-weight: bold">- A strong desire or urge to wander or travel and explore the world</small>
                            <img class="imgSempro" src="images/sempro-logo.png" />
                        </div>
                    </div>
                    <div class="row">
                        <ul id="ulMenu" style="padding-top: 90px;">
                            <li><a href="home">Home</a></li>
                            <?php
                            if(!$user)
                            {
                                echo "<li><a href=\"login\">Login</a></li>";
                            }
                            ?>
                            <li><a href="about">About</a></li>
                            <?php
                            if ($user)
                            {
                                echo "<li><a href=\"profile\">My Profile</a></li>";
                                if($user->admin)
                                {
                                    echo "<li><a href=\"admin\">Admin</a></li>";
                                }
                                echo "<li style=\"font-size:10px;\"><a href=\"auth/logout\">Log Out</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            @show
    
            <div id="divContent" class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
            
            @section('footer')
            <div id="divFooter" class="row">
                A project for <a href="http://sempro.no">Sempro</a><br />Marius Larsen-Asp &copy; 2015 
            </div>
            @show
        </div>
    </body>
</html>