<?php
session_start();
include_once('database.php');
if (isset($_POST['valider'])) {
    $prenomsu = ($_POST['prenom']);
    $mdpssu = ($_POST['password']);
    $mdpssu2 = ($_POST['password2']);
    $emailsu = ($_POST['email']);

    
    $querry = "SELECT * FROM `register` WHERE user_email = '$emailsu'";
    $querrypseudo = "SELECT * FROM `register` WHERE prenom = '$prenomsu'";

    $sql = mysqli_query($link, $querry);
    $sqlpseudo = mysqli_query($link, $querrypseudo);

    if ((mysqli_num_rows($sql) > 0) && (mysqli_num_rows($sqlpseudo) > 0) && ($mdpssu != $mdpssu2)) {
        header("Location: register.php?Fatalerror");
    }

    // check if email taken
    elseif (mysqli_num_rows($sql) > 0) {
        header("Location: register.php?error=Oups ... Un compte ayant le même E-mail éxiste déja ... ");
    }
    // check if pseudo taken
    elseif ((mysqli_num_rows($sqlpseudo) > 0)) {
        header("Location: register.php?invalidpseudo=Oups ... Pseudo invalid ou déja pris  ... ");
    }   
   // check if same pass
    elseif ((!empty($mdpssu)) && $mdpssu != $mdpssu2) {
        header("Location: register.php?attention=Attention ... Les mots de passe doivent être identiques.... ");
    }
// check if all errors 
 else {
        $password = md5($mdpssu);
        $insertquerry = "INSERT INTO register (prenom, password_id, surnom, user_email) VALUES ('$prenomsu', '$password', '$surnomsu', '$emailsu')";
        $insertsignup = mysqli_query($link, $insertquerry);
        $_SESSION['prenom'] = $prenomsu;
        $_SESSION['password_id'] = $password;
        $_SESSION['success'] = "You are now logged in";
        header('Location: ./welcome.php');
    }

    if (!$insertsignup) {
        echo ("Error : " . mysqli_error($insertsignup));
    }
    die;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Creer Votre compte CaraMel gratuit!</title>
</head>

<body>
    <div class="adslayhsn3wan">
        <img src="https://web.archive.org/web/20000510013226im_/http://ad.caramail.com/pub/CDI26.gif" class="gifads">
        <img src="https://web.archive.org/web/20000510013226im_/http://ad.caramail.com/pub/FCT04.gif" alt="">
    </div>
    <div class="formcontainer">
        <div class="fenetre">


            <form name="NOMPRENOM" method="POST">
                <table border="0" cellspacing="0" cellpadding="0">

                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>

                        <td colspan="3" align="CENTER">
                            &nbsp;<font color="red" style="width: 92%; 
                            padding: 10px; 
                            border: 1px solid #a94442; 
                            background: #f2dede; 
                            border-radius: 5px; "> Les champs marqués d'une * sont obligatoires !!!</font>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan=" 3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="LEFT" nowrap="">
                            <b>&nbsp;Pseudo</b> :
                        </td>
                        <td nowrap="">
                            <input style="border: solid 1.4px blue" type="text" size="16" maxlength="25" name="prenom" required>
                            <font color="red">* :</font>
                            <i>&nbsp;Attention ce Pseudo sera affiché dans les messages que vous enverrez.</i>
                        </td>
                        <td rowspan="2">
                        </td>
                    </tr>
                    <tr>
                        <td align="LEFT" size="16" maxlength="35" colspan="3">
                            <font color="red">&nbsp;<?php
                                                    if (isset($_GET['invalidpseudo'])) {
                                                        echo $_GET['invalidpseudo'];
                                                    }
                                                    if (isset($_GET['Fatalerror'])) {
                                                        echo "Oups ... Pseudo invalid ou déja pris  ...";
                                                    }
                                                    ?>
                            </font>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr> -->
                    <tr>
                        <td align="LEFT" nowrap="">
                            <b>&nbsp;Mot de Passe</b> :
                        </td>
                        <td nowrap="">
                            <input style="border: solid 1.4px blue" type="password" size="16" maxlength="25" name="password" required>
                            <font color="red">*</font>
                        </td>
                    </tr>




                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="LEFT" nowrap="">

                            <b>&nbsp;Confirmation du mot de passe</b> :
                        </td>



                        <td>
                            <input style="border: solid 1.4px blue" type="password" size="16" maxlength="25" name="password2" required>
                            <font color="red">*</font>
                        </td>




                    <tr>
                        <td align="LEFT" size="16" maxlength="35" colspan="3">
                            <font color="red">&nbsp;<?php

                                                    if (isset($_GET['attention'])) {
                                                        echo $_GET['attention'];
                                                    }
                                                        if (isset($_GET['Fatalerror'])) {
                                                        echo "Attention ... Les mots de passe doivent être identiques...";
                                                        }
                                                    ?>
                            </font>
                        </td>
                    </tr>




                    <tr>
                        <td align="left" nowrap="">
                            <b>&nbsp;E-mail</b> :
                        </td>
                        <td nowrap="">
                            <input style="border: solid 1.4px blue" type="email" size="16" maxlength="35" name="email" required>
                            <font color="red">*</font>

                        </td>
                    </tr>

                    <tr>
                        <td colspan="3"></td>
                    </tr>



                    <tr>
                        <td align="LEFT" size="16" maxlength="35" colspan="3">
                            <font color="red">&nbsp;<?php
                                                    if (isset($_GET['error'])) {
                                                        echo $_GET['error'];
                                                    }
                                                        if (isset($_GET['Fatalerror'])) {
                                                        echo "Un compte ayant le même E-mail éxiste déja ...";
                                                        }
                                                    ?>
                            </font>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" align="center">

                            <input type="submit" name="valider" value="Valider">


                            <p>
                                Vous êtes déjà membre ? <a href="welcome.php">Connectez vous.</a>&nbsp;
                            </p>
                        </td>

                    </tr>


                    <tr>

                        <td colspan="3">&nbsp;</td>

                    </tr>

                    </tbody>
                </table>
                </td>
                </tr>
                </table>
            </form>

        </div>
    </div>

</body>

</html>