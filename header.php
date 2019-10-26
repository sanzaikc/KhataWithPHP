<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location:loginAndSignUp.php');
} else {
    include 'includes/database.php';
    $userId = $_SESSION['userId'];
    $sql = "SELECT * FROM `users` WHERE `userId`='$userId'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="https://img.icons8.com/ios/50/000000/circled-k.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/d6dae3ac15.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <link rel=" stylesheet" href="css/bootstrap.min.css">
    <title>Khata</title>

    <style>
    .avatar {
        vertical-align: middle;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 5px;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color:#e3f2fd">
        <div class="container">
            <a class="navbar-brand text-info" href="index.php" style="font-size:1.5rem">Khata</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">

                <?php if ($_SESSION['isAdmin']) : ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?tab=dashboard">Dashboard</a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link " href="index.php?tab=mycustomers">My Customers</a>
                    </li>
                </ul>
                <?php endif ?>
                <?php if (!$_SESSION['isAdmin']) : ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?tab=dashboard">Dashboard</a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link " href="index.php?tab=myDues">My
                            Dues</a>
                    </li>
                </ul>
                <?php endif ?>

                <ul class=" navbar-nav ml-auto">
                    <li class="nav-item mt-2">
                        <img src="images/avatar.png" alt="Avatar" class="avatar mr-2">
                        <?php echo $user['fname'] . " " . $user['lname']; ?>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link text-info ml-4" href="includes/logout.php">Logout<i
                                class="fas fa-sign-out-alt ml-2"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>