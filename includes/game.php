<?php
include_once "bdd.php";
include_once "lib.php";

class Game
{
    public $ID;
    public $Nom;
    public $App_id;
    public $Image;
    public $Prerequis;

    function __construct($id, $nom, $app_id, $image, $prerequis)
    {
        $this->ID = $id;
        $this->Nom = $nom;
        $this->App_id = $app_id;
        $this->Image = $image;
        $this->Prerequis = $prerequis;
    }
}

class GamePrerequis
{
    public $ID;
    public $Game_id;
    public $Type;
    public $Contenu;
    public $Recommandation;

    function __construct($id, $game_id, $type, $contenu, $recommandation)
    {
        $this->ID = $id;
        $this->Game_id = $game_id;
        $this->Type = $type;
        $this->Contenu = $contenu;
        $this->Recommandation = $recommandation;
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

    public static function getGameInfo($app_id){
        $tableaugame = Array();

        $bdd = new BDD();
        $connection = $bdd->open();

        $id = $connection->quote($app_id);

        $query = "SELECT * FROM games WHERE app_id = {$app_id}";

        $selectInfo = $connection->query($query);
        $selectInfo->setFetchMode(PDO::FETCH_OBJ);
        $selectInfoFetch = $selectInfo->fetch();

        $prerequis = GameManager::getGamePrerequis($selectInfoFetch->id, NULL);

        $jeu = new Game($selectInfoFetch->id, $selectInfoFetch->nom, $selectInfoFetch->app_id, $selectInfoFetch->image, $prerequis);

        //var_dump($jeu);

        return $jeu;
    }

    private static function getGamePrerequis($id, $type){
        $tableauPrerequis = Array();

        $bdd = new BDD();
        $connection = $bdd->open();

        $id = $connection->quote($id);

        if ($type != NULL){
            $type = $connection->quote($type);
            $query = "SELECT * FROM games_prerequis WHERE game_id = {$id} AND type = {$type}";
        }
        else{
            $query = "SELECT * FROM games_prerequis WHERE game_id = {$id}";
        }

        $selectInfo = $connection->query($query);
        $selectInfo->setFetchMode(PDO::FETCH_OBJ);
        while ($selectInfoFetch = $selectInfo->fetch()){
            $prerequis = new GamePrerequis($selectInfoFetch->id, $selectInfoFetch->game_id, $selectInfoFetch->type, $selectInfoFetch->contenu, $selectInfoFetch->recommandation);
            array_push($tableauPrerequis, $prerequis);
        }

        return $tableauPrerequis;
    }

    public static function getGameInstallation($id, $os){
        $bdd = new BDD();
        $connection = $bdd->open();

        $id = $connection->quote($id);
        $os = $connection->quote($os);

        $query = "SELECT * FROM games_installation WHERE game_id = {$id} AND os = {$os}";

        $selectInfo = $connection->query($query);
        $selectInfo->setFetchMode(PDO::FETCH_OBJ);
        return $selectInfo->fetch();
    }

    public static function updateGameInstallation($id, $os, $installation){
        $bdd = new BDD();
        $connection = $bdd->open();

        $id           = $connection->quote($id);
        $os           = $connection->quote($os);
        if ($installation != '')
            $installation = $connection->quote($installation);

        $query = "SELECT count(*) NBRRESULT FROM games_installation WHERE game_id = {$id} AND os = {$os}";

        $selectInfo = $connection->query($query);
        $selectInfo->setFetchMode(PDO::FETCH_OBJ);
        $selectInfoFetch = $selectInfo->fetch();

        //echo "Nombre de resultats pour {$os}: {$selectInfoFetch->NBRRESULT}<br>";

        if ($selectInfoFetch->NBRRESULT != "0" && $installation != ''){
            $query = "UPDATE games_installation SET contenu = {$installation} WHERE game_id = {$id} AND os = {$os}";
        }else if($selectInfoFetch->NBRRESULT != "0" && $installation == ''){
            $query = "DELETE FROM games_installation WHERE game_id = {$id} AND os = {$os}";
        }else if($selectInfoFetch->NBRRESULT == "0" && $installation != ''){
            $query = "INSERT INTO games_installation (game_id, os, contenu, os_choosen) VALUES ({$id}, {$os}, {$installation}, 'OS Non connu')";
        }

        $connection->query($query);
    }

    public static function getInstallOSList($id){
        $listOs = Array();

        $bdd = new BDD();
        $connection = $bdd->open();

        $id = $connection->quote($id);

        $query = "SELECT os FROM games_installation WHERE game_id = {$id}";

        $selectInfo = $connection->query($query);
        $selectInfo->setFetchMode(PDO::FETCH_OBJ);
        while($selectInfoFetch = $selectInfo->fetch()){
            array_push($listOs, $selectInfoFetch->os);
        }

        return $listOs;
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
