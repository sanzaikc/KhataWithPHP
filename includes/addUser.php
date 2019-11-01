<?php
session_start();
if (isset($_POST['firstName'], $_POST['lastName'], $_POST['newUserName'], $_POST['newPassword'], $_POST['shopName'])) {
    include 'database.php';

    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $uname = $_POST['newUserName'];
    $shopName = $_POST['shopName'];
    $pw = $_POST['newPassword'];
    $isAdmin = $_POST['typeOfUser'];


    $sql = "SELECT * FROM `users` WHERE `username` = '$uname'";
    $result = mysqli_query($connection, $sql);
    if (!mysqli_num_rows($result)) {
        $sql = "INSERT INTO `users`(`userName`,`fname`,`lname`,`password`,`isAdmin`,`shopName`) VALUES(?,?,?,?,?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssss", $uname, $fname, $lname, $pw, $isAdmin, $shopName);
        $result = $stmt->execute();
        if ($result) {
            $_SESSION['successMsg'] = "User successfully Added!";
            header('Location:../loginAndSignup.php');
        }
    } else {
        $_SESSION['errorMsg'] = "Username already exits!";
        header('Location:../loginAndSignup.php');
    }
}