<?php
include "../includes/header.php";
require_once '../includes/markdown.php';
$Parsedown = new Parsedown();
?>
    <div id="global">
    	<div id="infojeu">
            <div class="container">
            	<div class="row">
    			<?php
    				$jeu = GameManager::getGameInfo($_GET['id']);
    				echo "<h1>" . $jeu->Nom . "</h1>";

    				if (isset($_POST['installationWindows']) && $_SESSION['rank'] == 9){
    					//var_dump($_POST['installationWindows']);
						GameManager::updateGameInstallation($jeu->ID, "Windows", $_POST['installationWindows']);
					}

                    if (isset($_POST['installationLinux']) && $_SESSION['rank'] == 9){
    					//var_dump($_POST['installationWindows']);
						GameManager::updateGameInstallation($jeu->ID, "Linux", $_POST['installationLinux']);
					}

                    if (isset($_POST['installationMac']) && $_SESSION['rank'] == 9){
    					//var_dump($_POST['installationWindows']);
						GameManager::updateGameInstallation($jeu->ID, "Mac", $_POST['installationMac']);
					}

                    $listOS = GameManager::getInstallOSList($jeu->ID);
                    $isInstallWindows = false;
                    $isInstallLinux   = false;
                    $isInstallMac     = false;
                    foreach ($listOS as $os) {
                        switch ($os) {
                            case 'Windows':
                                $isInstallWindows = true;
                                break;

                            case 'Linux':
                                $isInstallLinux = true;
                                break;

                            case 'Mac':
                                $isInstallMac = true;
                                break;
                        }
                    }

                    //echo "Windows {$isInstallWindows}, Linux {$isInstallLinux}, Mac {$isInstallMac}"; // DEBUG
    			?>
    			</div>

    			<div class="row">
	    			<div class="btn-group btn-group-justified">
					  <a href="#" class="btn btn-info">Créer un serveur</a>
					  <a href="#" class="btn btn-default">Configurer le serveur</a>
					  <a href="#" class="btn btn-default">Ressources</a>
					  <a href="#" class="btn btn-default">Forum</a>
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

    			<button class="btn btn-primary btn-os <?php echo ($isInstallWindows) ? "" : "disabled" ?>" type="button" data-toggle="collapse" data-target="#collapseWindows" aria-expanded="false" aria-controls="collapseWindows">
    			  Windows
    			</button>
    			<button class="btn btn-primary btn-os <?php echo ($isInstallLinux) ? "" : "disabled" ?>" type="button" data-toggle="collapse" data-target="#collapseLinux" aria-expanded="false" aria-controls="collapseLinux">
    			  Linux
    			</button>
    			<button class="btn btn-primary btn-os <?php echo ($isInstallMac) ? "" : "disabled" ?>" type="button" data-toggle="collapse" data-target="#collapseMac" aria-expanded="false" aria-controls="collapseMac">
    			  Mac OS
    			</button>

				<?php $disbledButton = (isset($_SESSION['rank']) && $_SESSION['rank'] == 9) ? "" : "disabled"; ?>
				<button id="boutonModif" class="btn btn-success <?php echo $disbledButton; ?>" type="button" style="float: right;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Module en cours de développement">Proposer une modification (En cours de dev)</button>
				<button id="boutonModifValid" class="btn btn-success" style="float: right; display: none;">Valider les modifications</button>

                <script>
                    $("#boutonModifValid").click(function(){
                        $('#formInstallation').submit();
                    });
                </script>

                <form id="formInstallation" method="POST" action="#">
    				<div class="collapse in" id="collapseWindows">
    				  <div class="well">

    					<?php
                        $aparser = "";
                        if ($isInstallWindows){
                            $installationWindows = GameManager::getGameInstallation($jeu->ID, "Windows");
    					?>

    				    <div class="alert alert-warning">
    						<h4>Attention!</h4>
    					  	Installation réalisée sous <strong><?php echo $installationWindows->os_choosen;?></strong>. Certains éléments peuvent varier d'une version à une autre de cet OS.
    					</div>

    					<?php
    						$aparser = $installationWindows->contenu;
                        }
    					?>

    					<div id="markdownWindowsInstallation"><?php echo $Parsedown->text($aparser); ?></div>
    					<div id="markdownWindowsInstallationTextarea" style="display: none;"><textarea name="installationWindows" data-provide="markdown" data-hidden-buttons="cmdPreview"><?php echo $aparser;?></textarea></div>

    				  </div>
    				</div>
    				<div class="collapse" id="collapseLinux">
    				  <div class="well">

    					<?php
                        $aparser = "";
                        if ($isInstallLinux){
    						$installationLinux = GameManager::getGameInstallation($jeu->ID, "Linux");
    					?>

                        <div class="alert alert-warning">
    						<h4>Attention!</h4>
    					  	Installation réalisée sous <strong><?php echo $installationLinux->os_choosen;?></strong>. Certains éléments peuvent varier d'une version à une autre de cet OS.
    					</div>

                        <?php
    						$aparser = $installationLinux->contenu;
                        }
    					?>

                        <div id="markdownLinuxInstallation"><?php echo $Parsedown->text($aparser); ?></div>
    					<div id="markdownLinuxInstallationTextarea" style="display: none;"><textarea name="installationLinux" data-provide="markdown" data-hidden-buttons="cmdPreview"><?php echo $aparser;?></textarea></div>

    				  </div>
    				</div>
    				<div class="collapse" id="collapseMac">
    				  <div class="well">

                        <?php
                        $aparser = "";
                        if ($isInstallMac){
      					    $installationMac = GameManager::getGameInstallation($jeu->ID, "Mac");
      					?>

                        <div class="alert alert-warning">
        					<h4>Attention!</h4>
        				  	Installation réalisée sous <strong><?php echo $installationMac->os_choosen;?></strong>. Certains éléments peuvent varier d'une version à une autre de cet OS.
        				</div>

                        <?php
    						$aparser = $installationMac->contenu;
                        }
    					?>

                        <div id="markdownMacInstallation"><?php echo $Parsedown->text($aparser); ?></div>
    					<div id="markdownMacInstallationTextarea" style="display: none;"><textarea name="installationMac" data-provide="markdown" data-hidden-buttons="cmdPreview"><?php echo $aparser;?></textarea></div>
    				  </div>
    				</div>
                </form>

				<script type="text/javascript">
    				$('#collapseWindows').on('show.bs.collapse', function () {
    					$('#collapseLinux').removeClass("in");
    					$('#collapseMac').removeClass("in");
    				});

    				$('#collapseLinux').on('show.bs.collapse', function () {
    					$('#collapseWindows').removeClass("in");
    					$('#collapseMac').removeClass("in");
    				});

    				$('#collapseMac').on('show.bs.collapse', function () {
    					$('#collapseWindows').removeClass("in");
    					$('#collapseLinux').removeClass("in");
    				});
				</script>

                <script type="text/javascript">
                    $("#boutonModif").click(function(){
                        $("#markdownWindowsInstallation").hide();
                        $("#markdownWindowsInstallationTextarea").show();

                        $("#markdownLinuxInstallation").hide();
                        $("#markdownLinuxInstallationTextarea").show();

                        $("#markdownMacInstallation").hide();
                        $("#markdownMacInstallationTextarea").show();

                        $("#boutonModif").hide();
                        $("#boutonModifValid").show();

                        $(".btn-os").removeClass("disabled");
                    });
                </script>
    		</div>
    	</div>
    </div>
<?php include "../includes/footer.php"; ?>
