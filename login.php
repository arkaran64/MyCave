<?php
$page = 'login';
require('inc/connect.php');
require('assets/head.php');
include('assets/nav.php');

if (isset($_POST['submit-login'])) {
    $user_email = htmlspecialchars($_POST['user_email']);
    $user_pass = htmlspecialchars($_POST['user_password']);
    $sql = $db->query("SELECT * FROM users WHERE email = '$user_email'");
    if ($row = $sql->fetch()) {
        $db_id = $row['id'];
        $db_email = $row['email'];
        $db_pass = $row['password'];
        $db_rank = $row['rank'];

        if (password_verify($user_pass, $db_pass)) {
            $_SESSION['id'] = $db_id;
            $_SESSION['email'] = $db_email;
            $_SESSION['rank'] = $db_rank;

            header('Location: profile.php');
            
            $message = "<br><div class ='alert alert-success'><p> Vous êtes bien connectés!</p> <br> - <a href='profile.php?id=<?= $user_id ?>'>Mon compte</a> - </div>";
        } else {
            $message = "<div class ='alert alert-danger'> Mot de passe incorrect.</div>";
        }
    } else {
        $message = "<div class ='alert alert-danger'> Identifiant inconnu.</div>";
    }
}




?>
<section id="login">
    <h2 class="section-title">Login - Connexion :</h2>
    <div class="content">
        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Adresse e-mail</label>
                <br>
                <input type="text" name="user_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez votre mail...">
            </div>
            <br>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="user_password" class="form-control" id="exampleInputPassword1" placeholder="Entrez votre mot de passe...">
            </div>
            <button type="submit" name="submit-login">Login</button>

        </form>
        <br>
        <div class="back">
            <a class="btn-back" href="index.php">Retour </a>
        </div>
    </div>

    <?php if (isset($message)) {
        echo "<div'> " . $message . " </p>";
    } ?>

    </div>

</section>

<?php
require('assets/footer.php');
?>