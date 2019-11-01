<?php
session_start();
if (!isset($_SESSION['userId'])) {
    // $_SESSION['errorMsg'] = "You need to login first!";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Economica|Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
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
    <title>Khata</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color:#edf4fa">
        <div class="container">
            <a class="navbar-brand text-info" href="index.php?tab=dashboard" style="font-size:2rem">Khata</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <?php if ($_SESSION['isAdmin']) : ?>
                <ul class="navbar-nav mt-2 mr-auto">
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" href="index.php?tab=dashboard">Dashboard</a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link font-weight-bold " href="index.php?tab=mycustomers">My Customers</a>
                    </li>
                </ul>
                <?php endif ?>
                <?php if (!$_SESSION['isAdmin']) : ?>
                <ul class="navbar-nav mt-2 mr-auto">
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" href="index.php?tab=dashboard">Dashboard</a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link font-weight-bold " href="index.php?tab=myDues">My
                            Dues</a>
                    </li>
                </ul>
                <?php endif ?>
                <div class="dropdown show">
                    <span class="mr-2 text-info" aria-labelledby=" dropdownMenuLink">
                        <img src="images/genericAvatarIcon.jpg" alt="Avatar"
                            class="avatar mr-2"><?php echo $user['fname'] . " " . $user['lname']; ?>
                    </span>
                    <a class="dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="nav-link dropdown-item" href="#">My Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item nav-link text-danger" href="includes/logout.php">Log out<i
                                class="fas fa-sign-out-alt ml-2"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </nav>