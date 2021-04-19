<?php

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once 'db_connection.inc.php';
    require_once 'register_handler.inc.php';

    if (missingInputLogin($username, $password) !== false) {
        header("location: ../login.php?error=loginmissinginput");
        exit();
    }

    login($conn, $username, $password);
}
else {
    header("location: ../index.php");
    exit();
}

?>