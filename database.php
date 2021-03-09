<?php

// se connecter à MySQL
$link = mysqli_connect('localhost', 'root', '', 'minichatbox');

// tester la connexion
if(mysqli_connect_errno()){
    echo 'erreur de connexion : '. mysqli_connect_error();
    die();
}
