<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login In</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Economica|Roboto+Condensed&display=swap" rel="stylesheet" />
    <?php
    if (isset($_GET['msg']) && $_GET['msg'] != '') {
        $msg = $_GET['msg'];
    } else {
        $msg = '';
    }
    ?>
</head>

<body id="login">
    <div class="form">
        <header>
            Khata
        </header>
        <form action="includes/addUser.php" method="post" class="formData">
            <input type="text" name="firstName" placeholder="First Name" required />
            <input type="text" name="lastName" placeholder="Last Name" required />
            <input type="text" name="userName" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="password" name="confirmPassword" placeholder="Confirm Password" required />

            <span>
                <b>I am a:</b>
                <input type="radio" name="typeOfUser" id="customer" value="0" required>
                <label for="customer">Customer</label>
                <input type="radio" name="typeOfUser" id="shopOwner" value="1" required>
                <label for="shopOwner">Shop Owner</label>
            </span>

            <span style="color:red"><?php echo $msg  ?></span>
            <input type="submit" value="Sign Up" id="submit" />
            <span><a href="index.php">Cancel</a></span>
        </form>
    </div>
</body>

</html>