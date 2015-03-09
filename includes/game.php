<?php
include_once "bdd.php";
include_once "lib.php";

class Game
{
    function listAllGames($nbrresult){
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