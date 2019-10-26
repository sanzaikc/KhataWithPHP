<?php
session_start();
if (isset($_POST['firstName'], $_POST['lastName'], $_POST['newUserName'], $_POST['newPassword'])) {
    include 'database.php';

    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $uname = $_POST['newUserName'];
    $pw = $_POST['newPassword'];
    $isAdmin = $_POST['typeOfUser'];

    $sql = "SELECT * FROM `users` WHERE `username` = '$uname'";
    $result = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($result);
    if (!$count) {
        $sql = "INSERT INTO `users`(`userName`,`fname`,`lname`,`password`,`isAdmin`) VALUES('$uname','$fname','$lname', '$pw','$isAdmin')";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $_SESSION['successMsg'] = "User successfully Added!";
            header('Location:../loginAndSignup.php');
        }
    } else {
        $_SESSION['errorMsg'] = "Username already exits!";
        header('Location:../loginAndSignup.php');
    }
}