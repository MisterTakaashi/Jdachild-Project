<?php include "../includes/header.php"; ?>
    <div id="global">
    	<div id="infojeu">
            <div class="container">
            	<div class="row">
    			<?php
    				$jeu = GameManager::getGameInfo($_GET['id']);
    				echo "<h1>" . $jeu->Nom . "</h1>";
    			?>
    			</div>

    			<div class="row">	
	    			<div class="btn-group btn-group-justified">
					  <a href="#" class="btn btn-info">Créer un serveur</a>
					  <a href="#" class="btn btn-default">Configurer le serveur</a>
					  <a href="#" class="btn btn-default">Améliorer le serveur</a>
					  <a href="#" class="btn btn-default">Ressources</a>
					  <a href="#" class="btn btn-default">Boutique</a>
					</div>
				</div>
    		</div>
    	</div>
    </div>
<?php include "../includes/footer.php"; ?>