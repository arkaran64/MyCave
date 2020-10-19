<?php 
    require ('inc/connect.php');
    require ('inc/functions.php');
    require ('assets/head.php');    
    include ('assets/nav.php');
   

    if(isset($_POST['submit']) ){
      
      
        $name = htmlspecialchars($_POST['name']);
        $year = htmlspecialchars($_POST['year']);
        $grapes = htmlspecialchars($_POST['grapes']);
        $country = htmlspecialchars($_POST['country']); 
        $region = htmlspecialchars($_POST['region']);
        $description = htmlspecialchars($_POST['description']);
        $file = $_FILES['img_url'];
        $user_id = $_SESSION['id'];
       
        
        if($file['size'] <= 1000000){

            $valid_ext = array('jpg','jpeg','png','gif');
            $check_ext = strtolower(substr(strrchr($file['name'], '.'),1));
           

            if(in_array($check_ext,$valid_ext)){

                $img_name      = uniqid() . '_' . $file['name'];
                $upload_dir   = "./assets/uploads/";
                $upload_name  = $upload_dir . $img_name;
                $move_result  = move_uploaded_file($file['tmp_name'], $upload_name);  
               


                if($move_result){
            
                    $sth = $db->prepare(" INSERT INTO wines(name, year, grapes, country, region, description, author_article, picture) 
                    VALUES (:name, :year, :grapes, :country, :region, :description, :author_article, :picture)
                    ");

                    $sth->bindValue(':name', $name);
                    $sth->bindValue(':year',$year);
                    $sth->bindValue(':grapes',$grapes);
                    $sth->bindValue(':country',$country);
                    $sth->bindValue(':region',$region);    
                    $sth->bindValue(':description',$description); 
                    $sth->bindValue(':author_article',$user_id);       
                    $sth->bindValue(':picture',$img_name);
                                    
                    $sth->execute();
                    echo "<div class ='col-12 alert alert-success text-center'> Annonce enregistrée :)</div><br>";
                    
                }
            }
        }
    }else{
        echo "<div class ='col-10 alert alert-alert text-center'> une erreur s'est produite, veuillez recommencer la saisie.  </div>" ;
    }

  
  
  ?>