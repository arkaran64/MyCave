<?php
require('inc/connect.php');
require('inc/functions.php');
require('assets/head.php');
include('assets/nav.php');
$wine_id = ($_GET['id']);
$user_id = $_SESSION['id'];



// Requete de selection
$sth = $db->prepare("SELECT * FROM wines
    WHERE id = $wine_id
    ");

$sth->execute();


while ($data = $sth->fetch()) {

?>

    <section id="edit_card">
        <h2 class="section-title">Modifier votre vin :</h2>
        <div class="content">
            <form action="edit_card_post.php" method="POST" enctype="multipart/form-data" class="edit-form">
                <div class="form-group">
                    <label for="name_card">Nom</label>
                    <input type="text" class="form-control" name="name" id="name_card" value="<?= $data['name'] ?>">
                </div>

                <div class="form-group">
                    <label for="year-card">Année</label>
                    <input type="text" class="form-control" name="year" id="year-card" value="<?= $data['year'] ?>">
                </div>

                <div class="form-group">
                    <label for="grapes_card">Cépage</label>
                    <input type="text" class="form-control" name="grapes" id="grapes_card" value="<?= $data['grapes'] ?>">
                </div>

                <div class="form-group">
                    <label for="country_card">Pays</label>
                    <input type="text" class="form-control" id="country_card" name="country" placeholder="<?= $data['country'] ?>">
                </div>

                <div class="form-group">
                    <label for="region-card">Région</label>
                    <input type="text" class="form-control" id="region_card" name="region" placeholder="<?= $data['region'] ?>">
                </div>

                <div class="form-group">
                    <label for="desc_wine">Description</label>
                    <textarea class="form-control" name="description" rows="5" placeholder="<?= $data['description'] ?>" id="desc_card" required></textarea>
                </div>

                <div class="form-group">
                    <label for="img_url">Choisissez une photo de présentation</label>
                    <input type="file" name="img_url" id="img_url" accept=".png,.jpeg,.jpg,.gif" value="<?= $data['image_url'] ?> ">
                </div>
                </div class="form-group">
                    <input type="hidden" name="wine_id" value="<?= $wine_id; ?>">
                    <input type="submit" class="btn" name="submit_mod" placeholder="Modifier" />
                </div>
            </form>
        </div>
        <br>
        <div class="back">
            <a class="btn" href="my_wines.php?id=<?= $user_id ?>">retour</a>
        </div>

    </section>


<?php
}

require('assets/footer.php'); ?>