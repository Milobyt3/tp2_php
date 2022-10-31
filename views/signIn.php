<?php 
    session_start();
?>

<h1>Sign In</h1>

<form action="index.php" method="POST">
<label for="username">username :</label>
<input id="username" type="text" name="username">
<br>
<label for="password">password :</label>
<input id="password" type="text" name="password">
<br>
<input type="hidden" name="commande" value="Auth">
<input type="submit" value="Login">
</form>
<br>
<?php 
    if(isset($donnees["messageErreur"]))
        echo "<p>" . $donnees["messageErreur"] . "</p>";
?>
<br>
<br>
<a href="index.php?commande=Accueil">Go back</a>