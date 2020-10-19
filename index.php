<?php
require('inc/connect.php');
require('inc/functions.php');
include('assets/head.php');
?>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="content">
            <img src="assets/img/logo.png" alt="logo" class="logo">
            <button class="menu-toggler">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="navbar-menu">
                <a href="#home">Accueil</a>
                <a href="#about">MyCave?</a>
                <a href="#winesList">Liste des vins</a>
                <?php
                if (empty($_SESSION)) {
                ?>
                    <a class="nav-link" href="login.php">Login</a>

                    <a class="nav-link" href="signup.php">Sign Up</a>
                    <?php
                }
                    ?>
                    
                <?php
                if (isset($_SESSION['email']) &&  $_SESSION['rank'] == "1") {
                ?>
                    <a>Admin</a>
                <?php
                    }
                ?>

                <?php
                if (isset($_SESSION['email'])) {
                ?>
                    <a href="profile.php" class="nav-link">Mon compte</a>

                    <a href="?logout" class="nav-link">Se déconnecter</a>
                <?php
                }
                ?>


            </div>
        </div>
    </nav>

    <!-- Accueil/titre -->
    <section id="home">
        <div class="content">
            <div class="mainTitle">
                <h1><span>My Cave</span></h1>
                <div class="button">
                    <a href="login.php">Login</a>
                </div>
            </div>
        </div>
    </section>

    <!-- MyCave? -->
    <section id="about">
        <div class="about-section">
            <div class="inner-container">
                <h2> Bienvenue sur My Cave!</h2>
                <p class="text">
                    Vous en avez assez d'oublier le nom d'un vin que vous avez dégusté lors d'un repas de famille, ou lors d'un rendez vous au restaurant? Impossible de vous souvenir des vins de votre cave?<br> Voici <span>My Cave</span>, votre cave online! Désormais vous pourrez répertorier vos vins préférés sur votre smartphone grace a MyCave.
                    N'attendez plus un seconde, et gerez votre cave simplement depuis votre téléphone en vous <a href="signup.php"> inscrivant ici</a> !
                </p>
            </div>
        </div>
    </section>

    <!-- Citations -->
    <section id='quote'>
        <div class="content">
            <p>"Les Français sont si fiers de leurs vins qu'ils ont donné le nom d'un grand cru a certaines de leurs villes."</p>
            <br>
            <h4>- Oscar Wilde -</h4>
        </div>

    </section>
    <!-- Liste des vins -->
    <section id="winesList">
        <div class="content">
            <div>
                <h2 class="section-title">Liste des vins</h2>
            </div>
            <section class="products">
                <?php
                displayAllWines()
                ?>
            </section>
        </div>
    </section>

    <!-- Footer -->
    <footer>

        <div id="goTop">
            <a href="#home"><button class="goTop fas fa-arrow-up"></button></a>
        </div>

        <div class="content">
            <div class="copyright">
                <p>MyCave &copy; Emmanuel SICARD 2020</p>
            </div>
            <div class="sm">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin-in"></a>
            </div>
        </div>

    </footer>


</body>

</html>

