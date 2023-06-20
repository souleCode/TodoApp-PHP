<?php 
    if(isset($_POST['id'])){
        require '../config.php';
        $id = $_POST['id'];
        if(empty($id)){
            echo 0;
        }
        else{
            $insert ="DELETE FROM taches WHERE id=?";
            $requete = $connexion->prepare($insert);
            $sesult= $requete->execute([$id]);
          if($result){
            echo 1;
          }else{
           echo 0;
          }
          $connexion=null;
          exit();
        }
    }
else{
    header('Location:../index.php?mess=error');
    }
?>