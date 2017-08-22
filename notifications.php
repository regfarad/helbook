<?php
require 'include/header.php';
require 'menu_membre.php';
require 'include/notifications_func.php';

$notifs = afficher_notifs();
?>
<h3 style="color:white; font-weight: bolder; text-align: center; background-color:midnightblue; padding-left: 10px;">Vos Notifications</h3>

<?php if (count($notifs) > 0) : ?>
    <ul class="list-group">
        <?php foreach ($notifs as $notif) : ?>
            <li class="list-group-item <?= $notif['vu'] == 0 ? 'non_vu' : ' ' ?>">
                <?php require("include/notifications/{$notif['nom_notif']}.php"); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <div style="color: green; font-weight: bolder;">Vous êtes désormais ami(e) avec <?php echo $notif['pseudo']; ?></div>
<?php endif; ?>

<!-- SCRIPTS -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/jquery.timeago.fr.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".timeago").timeago();
    });
</script>
<?php require "include/footer.php"; ?>