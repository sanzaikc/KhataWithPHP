<?php
session_start();
$_SESSION['navlink'] = "dashboard";

if (isset($_POST['userName'], $_POST['userPassword'])) {
    include 'database.php';

    $uname = $_POST['userName'];
    $pw = $_POST['userPassword'];
    $sql = "SELECT * FROM `users` WHERE `username`='$uname' AND `password` ='$pw' ";
    $result = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($result);
    if ($count) {
        $fetch = mysqli_fetch_assoc($result);
        $_SESSION['userId'] = $fetch['userId'];
        $_SESSION['isAdmin'] = $fetch['isAdmin'];
        header('Location:../index.php');
    } else {
        $_SESSION['errorMsg'] = "Invalid User Name Or Password";
        header('Location:../loginAndSignup.php');
    }
}