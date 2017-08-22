<?php
require 'include/membre_func.php';
$ibi = afficher_ibi();
//$nbNotNL = nombre_notifs_non_lues();
if ($ibi != '0') {
    ?>
    <div class="ibi">
        <?php
        echo $ibi;
        ?>
    </div>
    <!--        <div class="notif_right">
                <p>Une petite description</p>
            </div>-->
    </div>
    <?php
}
?>
<nav>
    <ul>
        <li><a href="index.php?page=compte">Accueil</a></li><!--
        --><li><a href="index.php?page=parametres">Parametres</a></li><!--
        --><li><a href="index.php?page=liste_membres">Membres</a></li><!--
        --><li><a href="index.php?page=amis">Amis</a></li><!--
        --><li><a href="index.php?page=invitations">Invitations</a></li><!--
        --><li><a href="index.php?page=conversations">Messages</a></li><!--
        --><li style="color: greenyellow;"><?php echo nombre_membres() > 1 ? nombre_membres() . ' membres' : nombre_membres() . ' membre'; ?></li><!--
        <li class="<?=$nbNotNL > 0 ?  'have_notifs' :'' ?>">
            <a href="index.php?page=notifications">
                <i class="icon-bell"></i>
                //<?= $nbNotNL > 0 ? "($nbNotNL)" : ''; ?>
            </a>
        </li>-->    
    </ul>
</nav>

 



