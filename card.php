<?php
$page = 'card';
require('inc/connect.php');
require('inc/functions.php');
require('assets/head.php');
include('assets/nav.php');
$id = $_GET['id'];

?>

<section id="card">

    <?php
        displayWine($id);
    ?>
    
</section>



<?php require('assets/footer.php'); ?>