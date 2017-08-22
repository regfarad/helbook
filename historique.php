<?php
require './connexion_bd.php';
require './include/historique_func.php';
require './include/new_message_func.php';
if (!isset($_GET['pseudo']) && empty($_GET['pseudo']) && pseudo_incorrect() == "1") {
    header("Location: index.php?page=compte");
}
session_start();
$_SESSION['user']['pseudo'] = $_GET['pseudo'];
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
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/func.js"></script>
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

        <?php
        require './menu_membre.php';
        ?>


        <?php
        $users = get_historique();
        ?>
        <h3 style="color:white; font-weight: bolder; background-color:midnightblue; padding-left: 10px;">
            <center>
                Historique de la conversation avec <em><?php echo $_SESSION['user']['pseudo']; ?></em> 
            </center>
        </h3>

        <?php
        $membre = $_SESSION['auth']['pseudo'];
        foreach ($users as $user) {
            ?>
            <div class="messages-box">
                <div class="message <?php echo ($user['sender'] == $membre) ? 'message-membre' : 'message-user'; ?>">
                    <?php echo $user['message']; ?> 
                    <br>
                    <p style="font-size: smaller; font-style: italic">Envoyé par 
                        <?php
                            if ($user['sender'] == $membre) {
                                echo $user['sender'] ." le " .date("d/m/Y à H:i:s", strtotime($user['date'])); 
                            } else {
                                echo $user['sender'] ." le " .date("d/m/Y à H:i:s", strtotime($user['date']));
                            }
                        ?> 
                    </p>
                </div>
            </div>

            <?php
        }
