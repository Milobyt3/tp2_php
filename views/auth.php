<?php
    session_start();
    if(isset($_POST["username"], $_POST["password"])){
            $nomUsager = login($_POST["username"], $_POST["password"]);
            if($nomUsager)
            {
                //nous sommes authentifiés
                $_SESSION["user"] = $nomUsager;
                header("Location: index.php");
                die();
            }
            else 
            {
                $donnees["messageErreur"] = "Mauvaise combinaison username / password.";
                header("Location: index.php?commande=logIn");
                die();
            }
        }
?>