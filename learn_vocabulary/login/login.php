<?php

include '../database.php';
include 'user_db.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        header('Location: ../index.php?error=Username is required');
        exit();
    }else if (empty($password)) {
        header('Location: ../index.php?error=Password is required');
        exit();
    }else {
        check_login($username, $password);
    }
}else {
    header('Location: ../index.php?error');
    exit();
}

?>