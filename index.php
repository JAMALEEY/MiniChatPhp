<?php
// connecter la base de deonnée
include_once('database.php');
//selectionner les message dans la base de donnée
$query = "SELECT * FROM messages ORDER BY temps DESC LIMIT 10";
//  in case of foreach
$results = mysqli_query($link, $query);
// in case of while
$messages = mysqli_fetch_assoc($results);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat box</title>

    <style>
        <?php include "style.css" ?>
    </style>
</head>

<body>
    <main>

        <div class="messages container">
            <ul>
                <?php foreach ($results as $row) : ?>

                    <li class="message"><span>
                            <?php echo $row["temps"];  ?> - </span>
                        <?php echo $row["utilisateur"];  ?> :
                        <?php echo $row["contenu_message"];  ?>

                    </li>

                <?php endforeach ?>
            </ul>
        </div>
        <div class=" container">
            <form class="comment" action="traitement.php" method="post">
                <!-- <input type="text" name="utilisateur" id="utilisateur" placeholder="Saisir votre username" class="uti"> -->
                <input type="text" name="message" id="message" placeholder="Saisir votre message">
                <input type="submit" class="envoyer" name="envoyer" value="Envoyer" style="position: absolute; top: 857px; RIGHT: 275px;">
            </form>
        </div>
    </main>

</body>

</html>