<a href="index.php?page=profil_membre&pseudo=<?php echo $notif['pseudo']; ?>">
    <img src="<?php echo $notif['img_profil']; ?>" height="50" width="50" class="img-rounded">
</a>
 <?php echo $notif['pseudo']; ?> a accepté votre demande d'amitié le 
<span class="timeago" title="<?php echo date('d/m/Y à H:i:s', strtotime($notif['date_notif']));?>">
    <?php echo date('d/m/Y à H:i:s', strtotime($notif['date_notif'])); ?>
</span>.