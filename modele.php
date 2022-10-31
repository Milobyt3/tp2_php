<?php 
    /*
        modele.php est le fichier qui représente notre modèle dans notre architecture MVC. C'est donc dans ce fichier que nous retrouverons TOUTES nos requêtes SQL sans AUCUNE EXCEPTION. C'est aussi ici que se trouvera LA connexion à la base de données ET les informations de connexion relatives à celle-ci (qui pourraient être dans un fichier de configuration séparé... voir les frameworks).

    */

    //à modifier pour webdev éventuellement...
    define("SERVER", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "root");
    define("DBNAME", "blog");
   
    function connectDB()
    {
        //se connecter à la base de données
        $c = mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME);

        if(!$c)
        {
            die("Erreur de connexion. MySQLI : " . mysqli_connect_error());
        }

        //s'assurer que la connexion traite le utf8
        mysqli_query($c, "SET NAMES 'utf8'");

        return $c;
    }

    $connexion = connectDB();

    function fetch_articles(){
        global $connexion;
        $requete = "SELECT * FROM articles ORDER BY id DESC";

        $resultats = mysqli_query($connexion, $requete);

        return $resultats;
    }

    function fetch_articles_by_search($search){
        global $connexion;
        $requete = "SELECT * FROM articles WHERE titre LIKE '%$search%' OR texte LIKE '%$search%'";

        $resultats = mysqli_query($connexion, $requete);

        return $resultats;
    }

    function login($username, $password)
    {
        global $connexion;
        $requete = "SELECT * FROM usagers WHERE username=? AND password=?";

        $reqPrep = mysqli_prepare($connexion, $requete);
 
        if($reqPrep)
        {
            //3. faire le lien entre les paramètres envoyés par l'usager et les ? dans la requete
            mysqli_stmt_bind_param($reqPrep, "ss", $username, $password);
            //4. exécuter la requête préparée et retourner le résultat...
            mysqli_stmt_execute($reqPrep);
            $resultats = mysqli_stmt_get_result($reqPrep);

            //s'il y a un usager avec cette combinaison, retourner le username, sinon return false
            if(mysqli_num_rows($resultats) > 0)
            {
                $rangee = mysqli_fetch_assoc($resultats);
                return $rangee["username"];
            }
            else
            {
                return false;
            }
        }
    }

    function modification($titre, $texte, $idArticle){
        global $connexion;

        $requete = "UPDATE articles SET titre = '$titre', texte = '$texte' WHERE id = $idArticle";

        $resultat = mysqli_query($connexion, $requete);

        return $resultat;
    }

    function fetch_article_to_modify($id){
        global $connexion;
        $requete = "SELECT * FROM articles WHERE id = $id";

        $resultat = mysqli_query($connexion, $requete);
        
        if($resultat){
            $resultat = mysqli_fetch_assoc($resultat);
            return $resultat;
        } else{
            die("Erreur de requête préparée...");
        }
    }

    function delete_article($id){
        global $connexion;
        $requete = "DELETE FROM articles WHERE id = $id";

        $resultat = mysqli_query($connexion, $requete);

        return $resultat;
    }

    function insert_article($titre, $texte, $idAuteur){
        global $connexion;
        $requete = "INSERT INTO articles(idAuteur, titre, texte) VALUES('$idAuteur', '$titre', '$texte')";

        $resultat = mysqli_query($connexion, $requete);

        return $resultat;
    }
?>