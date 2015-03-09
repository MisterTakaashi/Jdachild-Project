<?php
include_once "bdd.php";
include_once "lib.php";

class Game
{
    public $ID;
    public $Nom;
    public $App_id;
    public $Image;
    
    function __construct($id, $nom, $app_id, $image)
    {
        $this->ID = $id;
        $this->Nom = $nom;
        $this->App_id = $app_id;
        $this->Image = $image;
    }
}

class GameManager
{
    public static function listAllGames($nbrresult){
        $tableaugames = Array();

        $bdd = new BDD();
        $connection = $bdd->open();

        if ($nbrresult == -1){
            $query = "SELECT * FROM games";
        }else{
            $query = "SELECT * FROM games LIMIT 0, $nbrresult";
        }

        $selectAllCours = $connection->query($query);
        $selectAllCours->setFetchMode(PDO::FETCH_OBJ);
        while ($selectAllCoursFetch = $selectAllCours->fetch()){
            array_push($tableaugames, Array("id" => $selectAllCoursFetch->id, "nom" => $selectAllCoursFetch->nom, "app_id" => $selectAllCoursFetch->app_id, "image" => $selectAllCoursFetch->image));
        }

        //var_dump($tableaugames);
        return $tableaugames;
    }

    public static function getGameInfo($id){
        $tableaugame = Array();

        $bdd = new BDD();
        $connection = $bdd->open();

        $id = $connection->quote($id);

        $query = "SELECT * FROM games WHERE app_id = {$id}";

        $selectInfo = $connection->query($query);
        $selectInfo->setFetchMode(PDO::FETCH_OBJ);
        $selectInfoFetch = $selectInfo->fetch();

        $jeu = new Game($selectInfoFetch->id, $selectInfoFetch->nom, $selectInfoFetch->app_id, $selectInfoFetch->image);
        
        return $jeu;
    }

        /*function addCours($name, $desc, $vignetteaccueil){
            $bdd = new BDD();
            $connection = $bdd->open();

            $namequote = $connection->quote($name);
            $desc = $connection->quote($desc);
            $vignetteaccueil = $connection->quote($vignetteaccueil);

            $idauteur = $_SESSION['id'];

            $nameregex = strtolower(preg_replace('/([\W])/', '-', $name));

            $selectAllCours = $connection->query("SELECT * FROM cours WHERE nom = {$namequote}");
            $selectAllCours->setFetchMode(PDO::FETCH_OBJ);
            $selectAllCoursFetch = $selectAllCours->fetch();
            if(!isset($selectAllCoursFetch->nom)){
                $connection->query("INSERT INTO cours (nom, description, vignetteaccueil, idauteur) VALUES({$namequote}, {$desc}, {$vignetteaccueil}, {$idauteur})");
                mkdir("../cours/{$nameregex}");
                touch("../cours/{$nameregex}/menu.json");
            }
        }*/
}
?>