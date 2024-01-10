<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Détails</title>
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
            <a href="Créateur.php"><span class="material-symbols-outlined">edit</span><br>Editeur</a>
            <a href="modifier.php"><span class="material-symbols-outlined">app_registration</span><br>modifier</a>
        </nav>
        <h1>Détail du post !</h1>
    </header>
    <main>
        <?php include("BDD.php");
        if (isset($_POST["surnom"]) && isset($_POST["commentaire"])) {
            $date = date("Y-m-d H-i-s");
            $requete = "INSERT INTO comment (Nickname, Contents, CreationTimestamp, Post_Id) VALUES (:surnom, :commentaire, :datetime, :postid)";
            $ex_requete = $pdo->prepare($requete);
            $ex_requete->bindParam(":surnom", $_POST["surnom"]);
            $ex_requete->bindParam(":commentaire", $_POST["commentaire"]);
            $ex_requete->bindParam(":datetime", $date);
            $ex_requete->bindParam(":postid", $_GET["Idpost"]);
            $ex_requete->execute();
            header("Location: details.php?Idpost=" . $_GET["Idpost"]);
            exit();
        }
        $Idpost = $_GET["Idpost"];
        $requete = "SELECT Contents, FirstName, LastName, post.Id, category.Name, CreationTimestamp FROM post LEFT JOIN author ON post.Author_Id =author.Id LEFT JOIN category ON post.Category_Id = category.Id WHERE post.Id = :Id ";
        $ex_requete = $pdo->prepare($requete);
        $ex_requete->bindParam(":Id", $Idpost);
        $ex_requete->execute();
        $reponse = $ex_requete->fetch();
        echo "<p class='bordure'>" . $reponse['FirstName'] . " " . $reponse['LastName'] . " " . $reponse['Name'] . " " . $reponse['CreationTimestamp'] . "<br> " . $reponse['Contents'] . "</p>";
        ?>
        <form method="post">
            <fieldset>
                <legend>Ajouter un commentaire</legend><br>
                <p><label for="Nickname">Surnom :</label>
                <input type="text" name="surnom" id="surnom" size="30" maxlength="20"></p>
                <label for="commentaire">Votre commentaire :</label>
                <input type="textarea" name="commentaire" id="commentaire">
                <br>
                <input type="submit" value="Publier">
            </fieldset>
            <?php
            $requete = "SELECT Nickname, comment.Contents, comment.CreationTimestamp FROM comment LEFT JOIN post ON comment.Post_Id = post.Id WHERE post.Id = :Id ";
            $ex_requete = $pdo->prepare($requete);
            $ex_requete->bindParam(":Id", $Idpost);
            $ex_requete->execute();
            $reponse = $ex_requete->fetchALL();
            foreach ($reponse as $valeur) {
                echo "<p class='bordure'>" . $valeur['Nickname'] . " " . $valeur['CreationTimestamp'] . "<br> " . $valeur['Contents'] . "</p>";
            }
            ?>
        </form>
    </main>
    <footer>
        <p>&copy;</p>
    </footer>
</body>

</html>