<?php
require 'include/envoi_demande_ami_func.php';
enreg_invitation();
if (isset($_GET['pseudo'])) {
    header("Location: index.php?page=profil_membre&pseudo=".$_GET['pseudo']);
}


