<?php 
    require ('inc/connect.php');
    require ('inc/functions.php');
    require ('assets/head.php');    
    include ('assets/nav.php');  
    $user_id = $_SESSION['id'];
    $member_id = ($_GET['id']);


    //requete de suppression
            $sth =$db->prepare("DELETE FROM users WHERE id =  $member_id");
            $sth->execute(); 

?>
    
    
    <div class="container">
       
        <div class="row">
            <div class="col-md-12 text-center"> <?php
        echo '<div class="alert">
                <p> Article supprimé!</p>                    
             </div>';
        ?> <div class="row">
        <div >
            <a class="btn" href="profile.php">Retour</a>                  
        </div>            
    </div>        
        </div>       
    </div>


