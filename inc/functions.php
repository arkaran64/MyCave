<?php

function shorten_text($text, $max = 120, $append = '&hellip;')
{
    if (strlen($text) <= $max) return $text;
    $return = substr($text, 0, $max);
    if (strpos($text, ' ') === false) return $return . $append;
    return $return . $append;
    return preg_replace('\w+$/', ' ', $return) . $append;
}

function displayAllUsers()
{
    global $db;
    $sql = $db->query("SELECT * FROM users");
    $sql->setFetchMode(PDO::FETCH_ASSOC);

?>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">N°ID</th>
                <th scope="col">Email</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Adresse</th>
                <th scope="col"></th>      
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $sql->fetch()) {
            ?>
                <tr id="row-<?php echo $row['id']; ?>"></tr>
                <td scope="row"><?php echo $row['id']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td><?php echo $row['user_address']; ?></td>       
                <td><a href="delete_users.php?id=<?= $row['id'] ?>">Supprimer</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}


function displayAllWines()
{
    global $db;
    $sql = $db->query("SELECT * FROM wines");
    $sql->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $sql->fetch()) {
    ?>

        <div class="product-card">
            <div class="product-image">
                <img class="card-img-top" src="assets/uploads/<?= $row['picture']; ?>" alt="Card image">
            </div>
            <div class="product-info">
                <h5 class="card-title"><?= $row['name']; ?></h5>
                <h6><?= $row['year']; ?></h6>
            </div>
            <div class="card-body">
                <a class="btn-link" href="card.php?id=<?= $row['id'] ?>" class="card-link">Voir</a>
            </div>
        </div>


    <?php
    }
}


function displayWine($id)
{
    global $db;
    $sql = $db->query("SELECT * FROM wines WHERE id = $id");
    $sql->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $sql->fetch()) {
    ?>
        <div class="content">

            <div class="wine-card">
                <div class="left-column">
                    <img class="card-img-top" src="assets/uploads/<?= $row['picture']; ?>" alt="Card image">
                </div>
                <div class="right-column">
                    <div class="product-name">
                        <h1 class="card-title"><?= $row['name']; ?></h1>
                    </div>
                    <div class="infos">
                        <h2><?= $row['year']; ?></h2>
                        <br>
                        <h2><?= $row['region']; ?>,<?= $row['country']; ?></h2>
                        <br>
                        <h3><?= $row['grapes']; ?></h3>
                        <br>
                        <h3>Description: </h3>                        
                        <p><?= $row['description']; ?></p>              
                    </div>
                </div>
            </div>
        </div>
    <a class="btn" href="index.php#winesList" class="card-link">Retour</a>
    <?php

    }
}

function displayAllWinesByUser($user_id)
{
    global $db;
    $sql = $db->query("SELECT * FROM wines WHERE wines.author_article = $user_id");
    $sql->setFetchMode(PDO::FETCH_ASSOC);

    ?>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Name</th>
                <th scope="col">Year</th>
                <th scope="col">Grapes</th>
                <th scope="col">Country</th>
                <th scope="col">Region</th>
                <th scope="col">Description</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $sql->fetch()) {
            ?>
                <tr id="row-<?php echo $row['id']; ?>"></tr>
                <td scope="row"><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['year']; ?></td>
                <td><?php echo $row['grapes']; ?></td>
                <td><?php echo $row['country']; ?></td>
                <td><?php echo $row['region']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><a href="edit_card.php?id=<?= $row['id'] ?>">Modifier</a></td>
                <td><a href="delete_article.php?id=<?= $row['id'] ?>">Supprimer</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
