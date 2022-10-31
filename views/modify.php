<?php 
    session_start();
    $modif = $donnees["modif"];
?>

<form action="index.php" method="POST">
<label for="titre">titre :</label>
<input id="titre" type="text" name="titre" value="<?= $modif["titre"] ?>"/>
<br>
<br>
<label for="texte">texte :</label>
<textarea name="texte" id="texte" cols="30" rows="10"><?= $modif["texte"] ?></textarea>
<br>
<br>
<input type="hidden" name="commande" value="modification">
<input type="hidden" name="idArticle" value="<?= $modif["id"] ?>">
<input type="submit" value="Modify">
</form>
<br>
<a href="index.php?commande=delete&id=<?= $modif["id"] ?>">delete</a>
<a href="index.php?commande=Accueil>">Go back</a>

<?php 
    if(isset($donnees["messageErreur"]))
        echo "<p>" . $donnees["messageErreur"] . "</p>";
?>