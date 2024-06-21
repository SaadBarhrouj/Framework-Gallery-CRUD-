<?php 
    //inclure la page de connexion
    include_once "con_bdd.php";
    //verifier que les données sont envoyés
    if(isset($_POST['send'])){
        //verifiez que l'image et le texte ont été choisies
        if(!empty($_FILES['image']) && isset($_POST['text']) && $_POST['text']!= ""){
            
            //On récupère d'abord le nom de l'image
            $img_nom = $_FILES['image']['name'];

            //Nous définissons un nom temporaire
            $tmp_nom = $_FILES['image']['tmp_name'];

            //On récupère l'heure actuelle
            $time = time();

            //On rennomme l'image en utilisant cette formule : heure + nom de l'image (Pour avoir des images uniques)
            $nouveau_nom_img = $time.$img_nom ;

            //on déplace l'image dans un dossier appellé "image_bdd"
            $deplacer_img = move_uploaded_file($tmp_nom,"images/".$nouveau_nom_img);

            if($deplacer_img){
                //si l'image a été mis dans le dossier 
                //insérons le texte et le nom de l'image dans la base de données
                $text = $_POST['text'] ;
                $req = mysqli_query($con , "INSERT INTO images VALUES (NULL ,'$nouveau_nom_img','$text')");
                //verifier que la requête fonctionne
                if($req){
                    //si oui , faire une redirection vers la page liste.php
                    header("location:liste.php") ;
                }else {
                    //si non
                    $message = "Echec de l'ajout de l'image !";
                }
            }else {
                //si non
                $message = "Veuillez choisir une image avec une taille inférieur à 1Mo !";
            }

        }else {
            //si les champs sont vides on affiche un message
            $message = "Veuillez remplir tous les champs !";
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <a href="liste.php" class="link">la liste des frameworks.</a>
    <p class="error">
        <?php 
           //afficher une erreur si la variable message existe
           if(isset($message)) echo $message ;
        ?>
    </p>
    <form action="" method="POST" enctype="multipart/form-data"> 
        <label>  ajouter la photo du framework.</label>
        <input type="file" name="image">
        <label> ajouter la description du framework.</label>
        <textarea name="text" cols="30" rows="10"></textarea>
        <input type="submit" value="Ajouter" name="send">
    </form>
</body>
</html>