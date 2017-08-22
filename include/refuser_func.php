<?php
//la fonction qui va refuser l'invitation
function refuser_invitation () {
    require 'connexion_bd.php';

    if (!isset($dbh)) {
        global $dbh;
    }
    
    if (isset($_GET['pseudo'])) {
        $getPseudo = $_GET['pseudo'];
        session_start();
        $sessionPseudo = $_SESSION['auth']['pseudo'];

        $sqlUp = "DELETE from amis WHERE pseudo_exp = :getPseudo AND pseudo_dest = :sessionPseudo";
        $req = $dbh->prepare($sqlUp);

        $req->bindParam(':getPseudo', $getPseudo);
        $req->bindParam(':sessionPseudo', $sessionPseudo);
        $req->execute();
    }
}
