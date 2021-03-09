<?php
include_once('database.php');
if (isset($_POST['envoyer'])) {
    $a = ($_POST['utilisateur']);
    $b = ($_POST['message']);
    $c = date("Y-m-d H:i:s");
$sql = mysqli_query($link, "INSERT INTO messages (utilisateur, contenu_message, temps) VALUES ('$a','$b', '$c')
");
    header('Location: ./index.php');
}
// header('Location: ./index.php');
// si le message est envoyé correctement
    // récupérer les données dans des variables
    // si les valeurs récupéré sont vides
        //se redériger ver la page index avec le message d'erreur sauvgarde dans un query string
    // si non afficher préparer la requête d'insertion
    // vérifier qu'elle s'execute correctement
    // s'il y a une erreur afficher le message puis arrêter le programme avec la "die"
    // si non se redériger à la page index qui devera insérer le message nouvellement inséré



