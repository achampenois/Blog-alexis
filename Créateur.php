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
        </nav>
        <h1>Administrateur</h1>
    </header>
    <main>
        <form method="post">
            <fieldset>
                <legend>Ajouter un post</legend><br>
                <p><label for="Nickname">Surnom :</label>
                    <input type="text" name="surnom" id="surnom" size="30" maxlength="20">
                </p>
                <p><label for="Categorie">Categorie :</label>
                    <select id="" name="Categorie">
                        <?php include("BDD.php");
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
                <input type="submit" value="Publier">
            </fieldset>
        </form>
        <?php
        if ($_SERVER["REQUEST METHOD"] == "POST" && isset($_POST["ajouter post"])) {
            $surnom = $_POST["surnom"];
            $categorie = $_POST["categorie"];
            $post = $_POST["post"];
            $ex_requete = $pdo->prepare("INSERT INTO post (Title, Contents, CreationTimestamp, Author_Id, Category_Id) VALUES (:titre, :commentaire, :datetime, :auteurid, :categorie)");
            $ex_requete->bindParam(':titre', $titre);
            $ex_requete->bindParam(':commentaire', $commentaire);
            $ex_requete->bindParam(':datetime', $date);
            $ex_requete->bindParam(':auteurid', $auteur);
            $ex_requete->bindParam(':categorie', $catego);
            $ex_requete->execute();
        }
        ?>
        <form method="post">
            <fieldset>
                <legend>Supprimer un post</legend><br>
                <label for="post">Post à supprimer :</label>
                <select id="" name="post">
                    <?php
                    $requete = $requete = "SELECT Contents, FirstName, LastName, post.Id, category.Name, CreationTimestamp, Title FROM post LEFT JOIN author ON post.Author_Id =author.Id LEFT JOIN category ON post.Category_Id = category.Id ";
                    $ex_requete = $pdo->prepare($requete);
                    $ex_requete->execute();
                    $reponse = $ex_requete->fetchAll();
                    foreach ($reponse as $post) {
                        echo "<option value='" . $post['Id'] . "'>" . $post['Title'] . "</option>";
                    }
                    ?>
                </select><br>
                <input type="submit" name="supprimer post" value="Supprimer post">
            </fieldset>
        </form>
        <?php
        if ($_SERVER["REQUEST METHOD"] == "POST" && isset($_POST["supprimer post"])) {
            $post_id = $_POST["post_id"];
            $ex_requete = $pdo->prepare("DELETE FROM post WHERE id = :post.id");
            $ex_requete->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $ex_requete->execute();
        }
        ?>
        <form method="post">
            <fieldset>
                <legend>Modifier un post</legend><br>
                <label for="post">Post à modifier :</label>
                <select id="" name="post">
                    <?php
                    $requete = $requete = "SELECT Contents, FirstName, LastName, post.Id, category.Name, CreationTimestamp, Title FROM post LEFT JOIN author ON post.Author_Id =author.Id LEFT JOIN category ON post.Category_Id = category.Id ";
                    $ex_requete = $pdo->prepare($requete);
                    $ex_requete->execute();
                    $reponse = $ex_requete->fetchAll();
                    foreach ($reponse as $post) {
                        echo "<option value='" . $post['Id'] . "'>" . $post['Title'] . "</option>";
                    }
                    ?>
                </select><br>
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
        if ($_SERVER["REQUEST METHOD"] == "POST" && isset($_POST["modifier post"])) {
            $post_id = $_POST["post_id"];
            $nouveau_post = $_POST["nouveau_post"];
            $ex_requete = $pdo->prepare("UPDATE post SET post = :nouveau_post WHERE id = :post_id");
            $ex_requete->bindParam(':nouveau_post', $nouveau_post);
            $ex_requete->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $ex_requete->execute();
        }
        ?>
    </main>
    <footer>
        <p>&copy;</p>
    </footer>
</body>

</html>