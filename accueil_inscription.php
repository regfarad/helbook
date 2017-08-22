<?php
require_once 'include/functions.php';
if (!empty($_POST)) {

    $errors = array();
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $login = $_POST['login'];
    $situation = $_POST['situation'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $pwd_conf = $_POST['password_conf'];
    $sexe = $_POST['sexe'];
    $dateNaiss = $_POST['dateNaiss'];
    $section = $_POST['section'];
    $anac = $_POST['anac'];

    //La photo de profil

    $fichier = basename($_FILES['avatar']['name']);
    $fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $fichier = preg_replace('/([^.a-z0-9_]+)/i', '-', $fichier);

    $dossier = 'images/';
    $cheminImg = $dossier . $fichier;

    if (empty($login) || !preg_match('/^[a-zA-Z0-9_]+$/', $login)) {
        $errors['login'] = "Votre pseudo n'est pas valide";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre adresse mail n'est pas valide";
    }

    if (empty($pwd) || $pwd != $pwd_conf) {
        $errors['password'] = "Vous n'avez pas rentré un mot de passe valide ...";
    }

    if (empty($errors)) {

        require_once 'connexion_bd.php';

        $req = $dbh->prepare("INSERT INTO profiluser(nom,prenom,sexe,pseudo,situation,passwd,dateNaiss,anac,section,mail,confirmation_token,img_profil)"
                . " VALUES (:nom,:prenom,:sexe,:pseudo,:situation,:passwd,:dateNaiss,:anac,:section,:mail,:confirmation_token,:img_profil)");
        $pass = md5($pwd);
        $token = str_random(60);

        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':sexe', $sexe);
        $req->bindParam(':pseudo', $login);
        $req->bindParam(':situation', $situation);
        $req->bindParam(':passwd', $pass);
        $req->bindParam(':dateNaiss', $dateNaiss);
        $req->bindParam(':anac', $anac);
        $req->bindParam(':section', $section);
        $req->bindParam(':mail', $email);
        $req->bindParam(':confirmation_token', $token);
        $req->bindParam(':img_profil', $cheminImg);

        $req->execute();
        $user_id = $dbh->lastInsertId();
        $objet = 'Confirmation de votre compte';
        $msg = "Afin de valider votre compte, veuillez cliquer sur ce lien.\n\nhttp://localhost/HelBook/confirm.php?id=$user_id&token=$token";
        $from = "From: regfaradtest@gmail.com";
        mail($email, $objet, $msg, $from);
        $_SESSION['flash']['success'] = "Un mail de confirmation vous a été envoyé pour valider votre compte";
        header('Location: index.php?page=login');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>  
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/accueil.css" rel="stylesheet">
        <link href="css/animation.css" rel="stylesheet">
        <link href="css/fontello-codes.css" rel="stylesheet">
        <link href="css/fontello-embedded.css" rel="stylesheet">
        <link href="css/fontello.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/func.js"></script>
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
                    <a style="margin-left: 8%;" href="index.php?page=logout"> Se déconnecter</a>
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

        <section class="col-lg-6">
            <p class="textSection">Bienvenue sur HelBook, le réseau social qui vous permettra de rester en contact avec tous les gens de la HELB ...</p>
            <img src="img_helbook/helb.jpg" height="500" width="500" class="img-circle" alt="LOGO">
        </section>
        <section class="col-lg-6">
            <form action="" method="POST" class="form-horizontal col-lg-7" enctype="multipart/form-data">
                <fieldset>
                    <legend>Inscription</legend>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" required/>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label for="login"></label>
                                <input type="text" class="form-control" name="login" id="login" placeholder="Login valide" required/>
                                <span class="feedback"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Adresse mail" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="email" class="form-control" name="emailConf" id="emailConf" placeholder="Confirmer votre Adresse mail" onchange="validationmail(this)" required>
                            </div>
                            <div id="result2"></div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Choisir mot de passe" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="password" class="form-control" name="password_conf" id="password_conf" placeholder="Confirmer votre mot de passe" onchange="validationmdp(this)" required>
                            </div>
                            <div id="result"></div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-lg-5 elmts">Situation</label>
                            <select name="situation">
                                <option value="Celibataire">Celibataire</option>
                                <option value="En relation libre">En relation libre</option>
                                <option value="En couple">En couple</option>
                                <option value="Marié(e)">Marié(e)</option>
                                <option value="Divorcé(e)">Divorcé(e)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-lg-5 control-label elmts positionDateNaiss"> Date de naissance </label>
                            <div class="col-lg-7">    
                                <input type='date' class="form-control" name="dateNaiss" id="dateNaiss" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="radio-inline">
                                <label class="elmts radio-inline"><input type="radio" name="sexe" value="homme" checked="checked" id="m">Homme</label>
                                <label class="elmts radio-inline"><input type="radio" name="sexe" value="femme" id="f">Femme</label>
                            </div>        
                        </div>
                        <div id="result2"></div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-lg-5 elmts positionSection"> Section </label>
                            <div class="radio-inline elmts">
                                <label class="radio-inline"><input type="radio" name="section" value="RP" checked="checked" id="rp">RP</label> 
                                <label class="radio-inline"><input type="radio" name="section" value="IG" id="ig">IG</label>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-lg-5 elmts">Année accadémique</label>
                            <select name="anac">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-lg-4 elmts positionAvatar">Definir Avatar</label>
                            <div class="col-lg-8 elmts">        
                                <input type="file" id="avatar" name="avatar" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <input type="submit" class="btn btn-success" role="button" name="envoyer" value="Inscription">
                            <input type="reset" class="btn btn-danger" role="button" name="annuler" value="Annuler">
                        </div>
                    </div>
                </fieldset>  
            </form>
        </section>
        <?php if (isset($_SESSION['flash'])): ?>
            <?php foreach ($_SESSION['flash'] as $type => $msg): ?>
                <div class="alert alert-<?= $type; ?>">
                    <?= $msg; ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
        <?php require 'include/footer.php'; ?>




