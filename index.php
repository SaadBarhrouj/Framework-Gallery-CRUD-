<?php
// inclure la page de connexion
include_once("connection_bdd.php");

// verifier que le donnees sont envoyees
if (isset($_POST['send'])){
    // verifiez que l'image et le texte ont ete choisies
    if (!empty($_FILES['image'])&& isset($_POST['text'])&& $_POST['text']!=""){

        // on recupere d'abord le nom de l'image
           $img_nom=$_FILES['image']['name'];

           //nous definissons un nom temporaire
           $tmp_nom=$_FILES['image']['tmp_name'];

           //on recupere l'heure actuelle
           $time=time();

           // on rnome l'image on utilisant cette formule :heure+nom de l'image
           $nouveau_nom_img=$time.$img_nom;

           // on eplace l'image dans un dossiers apple images
           $deplacer_img=move_uploaded_file($tmp_nom,"images/".$nouveau_nom_img);

           if($deplacer_img){
            // si l'image a ete mis dans le dossier
            // inseron le texte et le nom de l'image dans la base de donnees
            $text=$_POST['test'];
            $req=mysqli_query($con, "INSERT INTO image VALUES (NULL,'$nouveau_nom_img','$text')");
            // verifier que la requete fonctionne
            if ($req){
                // si oui faire une redirection vers la page liste.php
                header("location:liste.php");

            }else{
                // si non
                $message="echec de l'ajout de l'image";

            }
           }else {
            // si non 
            $message = "veuillez choisir une image avec une taille inferieur a 1Mo!!";
        }

    }else {
        $message ="veuillez remplir tous les champs";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>mini crud</title>
</head>
<body>
    
    <a href="liste.php" class="link">liste des photos</a>
    <p class="error">
        <?php 
        if(isset($message)) echo $message;
        ?>
    </p>
    
    <form action="" method="POST">
        <label >ajouter une photo</label>
        <input type="file" name="image">
        <label >Description</label>
        <textarea name="text" cols="30" rows="10"></textarea>
        <input type="submit" value="ajouter" name="send">
    </form>
</body>
</html>