<?php
    include_once "../includes/session.php";
    include_once "../includes/cours.php";
    $session = new Session();
    $cours = new Cours();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>OEGAS Communauté</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="supheader">Afin d'optimiser votre navigation sur notre site, nous utilisons des cookies &nbsp;<button type="button" class="btn btn-info" style="height: 25px;padding-top: 1px;margin-top: -3px;">Accepter</button></div>
    <header>
        <div class="container">
            <a href="/accueil/"><div id="logo"></div></a><div id="splash">C'est plus fort que toi !</div>
            <nav class="navbar" role="navigation">
                <ul>
                    <a href="/accueil/"><li class= <?php echo $active = ( $_SERVER['REQUEST_URI'] == "/accueil/" || $_SERVER['REQUEST_URI'] == "/accueil/index.php") ? "active" : ""; ?> >Accueil</li></a>
                    <li>Truc</li>
                    <li>Machin</li>
                    <li>Pognon</li>
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
