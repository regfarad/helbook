<?php

//la fonction qui va nous permettre de verifier si le pseudo existe et si la personne n'essaie pas de s'autoenvoyer un message
function pseudo_incorrect() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }

    if (isset($_GET['pseudo'])) {
        $getPseudo = $_GET['pseudo'];
        $sessionPseudo = $_SESSION['auth']['pseudo'];

        $nb = $dbh->query("SELECT COUNT(pseudo) FROM profiluser WHERE pseudo = '$getPseudo' AND pseudo != '$sessionPseudo'");
        $res = $nb->fetchColumn();
    }
    return $res;
}

//la fonction qui va créer la conversation et le message qui va avec 
function creer_conversation($sujet, $message) {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }

    if (isset($_GET['pseudo'])) {
        $getPseudo = $_GET['pseudo'];
        $sessionPseudo = $_SESSION['auth']['pseudo'];

        $req = $dbh->prepare("INSERT INTO conversations(sujet) VALUES (:sujet)");
        $req->bindParam(':sujet', $sujet);
        $req->execute();

        $id_conversation = $dbh->lastInsertId();

        $req2 = $dbh->prepare("INSERT INTO conversations_messages(id_conversation,pseudo_exp,corps_message,date_message) VALUES "
                . "(:id_conversation,:pseudo_exp, :corps_msg, NOW())");
        $req2->bindParam(':id_conversation', $id_conversation);
        $req2->bindParam(':pseudo_exp', $sessionPseudo);
        $req2->bindParam(':corps_msg', $message);
        $req2->execute();

        $req3 = $dbh->prepare("INSERT INTO conversations_membres(id_conversation,pseudo_dest) VALUES (:id_conversation,:pseudo_dest)");
        $req3->bindParam(':id_conversation', $id_conversation);
        $req3->bindParam(':pseudo_dest', $getPseudo);
        $req3->execute();
    } else {
        echo 'On ne trouve pas le get';
    }
}
/*
function creer_tchat($message) {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }

    if (isset($_GET['pseudo'])) {
        $getPseudo = $_GET['pseudo'];
        $sessionPseudo = $_SESSION['auth']['pseudo'];

        $req = $dbh->prepare("INSERT INTO conversations(id) VALUES('') ");
        $req->bindParam(':sujet', $sujet);
        $req->execute();

        $id_conversation = $dbh->lastInsertId();

        $req2 = $dbh->prepare("INSERT INTO conversations_messages(id_conversation,pseudo_exp,corps_message,date_message) VALUES "
                . "(:id_conversation,:pseudo_exp, :corps_msg, NOW())");
        $req2->bindParam(':id_conversation', $id_conversation);
        $req2->bindParam(':pseudo_exp', $sessionPseudo);
        $req2->bindParam(':corps_msg', $message);
        $req2->execute();

        $req3 = $dbh->prepare("INSERT INTO conversations_membres(id_conversation,pseudo_dest) VALUES (:id_conversation,:pseudo_dest)");
        $req3->bindParam(':id_conversation', $id_conversation);
        $req3->bindParam(':pseudo_dest', $getPseudo);
        $req3->execute();
    } else {
        echo 'On ne trouve pas le get';
    }
}
*/