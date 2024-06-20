<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>liste photos</title>
</head>
<body>
    <section>
        <a href="index.php" class="link">ajouter une photo</a>
       <?php
        // inclure la page de connexion
        include_once("connection_bdd.php");
        // afficher la liste des photos qui sont dans la base de donnes  
        $req=mysqli_query($con,"SELECT * FROM image");
        // verifier que la liste n'est pas vide 
        if(mysqli_num_rows($req)<1){?>
        <p class="vide_message">la liste des photos est vide</p>
        <?php
        }
        while ($row=mysqli_fetch_assoc($req)){
            ?>
            <div class="box">
            <img src="img.jpg" class="img_principale" >
            <div>Rome</div>
            <a href="" class="delete_btn">
                <img src="remove.png" >
            </a>
        </div>
        <?php
        }
        ?>
      
       
       
       
    </section>
</body>
</html>