<?php
require './include/amis_func.php';
require './include/header.php';
require './menu_membre.php';
?>
<h3 style="color:white; font-weight: bolder; text-align: center; background-color:midnightblue; padding-left: 10px;">Vos amis</h3>
<?php
$amis_exp = liste_amis_exp();
$amis_dest = liste_amis_dest();

foreach ($amis_exp as $ami_exp) {
    ?>
    <div class="liste_membres">
        <a style="font-weight: bold;" href="index.php?page=profil_membre&pseudo=<?php echo $ami_exp['pseudo_dest']; ?>"> 
            <?php echo $ami_exp['pseudo_dest']; ?>
        </a>
        <a href="index.php?page=profil_membre&pseudo=<?php echo $ami_exp['pseudo_dest']; ?>">
            <img src="<?php echo $ami_exp['img_profil']; ?>"  height="70" width="70" class="img-rounded">
        </a> 
<!--        <span class="icon-mail"></span>-->
    </div>

    <?php
}

foreach ($amis_dest as $ami_dest) {
    ?>
    <div class="liste_membres">
        <a style="font-weight: bold;" href="index.php?page=profil_membre&pseudo=<?php echo $ami_dest['pseudo_exp']; ?>"> 
            <?php echo $ami_dest['pseudo_exp']; ?> 
        </a>
        <a href="index.php?page=profil_membre&pseudo=<?php echo $ami_dest['pseudo_exp']; ?>">
            <img src="<?php echo $ami_dest['img_profil']; ?>"  height="70" width="70" class="img-rounded">
        </a>
<!--        <span class="icon-mail"></span>-->
    </div>
    <?php
}

if (empty($amis_exp) && empty($amis_dest)) {
    ?>
    <h3 style="text-align: center; color: red; font-weight: bolder;">Vous n'avez pas d'amis</h3>
    <?php
}
