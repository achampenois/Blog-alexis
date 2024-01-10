<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Accueil</title>
        <link rel="stylesheet" href="styleB.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
<body>
    <header>
        <nav class="block">
            <a href="Créateur.php"><span class="material-symbols-outlined">edit</span><br>Editeur</a>
        </nav>
        <h1>Tout les post !</h1>
    </header> 
    <main>
        <?php ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
         include("BDD.php");
        $requete = "SELECT Contents, FirstName, LastName, post.Id, category.Name, CreationTimestamp, Title FROM post LEFT JOIN author ON post.Author_Id =author.Id LEFT JOIN category ON post.Category_Id = category.Id "; 
        $ex_requete = $pdo -> prepare($requete); 
        $ex_requete -> execute(); 
        $reponse = $ex_requete -> fetchAll();
        foreach($reponse as $row){
            echo"<a href='details.php?Idpost=".$row['Id']."'><p class='bordure'>".$row['FirstName']." ".$row['LastName']." ".$row['Title']."<br> ".substr($row['Contents'], 0, 100)."</p></a>" ;
        }
        ?>
    </main>
    <footer>
    <p>&copy;</p> 
    </footer>   
</body>
</html>