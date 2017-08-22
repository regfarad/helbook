<?php

//la fonction qui va accepter l'invitation
function accepter_invitation() {
    require 'connexion_bd.php';

    if (!isset($dbh)) {
        global $dbh;
    }
    
    $nom_notif = "demande_acceptee";
    
    if (isset($_GET['pseudo'])) {
        $getPseudo = $_GET['pseudo'];
        session_start();
        $sessionPseudo = $_SESSION['auth']['pseudo'];
        
        
        $sqlUp = "UPDATE amis SET active = 1, date_confirm = NOW() WHERE pseudo_exp = :getPseudo AND pseudo_dest = :sessionPseudo";
        $req = $dbh->prepare($sqlUp);

        $req->bindParam(':getPseudo', $getPseudo);
        $req->bindParam(':sessionPseudo', $sessionPseudo);
        $req->execute();
        
        //Sauvergarde de la notification
        $req = $dbh->prepare("INSERT INTO notifications (sujet_notif_id, nom_notif, date_notif, user_id)"
                . "VALUES(:sujet_notif_id, :nom_notif, NOW(), :user_id)");
        $req->bindParam(':sujet_notif_id', $getPseudo);
        $req->bindParam(':nom_notif',$nom_notif);
        $req->bindParam(':user_id', $sessionPseudo);
        $req->execute();
    }
}


