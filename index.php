<?php 

/* 

    index.php est le CONTRÔLEUR de notre application de type MVC (modulaire).

    TOUTES les requêtes de notre application, sans aucune exception, devront passer en premier par ce fichier. Tous les liens et tous les formulaires auront donc comme destination index.php... avec des paramètres.

    Le coeur du contrôleur sera sa structure décisionnelle qui traite un paramètre que l'on va nommer commande. C'est la valeur de ce paramètre commande qui va déterminer les actions posées par le contrôleur.

    IMPORTANT : Le contrôleur ne contient ni requête SQL, ni HTML/CSS/JS, seulement du PHP.

    Le SQL va strictement dans le modèle. Le HTML va strictement dans les vues.
*/

//réception du paramètre commande, qui peut arriver en GET ou en POST
//et donc nous utiliserons $_POST (qui contient GET ET POST)

if(isset($_REQUEST["commande"])){
    $commande = $_REQUEST["commande"];
} else{
    //ici, on devrait spécifier la commande par défaut, typiquement celle qui mène à votre page d'accueil
    $commande = "Accueil";
}

//inclusion du modèle avec connexion à la BD et accès aux fonctions
require_once("modele.php");
//coeur du contrôleur - structure décisionnelle
switch($commande){   
    case "Accueil":
        $donnees["titre"] = "Liste des articles";
        $donnees["articles"] = fetch_articles();
        require_once("views/header.php");
        require("views/listeArticles.php");
        require_once("views/footer.php");
        break;
    case "signIn":
        $donnees["titre"] = "Sign In";
        require_once("views/header.php");
        require("views/signIn.php");
        require_once("views/footer.php");
        break;
    case "Auth":
        require_once("views/header.php");
        require("views/auth.php");
        require_once("views/footer.php");
        break;
    case "logOut":
        require_once("views/header.php");
        require("views/logOut.php");
        require_once("views/footer.php");
        break;
    case "Modify":
        $donnees["titre"] = "Modify article";
        $donnees["modif"] = fetch_article_to_modify($_GET["id"]); 
        require_once("views/header.php");
        require("views/modify.php");
        require_once("views/footer.php");
        break;
    case "modification":
        if(isset($_POST["titre"], $_POST["texte"])){
            //ici on met la validation des entrées du formulaire
            $titre = trim($_POST["titre"]);
            $texte = trim($_POST["texte"]);
            $idArticle = $_POST["idArticle"];

            if($titre != "" && $texte != ""){
                $update = modification($titre, $texte, $idArticle);
                if($update){
                    header("Location: index.php?commande=Accueil");
                }
            } else{
                $donnees["messageErreur"] = "Veuillez remplir les champs correctement.";
                header("Location: index.php?commande=Modify");
            }
        } else{
            header("Location: index.php?commande=Modify");
        }
        break;
    case "delete":
        delete_article($_GET["id"]);
        header("Location: index.php");
        break;
    case "createArticle":
        $donnees["titre"] = "Create article";
        require_once("views/header.php");
        require("views/addArticle.php");
        require_once("views/footer.php");
        break;
    case "insertArticle":
        if(isset($_POST["titre"], $_POST["texte"], $_POST["idAuteur"])){
            //ici on met la validation des entrées du formulaire
            $titre = trim($_POST["titre"]);
            $texte = trim($_POST["texte"]);
            $idAuteur = trim($_POST["idAuteur"]);
        
            if($titre != "" && $texte != "" && $idAuteur != ""){
                $insert = insert_article($titre, $texte, $idAuteur);
                if($insert){
                    header("Location: index.php?commande=Accueil");
                }
            } else{
                $donnees["messageErreur"] = "Veuillez remplir les champs correctement.";
                header("Location: index.php?commande=createArticle");
            }
        } else{
            header("Location: index.php?commande=createArticle");
        }
        break;
        case "searchPage":
            $donnees["search"] = fetch_articles_by_search($_POST["search"]);
            $donnees["titre"] = "search results";
            require_once("views/header.php");
            require("views/search.php");
            require_once("views/footer.php");
        break;
    default : 
        //action non traitée - commande invalide, redirection
        header("Location: index.php");
        die();
}
?>