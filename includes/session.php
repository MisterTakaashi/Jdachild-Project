<?php
include_once "bdd.php";
include_once "lib.php";

class Session{
    function __construct(){
        session_start();
    }

    function open($pseudo, $password){
        $bdd = new BDD();
        $connection = $bdd->open();

        $pseudo = $connection->quote($pseudo);
        $password = $connection->quote(sha1($password));

        $selectId = $connection->query("SELECT * FROM users WHERE pseudo = {$pseudo} AND password = {$password}");
        $selectId->setFetchMode(PDO::FETCH_OBJ);
        $selectIdFetch = $selectId->fetch();

        if(isset($selectIdFetch->pseudo, $selectIdFetch->rank, $selectIdFetch->email, $selectIdFetch->promotion))
        {
            $_SESSION['username']    = $selectIdFetch->pseudo;
            $_SESSION['rank']        = $selectIdFetch->rank;
            $_SESSION['email']       = $selectIdFetch->email;
            $_SESSION['promotion']   = $selectIdFetch->promotion;
            $_SESSION['id']          = $selectIdFetch->id;
            return true;
        }
        return false;
    }

    function check(){
        if (!isset($_SESSION['username'])){
            return false;
        }
        return true;
    }

    function logout(){
        session_destroy();
    }

    function newPass($email){
        $bdd = new BDD();
        $connection = $bdd->open();

        $emailquote = $connection->quote($email);
        $pass = $connection->quote(genererMDP(12));

        $connection->query("UPDATE users SET token = {$pass} WHERE email = {$emailquote}");

        mail("soapmctravich@gmail.com", "Réinitilisation du Mot de Passe", "Je réinitialise ton mot de passe bitch !");
    }

    function newPassWithToken($email, $token, $password){
        $bdd = new BDD();
        $connection = $bdd->open();

        $emailquote = $connection->quote($email);
        $token = $connection->quote($token);
        $password = $connection->quote(sha1($password));

        $selecttoken = $connection->query("SELECT * FROM users WHERE token = {$token} AND email = {$emailquote}");
        $selecttoken->setFetchMode(PDO::FETCH_OBJ);
        $selecttoken = $selecttoken->fetch();

        if(isset($selecttoken->pseudo)){
            $connection->query("UPDATE users SET token = NULL, password = {$password} WHERE email = {$emailquote} AND token = {$token}");
        }
    }

    function createUser($pseudo, $email, $password, $promotion){
        $bdd = new BDD();
        $connection = $bdd->open();

        $pseudo = $connection->quote($pseudo);
        $emailquote = $connection->quote($email);
        $password = $connection->quote(sha1($password));
        $promotion = $connection->quote($promotion);

        $selecttoken = $connection->query("SELECT * FROM users WHERE pseudo = {$pseudo}");
        $selecttoken->setFetchMode(PDO::FETCH_OBJ);
        $selecttoken = $selecttoken->fetch();

        if(isset($selecttoken->pseudo)){
            return 1;
        }

        $selecttoken = $connection->query("SELECT * FROM users WHERE email = {$emailquote}");
        $selecttoken->setFetchMode(PDO::FETCH_OBJ);
        $selecttoken = $selecttoken->fetch();

        if(isset($selecttoken->pseudo)){
            return 2;
        }

        $connection->query("INSERT INTO users (pseudo, password, email, promotion, rank) VALUES({$pseudo}, {$password}, {$emailquote}, {$promotion}, 0)");

        return 0;
    }
}
?>
