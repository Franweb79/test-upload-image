<?php

    /*

        conectar class is already required on usuario.php

    */
    require '../models/Usuario.php';
    $user=new Usuario();

    $user->insertUser($_POST['name'],$_FILES['avatar']['name']);



?>