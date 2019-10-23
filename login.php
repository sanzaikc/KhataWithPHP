<?php
session_start();
if (isset($_SESSION['userId'])) {
    header('Location:index.php');
} elseif (isset($_GET['msg']) && $_GET['msg'] != '') {
    echo "<script type=\"text/javascript\">alert(\"" . $_GET['msg'] . "\");</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" type="image/png" href="https://img.icons8.com/ios/50/000000/circled-k.png">
    <link rel="stylesheet" href="css/style.css" />
    <title>Login</title>
    <?php
    if (isset($_GET['errorMsg']) && $_GET['errorMsg'] != '') {
        $errorMsg = $_GET['errorMsg'];
    } else {
        $errorMsg = '';
    }
    ?>
    <link href="https://fonts.googleapis.com/css?family=Economica|Roboto+Condensed&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="form">
        <header>
            Khata
        </header>
        <form action="includes/loginHandler.php" method="post" class="formData">
            <input type="text" name="userName" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <!-- <div class="remember">
                <label for="rememberMe"> Remember Me </label>
                <input type="checkbox" name="rememberMe" id="rememberMe">
            </div> -->
            <span style="color:red"> <?php echo $errorMsg; ?></span>
            <input type="submit" value="LogIn" id="submit" />
            <span>No Account? <a href="signUp.php">Sign Up!</a></span>
        </form>
    </div>
</body>

</html>