<?php

function missingInputRegister($username, $email, $password, $password2) {
    $result;
    if (empty($username) || empty($email) || empty($password) || empty($password2)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function verifyPassword($password, $password2) {
    $result;
    if ($password !== $password2) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function usernameTaken($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.php?usernameTaken");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $data = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($data)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function registerUser($conn, $username, $email, $password) {
    $sql = "INSERT INTO users (username, email, passwd) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.php?failedstmt");
        exit();
    }

    $crypticPasswd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $crypticPasswd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../index.php");
}

function missingInputLogin($username, $password) {
    $result;
    if (empty($username) || empty($password)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function login($conn, $username, $password) {
    $usernameExists = usernameTaken($conn, $username, $username);

    if ($usernameExists === false) {
        header("location: ../login.php?error=failedlogin");
        exit();
    }

    $encryptedPasswd = $usernameExists["passwd"];
    $checkPasswd = password_verify($password, $encryptedPasswd);

    if ($checkPasswd === false) {
        header("location: ../login.php?error=failedlogin");
        exit();
    }
    else if ($checkPasswd === true) {
        session_start();
        $_SESSION["userID"] = $usernameExists["userID"];
        $_SESSION["username"] = $usernameExists["username"];
        header("location: ../index.php");
        exit();
    }
}

?>