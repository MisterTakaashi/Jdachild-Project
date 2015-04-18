<?php
    include_once "../includes/session.php";
    $session = new Session();
    include_once "../includes/game.php";
    include_once "../includes/forum.php";
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>OEGAS Communauté</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-markdown.min.css">
    <link rel="stylesheet" href="/css/lumen.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap-markdown.js"></script>
</head>
<body>
    <?php $testcookie = (isset($_COOKIE["cookies"])) ? "none" : "block" ?>
    <div id="supheader" style="display: <?php echo $testcookie; ?>;">Afin d'optimiser votre navigation sur notre site, nous utilisons des cookies &nbsp;<a href="#" class="btn btn-info">Accepter</a></div>
    <script>
    $("#supheader a").click(function(){
        document.cookie="cookies=true";
        $("#supheader").hide(1000);
    });
    </script>
    <header>
        <div class="container">
            <a href="/accueil/"><div id="logo"></div></a><div id="splash">C'est plus fort que toi !</div>
            <nav class="navbar" role="navigation">
                <ul>
                    <a href="/accueil/"><li class= <?php echo $active = ( $_SERVER['REQUEST_URI'] == "/accueil/" || $_SERVER['REQUEST_URI'] == "/accueil/index.php") ? "active" : ""; ?> >Accueil</li></a>
                    <li>Truc</li>
                    <li class="separator"></li>
                    <li><input class="form-control" id="focusedInput" type="text" placeholder="Rechercher un jeu"></li>
                    <li class="separator"></li>
                    <?php
                    if ($session->check()){
                    ?>
                    <a href="/user/"><li><?php echo $_SESSION['username']; ?></li></a>
                    <a href="/logout/"><li class= <?php echo $active = ( $_SERVER['REQUEST_URI'] == "/logout/" || $_SERVER['REQUEST_URI'] == "/logout/index.php") ? "active" : ""; ?> >Déconnexion</li></a>
                    <?php
                    }else{
                    ?>
                        <a href="/connexion/"><li class= <?php echo $active = ( $_SERVER['REQUEST_URI'] == "/connexion/" || $_SERVER['REQUEST_URI'] == "/connexion/index.php") ? "active" : ""; ?> >Connexion</li></a>
                        <a href="/inscription/"><li class= <?php echo $active = ( $_SERVER['REQUEST_URI'] == "/inscription/" || $_SERVER['REQUEST_URI'] == "/inscription/index.php") ? "active" : ""; ?> >Inscription</li></a>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>
