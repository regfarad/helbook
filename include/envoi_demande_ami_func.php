<?php

//la fonction qui va enregistrer l'invitation dans la bd
function enreg_invitation() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    session_start();
    $sessionPseudo = $_SESSION['auth']['pseudo'];
    $nom_notif =  'demande_amitie';
    if (isset($_GET['pseudo'])) {
        $getPseudo = $_GET['pseudo'];
        
        $req = $dbh->prepare("INSERT INTO amis (pseudo_exp, pseudo_dest, date_invitation,date_confirm, active)"
                . " VALUES (:sessionPseudo, :getPseudo, NOW(), NOW(), 0)");
        $req->bindParam(':sessionPseudo', $sessionPseudo);
        $req->bindParam(':getPseudo', $getPseudo);
        $req->execute();
        
        //Sauvergarde de la notification
        $req = $dbh->prepare("INSERT INTO notifications (sujet_notif_id, nom_notif, date_notif, user_id)"
                . "VALUES(:sujet_notif_id, :nom_notif, NOW(), :user_id)");
        $req->bindParam(':sujet_notif_id', $getPseudo);
        $req->bindParam(':nom_notif',$nom_notif);
        $req->bindParam(':user_id', $sessionPseudo);
        $req->execute();
        
    } else {
        echo 'On ne trouve pas le get';
    }
}
