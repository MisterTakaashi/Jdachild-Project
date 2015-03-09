<?php include "../includes/header.php"; ?>
<?php
    if(isset($_POST['username'], $_POST['password'])){
        if(($session->open($_POST['username'], $_POST['password']))){
            header('Location: /accueil/');
        }else{
            echo '<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Nom d\'utilisateur ou mot de passe non pris en charge.
            </div>';
        }
    }
?>
<div id="global">
    <div id="connexion">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6"><h3 class="title">Connexion</h3></div>
                <div class="col-xs-12 col-md-1"><div class="spacer"></div></div>
                <div class="col-xs-12 col-md-5"><h3 class="title">Infos importante</h3></div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="box box-signin">
                        <div class="box-content dark">
                            <form accept-charset="UTF-8" action="#" class="simple_form new_user" id="new_user" method="post" novalidate="novalidate">
                                <div class="form-group string required user_login"><input autofocus="autofocus" class="string required form-control" id="user_login" name="username" placeholder="Nom d'utilisateur" type="text"></div><div class="form-group password required user_password"><input class="password required form-control" id="user_password" name="password" placeholder="Mot de passe" type="password"></div><input class="btn btn-primary btn-block" name="commit" type="submit" value="Se connecter" id="connexionbutton">
                                <p class="small">
                                    <br>
                                    <a href="/connexion/password/new/">Mot de passe oublié ?</a>
                                </p></form>

                                <script type="text/javascript">
                                    /*$("#user_login").ready(function(){
                                        checkInput();
                                    });

                                    $("#user_login").keyup(function(event){
                                        if(event.keyCode == 13){
                                            $("#new_user").submit();
                                        }

                                        checkInput();
                                        checkTootip1();
                                    });

                                    $("#user_password").keyup(function(event){
                                        if(event.keyCode == 13){
                                            $("#new_user").submit();
                                        }

                                        checkInput();
                                        checkTootip2();
                                    });

                                    $("#user_login").change(function(){
                                        checkInput();
                                        checkTootip1();
                                    });

                                    $("#user_password").change(function(){
                                        checkInput();
                                        checkTootip2();
                                    });

                                    $("#user_login").focusout(function(){
                                        checkInput();
                                        checkTootip1();
                                    });

                                    $("#user_password").focusout(function(){
                                        checkInput();
                                        checkTootip2();
                                    });

                                    function checkInput(){
                                        if($("#user_login").val().length >= 6){

                                            if($("#user_password").val().length >= 6){
                                                $("#connexionbutton").removeAttr('disabled');
                                            }

                                        }else{
                                            $("#connexionbutton").attr("disabled", "disabled");
                                        }
                                    }

                                    function checkTootip1(){
                                        if($("#user_login").val().length < 6){
                                            $('#user_login').tooltip('show');
                                        }else{
                                            $('#user_login').tooltip('hide');
                                        }
                                    }

                                    function checkTootip2(){
                                        if($("#user_password").val().length < 6){
                                            $('#user_password').tooltip('show');
                                        }else{
                                            $('#user_password').tooltip('hide');
                                        }
                                    }*/
                                </script>

                            </div>
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
