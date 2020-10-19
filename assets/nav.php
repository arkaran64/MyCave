<nav class="navbarII">
  <div class="content">
    <img src="assets/img/logo.png" alt="logo" class="logo">
    <button class="menu-toggler">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <div class="navbar-menu">
      <a href="index.php#home">Accueil</a>
      <a href="index.php#about">MyCave?</a>
      <a href="index.php#winesList">Liste des vins</a>
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