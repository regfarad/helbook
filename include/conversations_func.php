<?php

//la fonction qui va recuperer les conversations 
function recup_conversation() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    $infos = array();

    
    $sessionPseudo = $_SESSION['auth']['pseudo'];
    $sql = "SELECT conversations.id_conversation,conversations.sujet,profiluser.pseudo,profiluser.img_profil,conversations_messages.date_message "
            . "FROM conversations LEFT JOIN conversations_messages ON (conversations.id_conversation = conversations_messages.id_conversation) "
            . "INNER JOIN conversations_membres ON (conversations.id_conversation = conversations_membres.id_conversation) "
            . "INNER JOIN profiluser ON (profiluser.pseudo = conversations_messages.pseudo_exp) "
            . "WHERE pseudo_dest = :sessionPseudo "
            . "GROUP BY conversations.id_conversation "
            . "ORDER BY conversations_messages.date_message DESC";
    $req = $dbh->prepare($sql);
    $req->bindParam(':sessionPseudo', $sessionPseudo, PDO::PARAM_STR);
    $req->execute();
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $infos[] = $row;
    }


    return $infos;
}
