<?php
$page = 'signup';
require('inc/connect.php');
require('assets/head.php');
include('assets/nav.php');



if(isset($_POST['submit-signup'])){
    $user_email = htmlspecialchars($_POST['user_email_signup']);
    $user_firstname = htmlspecialchars($_POST['user_firstname_signup']);
    $user_name = htmlspecialchars($_POST['user_lastname_signup']);        
    $user_pass = htmlspecialchars($_POST['user_password_signup']);
    $user_pass2 = htmlspecialchars($_POST['user_password_2_signup']);

    if($sql = $db->query("SELECT * FROM users WHERE email = '$user_email'")){
        $compteur = $sql->rowCount();
        if($compteur != 0){
            $message = "<div class ='alert alert-danger'> Il y a déja un compte possédant cet e-mail </div>";
        }elseif(!empty($user_email) && !empty($user_pass)){
            if($user_pass == $user_pass2){
                $user_pass = password_hash($user_pass, PASSWORD_DEFAULT);
                $sth = $db->prepare("INSERT INTO users (email, password, firstname, lastname) VALUES (:email, :password, :firstname, :lastname)");

                $sth->bindValue(':email',$user_email);
                $sth->bindValue(':password',$user_pass);
                $sth->bindValue(':firstname',$user_firstname);
                $sth->bindValue(':lastname',$user_name);

                


                if($sth->execute()){
                    $_SESSION['id'] = $db->lastInsertId();
                    $_SESSION['email'] = $user_email;
                    $_SESSION['rank'] = 0;
                    
                    $message = "<div class ='alert alert-success'> Votre compte a bien été crée! Accedez a votre <a href='profile.php'>compte ici !</a></div>";
                    
                }
            }else{
                $message = "<div class ='alert alert-danger'> Les mots de passes ne concordent pas </div>";
            }
        }else{
            $message = "<div class ='alert alert-danger'> Veuillez remplir les champs correspondants </div>";
        }
}else{
    $message = "<div class ='alert alert-danger'> Une erreur vient de se produire.</div>";
}
}

?>


?>
<section id="signup">
    <h2 class="section-title">Sign-up - Inscription :</h2>
    <div class="content">    
        <form class="login-form" action="" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST">
            <div class="form-group ">
                <label for="exampleInputEmail2">Email</label>
                <input type="text" name="user_email_signup" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Entrez votre Email...">
            </div>
            <div class="form-group ">
                <label for="exampleInputName">Prenom</label>
                <input type="text" name="user_firstname_signup" class="form-control" id="exampleInputName" aria-describedby="nameHelp" placeholder="Entrez votre prennom...">
            </div>
            <div class="form-group ">
                <label for="exampleInputName">Nom</label>
                <input type="text" name="user_lastname_signup" class="form-control" id="exampleInputName" aria-describedby="nameHelp" placeholder="Entrez votre nom...">
            </div>
            <div class="form-group ">
                <label for="exampleInputPassword2">Password</label>
                <input type="password" name="user_password_signup" class="form-control" id="exampleInputPassword2" placeholder="Entrez votre mot de passe.">
            </div>
            <div class="form-group ">
                <label for="exampleInputPassword3">Password</label>
                <input type="password" name="user_password_2_signup" class="form-control" id="exampleInputPassword3" placeholder="Confirmation du mot de passe.">
            </div>
            <button type="submit" name="submit-signup">Sign Up</button>
        </form>
        <br>
        <div class="back">
            <a class="btn-back" href="index.php">Retour </a>
        </div>
    </div>
    <?php if (isset($message)) {
        echo "<div'> " . $message . " </p>";
    } ?>

     
</section>


<?php
require('assets/footer.php');
?>