<?php
session_start();
if (isset($_POST['userName'], $_POST['password'])) {
    include 'database.php';

    $uname = $_POST['userName'];
    $pw = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE `username`='$uname' AND `password` ='$pw' ";
    $result = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($result);
    if ($count) {
        $fetch = mysqli_fetch_assoc($result);
        $_SESSION['userId'] = $fetch['userId'];
        header('Location:../index.php');
    } else {
        header('Location:../login.php?errorMsg=Invalid Username or Password!');
    }
}