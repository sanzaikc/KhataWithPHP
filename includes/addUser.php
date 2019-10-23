<?php
if (isset($_POST['firstName'], $_POST['lastName'], $_POST['userName'], $_POST['password'], $_POST['confirmPassword'])) {
    include 'database.php';

    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $uname = $_POST['userName'];
    $pw = $_POST['password'];
    $confirmPw = $_POST['confirmPassword'];
    $isAdmin = $_POST['typeOfUser'];

    $sql = "SELECT * FROM `users` WHERE `username` = '$uname'";
    $result = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($result);
    if (!$count) {
        if ($pw != $confirmPw) {
            $msg = "Passwords didnt match!";
            header('Location:../signUp.php?msg=' . $msg);
        } else {
            $sql = "INSERT INTO `users`(`userName`,`fname`,`lname`,`password`,`isAdmin`) VALUES('$uname','$fname','$lname', '$pw','$isAdmin')";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                header('Location:../login.php?msg=User successfully Added!');
            }
        }
    } else {
        $msg = "Username already exits!";
        header('Location:../signUp.php?msg=' . $msg);
    }
}