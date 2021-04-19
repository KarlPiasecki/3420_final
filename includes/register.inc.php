<?php

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    require_once 'db_connection.inc.php';
    require_once 'register_handler.inc.php';

    if (missingInputRegister($username, $email, $password, $password2) !== false) {
        header("location: ../login.php?error=missinginput");
        exit();
    }
    else if (invalidEmail($email) !== false) {
        header("location: ../login.php?error=invalidEmail");
        exit();
    }
    else if (verifyPassword($password, $password2) !== false) {
        header("location: ../login.php?error=failedverify");
        exit();
    }
    else if (usernameTaken($conn, $username, $email) !== false) {
        header("location: ../login.php?error=usernameTaken");
        exit();
    }

    registerUser($conn, $username, $email, $password);
}

else {
    header("location: ../index.php");
    exit();
}