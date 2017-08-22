<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>  
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/accueil.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/func.js"></script>
        <script src="js/tchat_func.js"></script>
        <script language="Javascript">
            function validationmdp() {
                var val1 = document.getElementById("password").value;
                var val2 = document.getElementById("password_conf").value;
                var result = document.getElementById("result");
                result.innerHTML = "";
                if (val1 !== val2) {
                    result.innerHTML = "Les 2 mots de passe ne sont pas concordants. Réessayez";
                    document.getElementById('result').style.color = '#f00';
                }
            }

            function validationmail() {
                var val1 = document.getElementById("email").value;
                var val2 = document.getElementById("emailConf").value;
                var result2 = document.getElementById("result2");
                result2.innerHTML = "";
                if (val1 !== val2) {
                    result2.innerHTML = "Les 2 emails ne sont pas concordants. Réessayez";
                    document.getElementById('result2').style.color = '#f00';
                }
            }

        </script>
        <style type="text/css">
            h1{

                font-family: "Trebuchet MS", Georgia, Serif;

            }
            [class*="col"] { 

                margin-bottom: 20px;

            }
        </style>  
        <title>HelBook, réseau social de la Helb</title>
    </head>

    <body class="idBody">
        <header class="row idHeader">
            <div class="container">
                <div class="col-lg-1"><a href="index.php?page=accueil_inscription"><img src="img_helbook/helb.jpg" height="60" width="60" class="img-rounded" alt="LOGO"></a></div>
                <h1 class="title"><a href="index.php?page=accueil_inscription">HelBook</a></h1> 
                <?php if (isset($_SESSION['auth'])): ?>
                <p style="color:white; font-weight: bolder;">Bonjour <?= $_SESSION['auth']['pseudo']; ?></p>
                <a style="margin-left: 8%;"href="index.php?page=logout" class="btn btn-danger"> Se déconnecter</a>
                <?php else: ?>
                    <form class="form-horizontal col-lg-10" role="form" method="POST" action="login.php">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="login ou adresse mail" autofocus required/>
                                    <input type="checkbox" name="remember" id="remember" value="1"/> 
                                    <label style="color: white;">Se souvenir de moi</label>
                                </div>
                                <div class="col-lg-4">
                                    <input type="password" class="form-control" name="passwd" id="passwd" placeholder="mot de passe" required/>
                                    <label for=""><a href="index.php?page=forget">Mot de passe oublié</a></label>
                                </div>
                                <div class="col-lg-2">
                                    <input type="submit" class="btn btn-info" role="button" name="envoyer" value="Connexion">
                                </div>
                            </div>

                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </header>

        <?php if (isset($_SESSION['flash'])): ?>
            <?php foreach ($_SESSION['flash'] as $type => $msg): ?>
                <div class="alert alert-<?= $type; ?>">
                    <?= $msg; ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
