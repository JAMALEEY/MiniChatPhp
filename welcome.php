<?php
session_start();
include_once('database.php');

if (isset($_POST['submit'])) {
    $prenomsu = mysqli_real_escape_string($link, $_POST['username']);
    $mdpssu = mysqli_real_escape_string($link, $_POST['password']);


    if ((empty($prenomsu)) && (empty($password))) {
        header("location: welcome.php?identifianterror=Veuillez rentrer votre pseudo et MDPS S.V.P");
    } elseif (empty($prenomsu)) {
        header("location: welcome.php?usernameerror=Veuillez rentrer votre pseudo S.V.P ...");
    } elseif (empty($mdpssu)) {
        header("location: welcome.php?passworderror=Veuillez rentrer votre MDPS S.V.P ...");
    } else {

        $password = md5($mdpssu);
        $query = "SELECT * FROM `register` WHERE prenom='$prenomsu'AND password_id='$password'";

        $results = mysqli_query($link, $query);
        if (mysqli_num_rows($results) > 0) {
            header('Location: ./index.php');
            // $_SESSION['prenom'] = $prenomsu;
            // $_SESSION['success'] = "You are now logged in";
        } else {
            header("location: welcome.php?usernameerror= Incorrect Pseudo et/ou Mot De Passe  ...");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/welcome.css">
</head>

<body>
    <!-- <div class="adslayhsn3wan">
        <img src="https://web.archive.org/web/20000510013226im_/http://ad.caramail.com/pub/FCT04.gif" alt="" >
    </div> -->
    <div class="loginsection">
        <div class="middlecontainer">
            <div class="middle">

                <a href="./register.php">
                    <img src="creer.png" alt="creez votre compte" class="creer">

                </a>

                <img src="new.png" alt="new ? votre compte" class="new">
                <img src="middle.png" alt="logintemplate">
            </div>
        </div>

    </div>


    <div class="di">
        <div class="didi">

        </div>
    </div>
    <div class="imgcontainer">
        <div class="img">
        </div>
    </div>
    <div class="leftdivcontainer">
        <div class="leftdiv">
        </div>
    </div>
    <div class="footcontainer">
        <div class="demicerclecontainer">
            <div class="demicercle">
            </div>
        </div>
    </div>



    <form method="POST" class="form">
        <div style="display:flex; flex-direction: row; justify-content: center; align-items: center; margin:20px">
            <label for="username" style="font-weight: bold;  font-size:20px" align=" RIGHT">Compte:</label>
            <input name="username" />
            <div style="position: absolute;
        top: 165px;">
                <?php
                if (isset($_GET['usernameerror'])) {
                    echo $_GET['usernameerror'];
                }
                ?>
            </div>
        </div>
        <div style="display:flex; flex-direction: row; justify-content: center; align-items: center; margin:20px">
            <label for="username" style="font-weight: bold; font-size:20px" align="RIGHT">Mot de passe:</label>
            <input type="password" name="password">
            </dv>


        </div>

        <input type="submit" name="submit" value="Entrer" style="font-weight: bold; margin:20px ">
        <div style="position: absolute;
        top: 165px;">
            <?php
            if (isset($_GET['passworderror'])) {
                echo $_GET['passworderror'];
            }
            ?>
            <div style="position: absolute;
        top: 15px;">
                <?php
                if (isset($_GET['identifianterror'])) {
                    echo $_GET['identifianterror'];
                }
                ?>
    </form>
</body>

</html>