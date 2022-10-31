<?php
    while($rangee = mysqli_fetch_assoc($donnees["search"])){
        echo "<h3>" . $rangee["titre"] . "</h3>";
        echo "<p>" . $rangee["texte"] . "</p>";
        echo "<small>" . $rangee["idAuteur"] . "</small>";
    }
?>