<?php
include_once "bdd.php";
include_once "lib.php";

class ForumManager
{
    public static function listAllCategories($app_id){
        $tableauCategories = Array();

        $bdd = new BDD();
        $connection = $bdd->open();

        $app_id_quote = $connection->quote($app_id);

        $query = "SELECT * FROM forums_categories WHERE game_id = '*' OR game_id = {$app_id_quote}";

        $selectAllCours = $connection->query($query);
        $selectAllCours->setFetchMode(PDO::FETCH_OBJ);
        while ($selectAllCoursFetch = $selectAllCours->fetch()){
            array_push($tableauCategories, Array("id" => $selectAllCoursFetch->id, "nom" => $selectAllCoursFetch->nom, "game_id" => $selectAllCoursFetch->game_id, "description" => $selectAllCoursFetch->description));
        }

        //var_dump($tableauCategories);
        return $tableauCategories;
    }
}

?>
