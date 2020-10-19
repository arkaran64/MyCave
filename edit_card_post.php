<?php 
    require ('inc/connect.php');
    require ('inc/functions.php');
    require ('assets/head.php');    
    include ('assets/nav.php');   
    $wine_id = $_POST['wine_id'];
    $user_id = $_SESSION['id'];
    

    if(isset($_POST['submit_mod'])){
       
       
       
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

               $imgname      = uniqid() . '_' . $file['name'];
               $upload_dir   = "./assets/uploads/";
               $upload_name  = $upload_dir . $imgname;
               $move_result  = move_uploaded_file($file['tmp_name'], $upload_name);  
              


               if($move_result){
           
                   $sth = $db->prepare(" UPDATE wines 
                   SET name = :name, year = :year, grapes = :grapes, country = :country, region = :region, description = :description, author_article = :author_article, picture = :picture
                   WHERE id = $wine_id ");

                  
                    $sth->bindValue(':name', $name);
                    $sth->bindValue(':year',$year);
                    $sth->bindValue(':grapes',$grapes);
                    $sth->bindValue(':country',$country);
                    $sth->bindValue(':region',$region);    
                    $sth->bindValue(':description',$description); 
                    $sth->bindValue(':author_article',$user_id);       
                    $sth->bindValue(':picture',$imgname); 

                   $sth->execute();
           
                   echo "<div class ='alert'> Modification enregistrée :)  </div>" ;
               }else{
                   echo "<div  class='alert'> Un problème est survenu !</div>" ;
                   
               }
           }
       }
   }