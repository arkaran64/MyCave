<?php
$page = 'profile';
require('inc/connect.php');
require('inc/functions.php');
include('assets/head.php');
include('assets/nav.php');
$user_id = $_SESSION['id'];

$sql1 = $db->query("SELECT COUNT(*) FROM wines WHERE wines.author_article = $user_id");
$compteur = $sql1->fetchColumn();


// Requete de selection
$sth = $db->prepare("SELECT * FROM users WHERE id = $user_id
    ");

$sth->execute();

$result = $sth->fetchAll(PDO::FETCH_ASSOC);


foreach ($result as $userData => $data) {
?>
    <section id="edit_user">
       <?php
       if(isset($_GET['signup'])){
           $message="Vous bien enrgistré.";
           echo "<div'> " . $message . " </p>";
       }
       ?>
        <div class="content">
            <?php 
            if(isset($_SESSION['email']) &&  $_SESSION['rank'] == "1") {
            ?>

             <h1 class="section-title">Profil Admin</h1>
            
            <?php
            }else{
            ?>

            <h1 class="section-title">Mon profil</h1>

            <?php
            }
            ?>  
            <div class="buttonsRow">
                <a href="create_card.php" class="btn ">Enregistrer un vin</a>

                <a href="my_wines.php" class="btn <?php if ($compteur < 1) {
                                                                    echo 'disabled';
                                                                } ?>">Voir mes vins <span class="badge badge-primary badge-pill"><?= $compteur; ?></span>
                </a>
                <?php 
                    if(isset($_SESSION['email']) &&  $_SESSION['rank'] == "1") {
                ?>
                    <a href='my_users.php' class='btn'>Voir membres</a>
                <?php
                }
                ?>
            </div>
            <br>
            <form action="edit_user.php" class="edit-form" method="post">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <br>
                    <input type="text" class="lastname" name="nom" placeholder="<?= $data['lastname']; ?>" value="">
                </div>
                <div class="form-group">
                    <label for="prenom">Prenom</label>
                    <br>
                    <input type="text" class="firstname" name="prenom" placeholder="<?= $data['firstname']; ?>" value="">
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <br>
                    <input type="text" class="address" name="adresse" placeholder="<?= $data['user_address']; ?>" value="">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <br>
                    <input type="email" class="email" name="email" placeholder="<?= $data['email']; ?>">
                </div>

                <div class="form-group">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>" ?>
                    <input type="submit" name="submit_update" class="btn" value="Mettre à jour">
                </div>

            </form>
        </div>
        <br>


    <?php
}
    ?>

    <div class="back">
        <a class="btn-back" href="index.php">Retour a la liste des vins</a>
    </div>

    </section>




    <?php require('assets/footer.php'); ?>