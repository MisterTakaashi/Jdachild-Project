<?php include "../includes/header.php"; ?>
<?php
if(isset($_POST['username'], $_POST['password'], $_POST['password2'], $_POST['email'], $_POST['promotion'])){
    if($_POST['password'] == $_POST['password2']){
        $returncreate = $session->createUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['promotion']);

        if($returncreate == 1){
            echo '<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Ce pseudo existe déja !
            </div>';
        }else if($returncreate == 2){
            echo '<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Cet email existe déja !
            </div>';
        }
    }else{
        echo '<div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Les deux mots de passe ne correspondent pas !
        </div>';
    }
}
?>
<div id="global">
    <div id="connexion">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6"><h3 class="title">Inscription</h3></div>
                <div class="col-xs-12 col-md-1"><div class="spacer"></div></div>
                <div class="col-xs-12 col-md-5"><h3 class="title">Infos importante</h3></div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="box box-signin">
                        <div class="box-content dark">
                            <form accept-charset="UTF-8" action="#" class="simple_form new_user" id="new_user" method="POST">
                                <div class="form-group string required user_login">
                                    <input autofocus="autofocus" class="string required form-control" id="user_login" name="username" placeholder="Nom d'utilisateur" type="text" required="required">
                                </div>
                                <div class="form-group password required user_password">
                                    <input class="password required form-control" id="user_password" name="password" placeholder="Mot de passe" type="password" required="required">
                                </div>
                                <div class="form-group password required user_password">
                                    <input class="password required form-control" id="user_password2" name="password2" placeholder="Retapez le mot de passe" type="password" required="required">
                                </div>
                                <div class="form-group email required user_email">
                                    <input class="string required form-control" id="user_email" name="email" placeholder="E-Mail" type="email" required="required">
                                </div>
                                <div class="form-group email required user_email">
                                    <select class="string required form-control" id="user_promotion" name="promotion">
                                        <optgroup label="INGESUP">
                                            <option value="B1">Bachelor 1</option>
                                            <option value="B2">Bachelor 2</option>
                                            <option value="B3">Bachelor 3</option>
                                            <option value="E1">Expert 1</option>
                                            <option value="E2">Expert 2</option>
                                        </optgroup>
                                        <optgroup label="Lim'Art">
                                            <option value="MANAA1">MANAA</option>
                                        </optgroup>
                                        <optgroup label="INFOSUP">
                                            <option value="BTS1">BTS 1</option>
                                            <option value="BTS2">BTS 2</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <input class="btn btn-primary btn-block" name="commit" type="submit" value="S'inscrire" id="connexionbutton">
                            </form>
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
