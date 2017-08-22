<a href="index.php?page=profil_membre&pseudo=<?php echo $invitation['pseudo_exp']; ?>" style="font-weight: bold; color: midnightblue;">
    <img src="<?php echo $invitation['img_profil']; ?>" height="50" width="50" class="img-rounded">
    <?php echo $invitation['pseudo_exp']; ?> 
</a>
vous a envoyé une demande d'amitié le 
<span class="timeago" title="<?php echo date('d/m/Y à H:i:s', strtotime($invitation['date_invitation'])); ?>">
    <?php echo date('d/m/Y à H:i:s', strtotime($invitation['date_invitation'])); ?>
</span>.
<a class="btn btn-success" href="index.php?page=accepter&pseudo=<?php echo $invitation['pseudo_exp'] ?>">Accepter</a>
<a class="btn btn-danger" href="index.php?page=refuser&pseudo=<?php echo $invitation['pseudo_exp'] ?>">Refuser</a>