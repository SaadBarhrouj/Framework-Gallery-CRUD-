<?php
//on etablie la connexion a la base de donnes

$con=mysqli_connect("localhost","root","","min_crud");
//verification de la connexion
if (!$con){
    die('erreur:'.mysqli_connect_error());

}



?>