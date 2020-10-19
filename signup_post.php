<?php 
    $page ='signup';
    require ('inc/connect.php');
   


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