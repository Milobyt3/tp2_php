<?php session_start()?>
<h1>Liste des Articles</h1>
<?php 
    if(isset($_SESSION["user"])){
        echo "<h2>Bonjour " . $_SESSION["user"] . " bienvenue sur le blogue!</h2>";
    }
?>
<form action="index.php" method="POST">
    <input type="text" name="search" placeholder="search article"/>
    <input type="hidden" name="commande" value="searchPage"/>
    <input type="submit" value="Search"/>
</form>
<?php
    while($rangee = mysqli_fetch_assoc($donnees["articles"])){
        echo "<h3>" . $rangee["titre"] . "</h3>";
        if(isset($_SESSION["user"]) && $rangee["idAuteur"] == $_SESSION["user"]){
            echo "<small><a href=index.php?commande=Modify&id=" . $rangee["id"] . ">Modify Article</a></small>";
        }
        echo "<p>" . $rangee["texte"] . "</p>";
        echo "<small>" . $rangee["idAuteur"] . "</small>";
    }
?>

<br>
<br>
<?php
    if(!isset($_SESSION["user"])){
        echo "<a href=index.php?commande=signIn>Sign In</a>";
    } else {
        echo "<a href=index.php?commande=logOut>Log Out</a>";
        echo "<div><a href=index.php?commande=createArticle>Add Article</a></div>";
    }
?>