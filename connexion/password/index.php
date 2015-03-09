<?php include "../../includes/header.php"; ?>
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
                                <div class="form-group string required user_login"><input autofocus="autofocus" class="string required form-control" id="user_login" name="username" placeholder="Nom d'utilisateur" type="text" data-toggle="tooltip" data-placement="right" title="Au moins 6 caractères"></div><div class="form-group password required user_password"><input class="password required form-control" id="user_password" name="password" placeholder="Mot de passe" type="password" data-toggle="tooltip" data-placement="right" title="Au moins 6 caractères"></div><input class="btn btn-primary btn-block" name="commit" type="submit" value="Se connecter" id="connexionbutton">
                                <p class="small">
                                    <br>
                                    <a href="/users/password/new">Mot de passe oublié ?</a>
                                </p></form>
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
