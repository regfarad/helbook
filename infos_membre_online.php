<div class="info">
    <?php
    $infos = infos_membre_connecte();
    foreach ($infos as $info) {
        ?>
        <div style="text-align: center; color: midnightblue;">
            <p><img src="<?php echo $info['img_profil']; ?>"  height="100" width="100" class="img-rounded"></p>
            <p><strong>Nom</strong> : <em><?php echo $info['nom']; ?></em></p>
            <p><strong>Prénom</strong> : <em><?php echo $info['prenom']; ?></em></p>
            <p><strong>Email</strong> : <em><?php echo $info['mail']; ?></em></p>
            <p><strong>Sexe</strong> : <em><?php echo $info['sexe']; ?></em></p>
            <p><strong>Date de naissance</strong> : <em><?php echo date("d/m/Y", strtotime($info['dateNaiss'])); ?></em></p>
            <p><strong>Situation</strong> : <em><?php echo $info['situation']; ?></em></p>
            <p><strong>Année académique</strong> : <em><?php echo $info['anac']; ?></em></p>
            <p><strong>Section</strong> : <em><?php echo $info['section']; ?></em></p>
        </div>

        <?php
    }
    ?>
</div>