<?php
//la fonction qui va nous permettre de supprimer un ami
function supprimer_ami () {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    session_start();
    $sessionPseudo = $_SESSION['auth']['pseudo'];
    if (isset($_GET['pseudo'])) {
        $getPseudo = $_GET['pseudo'];
        $req = $dbh->prepare("DELETE FROM amis WHERE (pseudo_exp = :sessionPseudo AND pseudo_dest = :getPseudo) OR "
                . "(pseudo_exp = :getPseudo AND pseudo_dest = :sessionPseudo)");
        $req->bindParam(':sessionPseudo', $sessionPseudo);
        $req->bindParam(':getPseudo', $getPseudo);
        $req->execute();
    } else {
        echo 'On ne trouve pas le get';
    }
}
