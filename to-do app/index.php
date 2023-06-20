<?php
    require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo app</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    
    <div class="main-section">
        <div class="add-section">
            <form action="app/add.php" method="POST" autocomplete="off">
                <?php if(isset($_GET['mess']) && ($_GET['mess'])=="error" ) {?>
                    <input type="text" name ="title" placeholder="This field is required"
                    style="border-color:red"/>
                    <button type ="submit" >Add &nbsp;<span>&#43;</span> </button>
                <?php } else{?>
                    <input type="text" name ="title" placeholder="What do you want to do?" />
                    <button type ="submit" >Add &nbsp;<span>&#43;</span> </button>
                <?php }?>
            </form>
        </div>
        <?php 
            $todo = $connexion->query(" SELECT * FROM taches ORDER BY id DESC ")
        ?>
        <div class="show-todo-section">
            <?php if($todo->rowCount() >0) { ?>
                <div class="empty">
                    <img src="img/téléchargement.png" width="50%"  alt="">
                    <img src="img/checklist.gif" width="35%" alt="">
                </div>
            <?php }?>


             <?php while($todos=$todo->fetch(PDO::FETCH_ASSOC)){ ?>   
            <div class="todo-items">
                <span id ="<?=$todos['id'];?> " name="remove" class="remove-to-do">X</span>
                <?php if($todos['checked']){?>
                    <input type="checkbox" class="check-box" data-todo-id="<?=$todos['id'];?>" checked  />
                    <h2 class ="checked"> <?= $todos['title']  ?></h2>
                <?php } else{?>
                    <input type="checkbox" data-todo-id="<?=$todos['id'];?>" class="check-box"/>
                    <h2> <?= $todos['title']  ?></h2>
                <?php }?>
            
                <small><?=$todos['date_created']?></small>
                <br>
            </div> 
            <?php } ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function(){
        $('.remove-to-do').click(function(){
            const id =$(this).attr('id');

            $.post("app/remove.php",
                {
                    id: id
                },
                (data) => {
                    if(data){
                        $(this).parent().hide(600);
                    }
                }
            );
        });
        
        // $('.check-box').click(function(e){
        //     const id = $(this).attr('data-todo-id');
        //     $.post("app/checked.php", 
        //         {
        //             id: id

        //         },
        //         (data) =>{
        //             if(data !='error'){
        //                 const h2 = $(this).next();
        //                 if(data ==='1'){
        //                     h2.removeClass('checked');

        //                 }
        //                 else{
        //                     h2.addClass('checked');
        //                 }
        //             }
        //         }
        //     );
            
        // });
    });

    $(document).ready(function() {
   $('.check-box').each(function() {
      const id = $(this).attr('data-todo-id');
      const isChecked = localStorage.getItem('todo_' + id) === '1';

      if (isChecked) {
         $(this).prop('checked', true);
         $(this).next().addClass('checked');
      }
   });

   $('.check-box').click(function(e) {
      const checkbox = $(this); // Stocke la référence à l'élément .check-box

      const id = checkbox.attr('data-todo-id');

      $.post("app/checked.php", {
         id: id
      }, function(data) {
         if (data !== 'error') {
            const h2 = checkbox.next(); // Utilise la référence stockée

            if (data === '1') {
               h2.removeClass('checked');
               localStorage.setItem('todo_' + id, '0');
            } else {
               h2.addClass('checked');
               localStorage.setItem('todo_' + id, '1');
            }
         }
      });
   });
});


</script>
</body>
</html>