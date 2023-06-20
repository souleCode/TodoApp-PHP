<?php 
    if(isset($_POST['id'])){
        require '../config.php';
        $id = $_POST['id'];
        if(empty($id)){
            echo "error";
        }
        else{
           $todos= $connexion->prepare("SELECT id,checked FROM taches WHERE id=?");
           $todos->execute([$id]);
            
           $todo = $todo->fetch();
           $uId = $todo['id'];
           $checked= $todo['checked'];

           $uChecked = $checked ? 0 : 1;
           $result =$connexion->query("UPDATE taches SET checked=$uChecked WHERE id=$uId");

          if($result){
            echo $checked;
          }else{
           echo "error";
          }
          $connexion=null;
          exit();
        }
    }else{
    header('Location:../index.php?mess=error');
    }
?>