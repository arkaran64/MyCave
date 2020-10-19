<?php

require('assets/head.php');
require('inc/functions.php');
require('inc/connect.php');
include('assets/nav.php');
$page = 'create_card';
$id = $_SESSION['id'];


if (isset($_GET['e']) && $_GET['e'] == '1') {
    echo "<div class='col-12 alert alert-danger text-center'> Tous les champs n'ont pas été renseignés. </div>";
} elseif (isset($_GET['e']) && $_GET['e'] == '2') {
    echo "<div class='col-12 alert alert-danger text-center'> Le fichier téléchargé est trop grand (10Mb maximum). </div>";
} elseif (isset($_GET['e']) && $_GET['e'] == '3') {
    echo "<div class='col-12 alert alert-danger text-center'> Le fichier téléchargé est invalide (Seules les images sont acceptées). </div>";
} elseif (isset($_GET['e']) && $_GET['e'] == '4') {
    echo "<div class='col-12 alert alert-danger text-center'> Une erreur est survenue ! </div>";
}
?>

<section id="create_wine">
    <h2 class="section-title">Enregistrer un vin :</h2>
    <div class="content">
        <form action="create_card_post.php" method="POST" enctype="multipart/form-data" class="edit-form">

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="...">
            </div>
            <div class="form-group">
                <label for="year">Année</label>
                <input type="text" class="form-control" name="year" id="year">
            </div>
            <div class="form-group">
                <label for="grapes">Cépage</label>
                <input type="text" class="form-control" name="grapes" id="grapes">
            </div>
            <div class="form-group">
                <label for="country">Pays</label>
                <input type="text" class="form-control" name="country" id="country" placeholder="...">
            </div>
            <div class="form-group">
                <label for="city_annonce">Région</label>
                <input type="text" class="form-control" name="region" id="region" placeholder="...">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" rows="3" placeholder="Description" id="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="img_url">Choisissez une photo</label>
                <input type="file" name="img_url" id="img_url" accept=".png,.jpeg,.jpg,.gif">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="gridCheck">
                    J'accepte les CGU
                </label>
                <input class="form-check-input" type="checkbox" id="gridCheck">
            </div>
            <div class="form-group">
                <input type="hidden" name="user_id" value="<?= $id; ?>">
                <input type="submit" class="btn " name="submit" value="Créer!" />
            </div>
        </form>
    </div>
    <br>
    <div class="back">
        <a class="btn" href="profile.php?id=<?= $user_id ?>">retour</a>
    </div>
</section>
<?php require('assets/footer.php') ?>