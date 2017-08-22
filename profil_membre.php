<?php
require 'include/profil_membre_func.php';
require 'include/header.php';
require 'menu_membre.php';
?>

<div class="info">
    <?php
    $infos = recuperer_info_membre_choisi();

    if ($infos == true && $_GET['pseudo'] != $_SESSION['auth']['pseudo']) {

        foreach ($infos as $info) {
            if (demande_existe() == 0) {
                ?>   
                <div style="text-align: center;">
                    <h3 style="color: red; font-weight: bolder;"><?php echo "Vous n'êtes pas ami(e) avec " . $info['pseudo']; ?></h3>
                    <p><img src="<?php echo $info['img_profil']; ?>"  height="200" width="200" class="img-rounded"></p>
                    <a href="index.php?page=envoi_demande_ami&pseudo=<?php echo $info['pseudo']; ?>" class="btn btn-primary icon-add-user">
                        <em>Ajouter comme ami(e)</em>
                    </a>
                </div>
                <?php
            } elseif (accepter_demande() == 0 && verif_expediteur() == 1) {
                ?>
                <div style="text-align: center;">
                    <h3 style="color: midnightblue; font-weight: bolder;">Demande envoyée à <?php echo $info['pseudo']; ?></h3>
                    <p><img src="<?php echo $info['img_profil']; ?>"  height="200" width="200" class="img-rounded"></p>
                    <a href="index.php?page=annuler_demande_ami&pseudo=<?php echo $info['pseudo']; ?>" class="btn btn-danger icon-remove-user">
                        <em>Annuler la demande</em>
                    </a>
                </div>

                <?php
            } elseif (accepter_demande() == 0 && verif_expediteur() == 0) {
                ?>
                <h3 style="color: midnightblue; font-weight: bolder;">Demande d'ami de <?php echo $info['pseudo']; ?> en cours ...</h3>
                <p><img src="<?php echo $info['img_profil']; ?>"  height="200" width="200" class="img-rounded"></p>
                <h4 style="color: midnightblue; font-weight: bolder;"><em>Verifiez vos invitations.</em></h4>
                <?php
            } else {
                ?>
                <h3 style="color:white; font-weight: bolder; background-color:midnightblue; padding-left: 10px;"><center>Profil de <?php echo $info['pseudo']; ?></center></h3>
                <div style="text-align: center;">
                    <h5 class="envoimsg"><a href="index.php?page=new_message&pseudo=<?php echo $info['pseudo']; ?>"><em>Envoyer un message privé</em></a></h5>
                    <h5 class="envoimsg"><a href="index.php?page=tchat&pseudo=<?php echo $info['pseudo']; ?>"><em>Chat en direct</em></a></h5>
                    <p><img src="<?php echo $info['img_profil']; ?>"  height="200" width="200" class="img-rounded"></p>
                    <h5 class="retirer"><a href="index.php?page=supprimer_ami&pseudo=<?php echo $info['pseudo']; ?>"><em>Retirer <?php echo $info['pseudo']; ?> de votre liste d'amis</em></a></h5>
                    <div style="color: midnightblue;">
                        <p><strong>Nom</strong> : <em><?php echo $info['nom']; ?></em></p>
                        <p><strong>Prénom</strong> : <em><?php echo $info['prenom']; ?></em></p>
                        <p><strong>Email</strong> : <em><?php echo $info['mail']; ?></em></p>
                        <p><strong>Sexe</strong> : <em><?php echo $info['sexe']; ?></em></p>
                        <p><strong>Date de naissance</strong> : <em><?php echo date("d/m/Y", strtotime($info['dateNaiss'])); ?></em></p>
                        <p><strong>Situation</strong> : <em><?php echo $info['situation']; ?></em></p>
                        <p><strong>Année académique</strong> : <em><?php echo $info['anac']; ?></em></p>
                        <p><strong>Section</strong> : <em><?php echo $info['section']; ?></em></p>
                    </div>

                </div>
                <?php
            }
        }
    } else {
        header("Location: index.php?page=compte");
    }
    ?>
</div>