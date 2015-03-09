<?php
include_once "bdd.php";
include_once "lib.php";

class Cours
{
        function listAllCours($nbrresult){
            $tableaucours = Array();

            $bdd = new BDD();
            $connection = $bdd->open();

            if ($nbrresult == -1){
                $query = "SELECT c.id IDCOURS, c.nom NOMCOURS, c.description DESCRIPTIONCOURS, c.vignetteaccueil VIGNETTECOURS, c.idauteur AUTEURCOURS FROM cours c JOIN users u ON (c.idauteur = u.id)";
            }else{
                $query = "SELECT c.id IDCOURS, c.nom NOMCOURS, c.description DESCRIPTIONCOURS, c.vignetteaccueil VIGNETTECOURS, c.idauteur AUTEURCOURS FROM cours c JOIN users u ON (c.idauteur = u.id) LIMIT 0, $nbrresult";
            }

            $selectAllCours = $connection->query($query);
            $selectAllCours->setFetchMode(PDO::FETCH_OBJ);
            while ($selectAllCoursFetch = $selectAllCours->fetch()){
                array_push($tableaucours, Array("id" => $selectAllCoursFetch->IDCOURS, "nom" => $selectAllCoursFetch->NOMCOURS, "description" => $selectAllCoursFetch->DESCRIPTIONCOURS, "vignette" => $selectAllCoursFetch->VIGNETTECOURS, "idauteur" => $selectAllCoursFetch->AUTEURCOURS));
            }

            //var_dump($tableaucours);
            return $tableaucours;
        }

        function addCours($name, $desc, $vignetteaccueil){
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
        }
}
?>
