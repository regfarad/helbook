<?php
//la fonction qui va nous permettre d'afficher l'info-bulle des invitations 
function afficher_ibi() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    
    $sessionPseudo = $_SESSION['auth']['pseudo'];
    $nb = $dbh->query("SELECT COUNT(id_invitation) FROM amis WHERE pseudo_dest = '$sessionPseudo' AND date_invitation = date_confirm");
    $res = $nb->fetchColumn();
    
    return $res;
}