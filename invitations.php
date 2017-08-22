<?php
require 'include/invitations_func.php';
require 'include/header.php';
require 'menu_membre.php';
?>
<h3 style="color:white; font-weight: bolder; background-color:midnightblue; padding-left: 10px;">Vos invitations</h3>
<?php
$invitations = recup_invitation();
$invitations_acceptees = invitation_acceptee();
if ($invitations == TRUE) {
    ?>
    <h3 style="color: midnightblue; font-weight: bolder;">Demande(s) en cours ...</h3>
    <?php
    foreach ($invitations as $invitation) {
        ?>

        <?php
        if ($invitation['active'] == 0) {
        ?>
    <ul class="list-group">
        <li class="list-group-item <?= $invitation['active'] == 0 ? 'non_vu' : ' ' ?>">
            <?php require 'include/notifications/demande_amitie.php'; ?> 
        </li>      
    </ul>
           <?php 
        } else {
            ?>
            <div style="color: green; font-weight: bolder;">Vous êtes désormais ami(e) avec <?php echo $invitation['pseudo_exp']; ?></div>
            <?php
        }
    }
} else if ($invitations_acceptees == TRUE) {
    foreach ($invitations_acceptees as $invitation_acceptee) {
        ?>
        <div style="color: green; font-weight: bolder;"><?php echo $invitation_acceptee['pseudo_dest']; ?> a accepté votre invitation</div>
        <?php
    }
} else {
    ?>
    <div style="color: midnightblue; font-weight: bolder;">Vous n'avez aucune invitation</div>
    <?php
}


