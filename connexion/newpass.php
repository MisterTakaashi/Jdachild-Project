<?php include "../includes/header.php";
if(isset($_GET['new'])){
    $email = $_GET['new'];
}else{
    $email = "";
}

if(isset($_POST['email'])){
    $session->newPass($_POST['email']);
    echo '<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    Nous venons de vous envoyer un mail contenant les instructions pour réinitialiser votre mot de passe. Pensez à vérifier vos spams !
    </div>';
}

if(isset($_GET['new'], $_GET['token'])){
    if(isset($_POST['password1'], $_POST['password2'])){
        if($_POST['password1'] != $_POST['password2']){
            echo '<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Les deux mots de passes ne concordents pas.
            </div>';
        }else{
            $session->newPassWithToken($_GET['new'], $_GET['token'], $_POST['password1']);
            echo '<div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Votre mot de passe a bien été changé ! Vous pouvez dès maintenant <a href="/connexion/">vous connecter</a> !
            </div>';
        }
    }
}
?>
<div id="global">
    <div id="connexion">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6"><h3 class="title">Réinitialiser son mot de passe</h3></div>
                <div class="col-xs-12 col-md-1"><div class="spacer"></div></div>
                <div class="col-xs-12 col-md-5"><h3 class="title">Infos importante</h3></div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="box box-signin">
                        <div class="box-content dark">
                            <?php
                            if(!isset($_GET['new'], $_GET['token'])){
                            ?>
                            <form accept-charset="UTF-8" action="#" class="simple_form new_user" id="new_password" method="post" novalidate="novalidate">
                                <div class="form-group string required user_email">
                                    <input autofocus="autofocus" class="string required form-control" id="user_email" name="email" placeholder="Adresse email" type="text">
                                </div>
                                <input class="btn btn-primary btn-block" name="commit" type="submit" value="Envoyez le mail de réinitialisation" id="connexionbutton">
                            </form>
                            <?php
                            }else{
                            ?>
                            <form accept-charset="UTF-8" <?php echo 'action="/connexion/password/new/'.$_GET['new'].'/'.$_GET['token'].'/"'; ?> class="simple_form new_user" id="new_password" method="post" novalidate="novalidate">
                                <div class="form-group string required user_password lostpast">
                                    <input autofocus="autofocus" class="string required form-control" id="password1" name="password1" placeholder="Nouveau mot de passe" type="password" data-toggle="tooltip" data-trigger="" data-placement="right" data-animation="false" title="Le mot de passe doit faire au moins 6 caractères">
                                </div>
                                <div class="form-group password required user_password lostpast">
                                    <input class="string required form-control" id="password2" name="password2" placeholder="Retapez le mot de passe" type="password" data-toggle="tooltip" data-trigger="" data-placement="right" data-animation="false" title="Les deux mots de passe doivent correspondre">
                                </div>
                                <input class="btn btn-primary btn-block" name="commit" type="submit" value="Valider le mot de passe" id="connexionbutton">
                            </form>
                            <?php
                            }
                            ?>
                            </div>

                            <script type="text/javascript">
                            $("#password1").ready(function(){
                                checkInput();
                            });

                            $("#password1").keyup(function(event){
                                if(event.keyCode == 13){
                                    $("#new_user").submit();
                                }

                                checkInput();
                                checkTootip();
                            });

                            $("#password2").keyup(function(event){
                                if(event.keyCode == 13){
                                    $("#new_user").submit();
                                }

                                checkInput();
                                checkTootip();
                            });

                            $("#password1").change(function(){
                                checkInput();
                                checkTootip();
                            });

                            $("#password2").change(function(){
                                checkInput();
                                checkTootip();
                            });

                            $("#password1").focusout(function(){
                                checkInput();
                                checkTootip();
                            });

                            $("#password2").focusout(function(){
                                checkInput();
                                checkTootip();
                            });

                            function checkInput(){
                                if($("#password1").val() == $("#password2").val()){
                                    $("#connexionbutton").removeAttr('disabled');
                                }else{
                                    $("#connexionbutton").attr("disabled", "disabled");
                                }
                            }

                            function checkTootip(){
                                if($("#password1").val() != $("#password2").val()){
                                    if($("#password1").val().length < 6){
                                        $('#password1').tooltip('show');
                                    }else{
                                        $('#password1').tooltip('hide');
                                    }
                                    $('#password2').tooltip('show');
                                }else{
                                    $('#password2').tooltip('hide');
                                }
                            }
                            </script>

                        </div>
                    </div>
                    <div class="col-xs-12 col-md-1">
                        <div class="spacer"></div>
                    </div>
                    <div class="col-xs-12 col-md-5 spec">
                        <p>
                            OEGAS est actuellement en phase de développement, nous travaillons encore à son expansion.
                        </p>
                        <p>
                            Merci de prendre part à son test ! N'oubliez pas de faire remonter tout bug que vous trouverez dans nos forums.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>
