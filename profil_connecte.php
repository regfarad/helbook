<?php
require 'include/functions.php';
isLogged_only();

require 'include/header.php';
?>
<?php
require 'menu_membre.php';
?>
<h3 style="color:white; font-weight: bolder; background-color:midnightblue; padding-left: 10px;"><center>Votre Profil</center></h3>
<?php
require 'infos_membre_online.php';
require 'include/footer.php';
