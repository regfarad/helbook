<?php
require 'include/liste_membres_func.php';
require 'include/header.php';
require 'menu_membre.php';
?>
<h3 style="color:white; font-weight: bolder; text-align: center; background-color:midnightblue; padding-left: 10px;">Liste des membres</h3>
<?php
$pseudos_avatars = recuperer_pseudo_avatar();
if (!empty($pseudos_avatars)) {
    foreach ($pseudos_avatars as $pseudo_avatar) {
        ?>
        <div class="liste_membres">
            <a style="font-weight: bold;" href="index.php?page=profil_membre&pseudo=<?php echo $pseudo_avatar['pseudo']; ?>">
                <?php echo $pseudo_avatar['pseudo']; ?>
            </a>
            <a href="index.php?page=profil_membre&pseudo=<?php echo $pseudo_avatar['pseudo']; ?>">
                <img src="<?php echo $pseudo_avatar['img_profil']; ?>" height="70" width="70" alt="Photo de profil" class="photo_profil img-rounded">
            </a>
            <span class=""></span>
        </div>

        <?php
    }
} else {
    ?>
    <p style="color: red; background-color: #ff9999;"><?php echo "Vous êtes le seul membre pour l'instant ..."; ?></p>
    <?php
}
