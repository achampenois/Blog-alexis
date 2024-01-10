<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Créateur</title>
    <link rel="stylesheet" href="styleB.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <header>
        <nav class="block">
            <a href="Accueil.php"><span class="material-symbols-outlined">home</span><br>Accueil</a>
            <a href="details.php"><span class="material-symbols-outlined">view_timeline</span><br>Détails</a>
            <a href="modifier.php"><span class="material-symbols-outlined">app_registration</span><br>modifier</a>
        </nav>
        <h1>Administrateur</h1>
    </header>
    <main>
        <form method="post">
            <fieldset>
                <legend>Ajouter un post</legend><br>
                <p><label for="Nomcomplet">Auteur :</label>
                <select id="" name="Nomcomplet">
                        <?php include("BDD.php");
                        $requete = "SELECT FirstName, LastName, Id FROM author ";
                        $ex_requete = $pdo->prepare($requete);
                        $ex_requete->execute();
                        $reponse = $ex_requete->fetchAll();
                        foreach ($reponse as $nom) {
                            echo "<option value='" . $nom['Id'] . "'>".$nom['FirstName']." ".$nom['LastName']."</option>";
                        }
                        ?>
                    </select>
                </p>
                <p><label for="Titre">Titre :</label>
                <input type="text" name="Titre" id="">
                </p>
                <p><label for="Categorie">Categorie :</label>
                    <select id="" name="Categorie">
                        <?php
                        $requete = "SELECT * FROM category ";
                        $ex_requete = $pdo->prepare($requete);
                        $ex_requete->execute();
                        $reponse = $ex_requete->fetchAll();
                        foreach ($reponse as $categorie) {
                            echo "<option value='" . $categorie['Id'] . "'>" . $categorie['Name'] . "</option>";
                        }
                        ?>
                    </select>
                </p>
                <label for="post">Votre post :</label>
                <input type="textarea" name="post" id="post">
                <br>
                <input type="submit" value="Publier" name="Publier">
            </fieldset>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Publier"])) {
            $auteur = $_POST["Nomcomplet"];
            $titre = $_POST["Titre"];
            $categorie = $_POST["Categorie"];
            $post = $_POST["post"];
            $date = date("Y-m-d H-i-s");
            $ex_requete = $pdo->prepare("INSERT INTO post (Title, Contents, CreationTimestamp, Author_Id, Category_Id) VALUES (:titre, :commentaire, :datetime, :auteurid, :categorie)");
            $ex_requete->bindParam(':titre', $titre);
            $ex_requete->bindParam(':commentaire', $post);
            $ex_requete->bindParam(':datetime', $date);
            $ex_requete->bindParam(':auteurid', $auteur);
            $ex_requete->bindParam(':categorie', $categorie);
            $ex_requete->execute();
            header("Location: Accueil.php");
            exit();
        }
        ?>
            <form method="post">
            <fieldset>
                <legend>Supprimer un post</legend><br>
                <label for="post">Post à supprimer :</label>
                <select id="" name="post_id">
                    <?php
                    $requete = $requete = "SELECT Title, Id FROM post ";
                    $ex_requete = $pdo->prepare($requete);
                    $ex_requete->execute();
                    $reponse = $ex_requete->fetchAll();
                    foreach ($reponse as $post) {
                        echo "<option value='" . $post['Id'] . "'>" . $post['Title'] . "</option>";
                    }
                    ?>
                </select><br>
                <input type="submit" name="supprimer" value="supprimer post">
            </fieldset>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["supprimer"])) {
            $post_id = $_POST["post_id"];
            $ex_requete = $pdo->prepare("DELETE FROM post WHERE Id = :post_id");
            $ex_requete->bindParam(':post_id', $post_id);
            $ex_requete->execute();
            header("Location: Accueil.php");
            exit();
        }
        ?>
    </main>
    <footer>
        <p>&copy;</p>
    </footer>
</body>

</html>
