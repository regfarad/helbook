<?php

//la fonction qui va récupérer les messages
function recup_message() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    $messages = array();

    $sessionPseudo = $_SESSION['auth']['pseudo'];
    if (isset($_GET['id'])) {
        $getid = $_GET['id'];
        $sql = "SELECT conversations_messages.date_message, conversations_messages.corps_message, conversations.sujet,conversations_membres.pseudo_dest, "
                . "conversations_messages.pseudo_exp, profiluser.pseudo, profiluser.img_profil "
                . "FROM conversations_messages "
                . "INNER JOIN profiluser ON (profiluser.pseudo = conversations_messages.pseudo_exp) "
                . "INNER JOIN conversations_membres ON (conversations_messages.id_conversation = conversations_membres.id_conversation) "
                . "INNER JOIN conversations ON (conversations_messages.id_conversation = conversations.id_conversation) "
                . "WHERE conversations_messages.id_conversation = :getid "
                . "ORDER BY conversations_messages.date_message DESC";
        $req = $dbh->prepare($sql);
        $req->bindParam(':getid', $getid, PDO::PARAM_STR);
        //$req->bindParam(':sessionPseudo', $sessionPseudo, PDO::PARAM_STR);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = $row;
        }
    }
    return $messages;
}
