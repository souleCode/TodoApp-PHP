<?php 
    if(isset($_POST['title'])){
        require '../config.php';
        $title = $_POST['title'];
        if(empty($title)){
            header('Location:../index.php?mess=error');
        }
        else{
            $insert ="INSERT INTO taches(title) VALUES(?)";
            $requete = $connexion->prepare($insert);
            $sesult= $requete->execute([$title]);
          if($result){
            header('Location:../index.php?mess=error');
          }else{
            header('Location:../index.php');
          }
          $connexion=null;
          exit();
        }
    }
    header('Location:../index.php?mess=error');
?>