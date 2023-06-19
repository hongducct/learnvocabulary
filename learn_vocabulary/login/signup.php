<?php 

include '../database.php';
include 'user_db.php';


// print_r($_POST);

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $email = validate($_POST['email']);

    if (empty($username)) {
        header('Location: ../sign-up.php?error=Username is required');
        exit();
    }else if (empty($password)) {
        header('Location: ../sign-up.php?error=Password is required');
        exit();
    }else if (empty($email)) {
        header('Location: ../sign-up.php?error=Email is required');
        exit();
    }else {
        check_signup($username, $password, $email);
    }
}else {
    header('Location:../sign-up.php?error');
    exit();
}

?>