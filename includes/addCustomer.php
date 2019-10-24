<?php
session_start();
$adminId = $_SESSION['userId'];

// checks for username in users table in database
if (isset($_POST['userName'])) {
    include 'database.php';
    $userNameOfCustomer = $_POST['userName'];

    $sql = "SELECT * FROM `users` WHERE `username` = '$userNameOfCustomer'";
    $result = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($result);

    if (!$count) {
        $_SESSION['errorMsg'] = "Enter a valid username!";
        header('Location:../index.php');
    } else {
        // if username found then fetch the data from users table 
        $sql = "SELECT * FROM `users` WHERE `userName` = '$userNameOfCustomer'";
        $result = mysqli_query($connection, $sql);
        $datas[] = mysqli_fetch_assoc($result);
        foreach ($datas as $data) {
            $userId = $data['userId'];
            $fname = $data['fname'];
            $lname = $data['lname'];
            $dueAmount = 0;
            $customerOf = $adminId;

            // checks if the user is already in customer's table 
            $sql = "SELECT * FROM `customers` WHERE `userId` = '$userId' AND `customerOf`= '$customerOf'";
            $result = mysqli_query($connection, $sql);

            if (!mysqli_num_rows($result)) {
                // insert customer in customers table 
                $sql = "INSERT INTO `customers`(`userId`,`fname`,`lname`,`dueAmount`,`customerOf`) VALUES(?,?,?,?,?)";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("sssss", $userId, $fname, $lname, $dueAmount, $customerOf);
                $result = $stmt->execute();
                if ($result) {
                    $_SESSION['successMsg'] = "Customer " . $fname . " " . $lname . " successfully added!";
                    header('location:../index.php?tab=mycustomers');
                }
            } else {
                $_SESSION['errorMsg'] = "Customer " . $fname . " " . $lname . " already exists!";
                header('location:../index.php?tab=mycustomers');
            }
        }
    }
}