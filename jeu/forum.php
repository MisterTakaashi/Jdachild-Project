<?php include "../includes/header.php"; ?>

<div id="global">
    <div id="infojeu">
        <div class="container">
            <div class="row">
                <?php
                $jeu = GameManager::getGameInfo($_GET['id']);
                echo "<h1>" . $jeu->Nom . "</h1>";

                $categories = ForumManager::listAllCategories($_GET['id']);
                //var_dump($categories)
                ?>
            </div>

            <div class="row">
                <div class="btn-group btn-group-justified">
                    <a href="/game/<?=$_GET['id']?>/create/" class="btn btn-default">Créer un serveur</a>
                    <a href="#" class="btn btn-default disabled">Configurer le serveur (DEV)</a>
                    <a href="#" class="btn btn-default disabled">Ressources (DEV)</a>
                    <a href="/game/<?=$_GET['id']?>/forum/" class="btn btn-info">Forum</a>
                </div>
            </div>

            <br>

            <?php
            foreach ($categories as $key => $categorie){
                echo "<h3>".$categorie['nom']."</h3>";
            }
            ?>
            </div>
        </div>
    </div>

    <?php include "../includes/footer.php"; ?>
