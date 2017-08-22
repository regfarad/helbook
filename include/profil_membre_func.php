<?php

//la fonction qui va recuperer les informations de la personne choisie par l'utlisateur
function recuperer_info_membre_choisi() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }

    $infos = array();
    if (isset($_GET['pseudo'])) {
        $pseudo = $_GET['pseudo'];
        $sql = "SELECT * FROM profiluser WHERE pseudo = :pseudo";
        $req = $dbh->prepare($sql);
        $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $infos[] = $row;
        }
    } else {
        echo 'Le get a une erreur';
    }
    return $infos;
}

//la fonction qui va vérifier si une demande existe entre les deux membres 
function demande_existe() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }

    if (isset($_GET['pseudo'])) {
        $sessionPseudo = $_SESSION['auth']['pseudo'];
        $getPseudo = $_GET['pseudo'];
        $nb = $dbh->query("SELECT count(id_invitation) FROM amis WHERE pseudo_exp = '$sessionPseudo' AND pseudo_dest = '$getPseudo' OR (pseudo_exp = '$getPseudo' AND "
                . "pseudo_dest = '$sessionPseudo')");
        $res = $nb->fetchColumn();
    } else {
        echo 'Le get a une erreur';
    }

    return $res;
}

//la fonction qui va verifier si le destinataire a accepté la demande
function accepter_demande() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    
    if (isset($_GET['pseudo'])) {
        $getPseudo = $_GET['pseudo'];
        $sessionPseudo = $_SESSION['auth']['pseudo'];
        $sql = "SELECT active FROM amis WHERE (pseudo_exp = '$sessionPseudo' AND pseudo_dest = '$getPseudo') OR (pseudo_exp = '$getPseudo' AND pseudo_dest = '$sessionPseudo')";
        $req = $dbh->query($sql);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            if ($row['active'] == 0) {
                return false;
            } else {
                return true;
            }
        }
    }
}

//la fonction qui va verifier si le membre connecté est l'expéditeur
function verif_expediteur() {
   require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    
    if (isset($_GET['pseudo'])) {
        $getPseudo = $_GET['pseudo'];
        $sessionPseudo = $_SESSION['auth']['pseudo'];
        $nb = $dbh->query("SELECT count(id_invitation) FROM amis WHERE pseudo_exp = '$sessionPseudo' AND pseudo_dest = '$getPseudo'");
        $res = $nb->fetchColumn();
    } 
    return $res;
}















