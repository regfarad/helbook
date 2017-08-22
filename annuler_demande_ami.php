<?php
require 'include/annuler_demande_ami_func.php';
supprimer_invitation();
if (isset($_GET['pseudo'])) {
    header("Location: index.php?page=profil_membre&pseudo=".$_GET['pseudo']);
}

