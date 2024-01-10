<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Modifier</title>
    <link rel="stylesheet" href="styleB.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
            <a href="Créateur.php"><span class="material-symbols-outlined">edit</span><br>Editeur</a>
        </nav>
        <h1>Administrateur</h1>
    </header>
    <main>
        <form method="post">
            <fieldset>
                <legend>Modifier un post</legend><br>
                <label for="post">Post à modifier :</label>
                <select id="" name="post">
                    <?php include("BDD.php");
                    $requete = $requete = "SELECT Id, Title FROM post";
                    $ex_requete = $pdo->prepare($requete);
                    $ex_requete->execute();
                    $reponse = $ex_requete->fetchAll();
                    foreach ($reponse as $post) {
                        echo "<option value='" . $post['Id'] . "'>" . $post['Title'] . "</option>";
                    }
                    ?>
                </select><br>
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
                <label for="nouveau post">Nouveau post :</label>
                <input type="textarea" name="nouveau post" id="nouveau post"><br>
                <input type="submit" name="modifier post" value="Modifier post">
            </fieldset>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier_post"])) {
            $post_id = $_POST["post"];
            $nouveau_post = $_POST["nouveau_post"];
            $titre = $_POST["Titre"];
            $categorie = $_POST["Categorie"];
            $ex_requete = $pdo->prepare("UPDATE post SET Title = :titre, Contents = :nouveau_post, Category_Id = :categorie WHERE Id = :post_id");
            $ex_requete->bindParam(':titre', $titre);
            $ex_requete->bindParam(':nouveau_post', $nouveau_post);
            $ex_requete->bindParam(':categorie', $categorie);
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