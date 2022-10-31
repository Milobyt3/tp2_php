<?php 
    session_start();
?>

<form action="index.php?" method="POST">
<label for="titre">titre :</label>
<input id="titre" type="text" name="titre"/>
<br>
<br>
<label for="texte">texte :</label>
<textarea name="texte" id="text" cols="30" rows="10"></textarea>
<br>
<br>
<input type="hidden" name="commande" value="insertArticle"/>
<input type="hidden" name="idAuteur" value="<?= $_SESSION["user"] ?>"/>
<input type="submit" value="Create"/>
</form>
<br>
<a href="index.php?commande=Accueil">Go back</a>

<?php 
    if(isset($donnees["messageErreur"]))
        echo "<p>" . $donnees["messageErreur"] . "</p>";
?>