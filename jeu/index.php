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

				<h3>Prérequis</h3>
				<div class="list-group">
				  <a href="#" class="list-group-item">
				    <h4 class="list-group-item-heading">Système d'exploitation</h4>
				    <?php
				    	foreach ($jeu->Prerequis as $prerequis) {
				    		if ($prerequis->Type == "OS")
				    			echo "<p class=\"list-group-item-text\"><kbd>".$prerequis->Contenu."</kbd> Recommandé: ".$prerequis->Recommandation."</p>";
				    	}
				    ?>
				  </a>
				  <a href="#" class="list-group-item">
				    <h4 class="list-group-item-heading">Logiciel(s)</h4>
				    <p class="list-group-item-text">
				    	<ul>
				    		<?php
						    	foreach ($jeu->Prerequis as $prerequis) {
						    		if ($prerequis->Type == "Logiciel")
						    			echo "<li>".$prerequis->Contenu."</li>";
						    	}
						    ?>
				    	</ul>
				    </p>
				  </a>
				</div>

				<h3>Installation</h3>

				<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseWindows" aria-expanded="false" aria-controls="collapseWindows">
				  Windows
				</button>
				<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseLinux" aria-expanded="false" aria-controls="collapseLinux">
				  Linux
				</button>
				<button class="btn btn-primary disabled" type="button" data-toggle="collapse" data-target="#collapseMac" aria-expanded="false" aria-controls="collapseMac">
				  Mac OS
				</button>
				<div class="collapse" id="collapseWindows">
				  <div class="well">
				    <h3>Installation sous Windows</h3>

				    <div class="alert alert-warning">
					  <h4>Attention!</h4>
					  Installation réalisée sous <strong>Server 2012 R2</strong>. Certains éléments peuvent varier d'une version à une autre de cet OS.
					</div>
				  </div>
				</div>
				<div class="collapse" id="collapseLinux">
				  <div class="well">
				    <h3>Installation sous Linux</h3>
				  </div>
				</div>
				<div class="collapse" id="collapseMac">
				  <div class="well">
				    OS X
				  </div>
				</div>

				<script type="text/javascript">
				$('#collapseWindows').on('show.bs.collapse', function () {
					$('#collapseLinux').removeClass("in");
					$('#collapseMac').removeClass("in");
				})

				$('#collapseLinux').on('show.bs.collapse', function () {
					$('#collapseWindows').removeClass("in");
					$('#collapseMac').removeClass("in");
				})

				$('#collapseMac').on('show.bs.collapse', function () {
					$('#collapseWindows').removeClass("in");
					$('#collapseLinux').removeClass("in");
				})
				</script>
    		</div>
    	</div>
    </div>
<?php include "../includes/footer.php"; ?>