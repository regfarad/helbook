<?php
//la fonction qui annuler l'invitation 
function supprimer_invitation () {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    session_start();
    $sessionPseudo = $_SESSION['auth']['pseudo'];
    if (isset($_GET['pseudo'])) {
        $getPseudo = $_GET['pseudo'];
        $req = $dbh->prepare("DELETE FROM amis WHERE pseudo_exp = :sessionPseudo AND pseudo_dest = :getPseudo");
        $req->bindParam(':sessionPseudo', $sessionPseudo);
        $req->bindParam(':getPseudo', $getPseudo);
        $req->execute();
    } else {
        echo 'On ne trouve pas le get';
    }
}
