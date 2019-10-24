<?php
session_start();
include_once '../../includes/sessionVariables.php';

if (!isset($_SESSION['userId'])) {
    header('Location:login.php');
} else {
    include '../../includes/database.php';
    // $cid = $_GET['id'];
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
<?php
if (isset($_GET['id'])) {
    $customerOf = $_GET['id'];
    $sql = "SELECT * FROM `customers` WHERE `userId` = '$userId'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $customerId = $row['customerId'];
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style2.css">
    <title>Khata</title>
</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
        <div class="container">
            <a class="navbar-brand" href="../.././index.php">Khata</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="../.././index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="myDues.php">My Dues</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <img src="../../images/avatar.png" alt="Avatar" class="avatar mr-2">
                        <span class="text-monospace"><?php echo $user['fname'] . " " . $user['lname']; ?></span>
                        <a href="../../includes/logout.php">
                            <button class="btn btn-sm btn-outline-danger ml-4">Logout</button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-4 mb-3">
            <div class="col-lg-6 ">
                <h2>
                    <?php
                    $sql = "SELECT `fname` FROM `users` WHERE `userId` = '$customerOf'";
                    $result = $connection->query($sql);
                    $row = $result->fetch_assoc();
                    $name = $row['fname'];
                    ?>
                    <?php echo "Dues from " . htmlentities($name); ?> ko Pasal
            </div>
        </div>
        <hr>

        </h2>
        <table class="table table-striped table-hover shadow p-3 mb-5 bg-white mt-4">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Item Name</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $anotherSql = "SELECT * FROM `items` INNER JOIN `customers`";
                $anotherSql .= " ON `customers`.`customerId`=`items`.`customerId` ";
                $anotherSql .= "WHERE `customers`.`customerOf`='$customerOf' AND `customers`.`userId` = '$userId'";
                $anotherResult = $connection->query($anotherSql);
                $index = 0;
                while ($data = $anotherResult->fetch_assoc()) {
                    $name = $data['itemName'];
                    $date = $data['date'];
                    $price = $data['price'];
                    $index++;
                    ?>
                <tr>
                    <td><?php echo htmlentities($index); ?></td>
                    <td><?php echo htmlentities($name); ?></td>
                    <td><?php echo htmlentities($date); ?></td>
                    <td>Rs. <span class="text-success"><?php echo htmlentities($price); ?></span></td>
                    <td> <button class="btn btn-outline-success">Pay</button></td>
                </tr>
                <?php } ?>
                <tr class="bg-light">
                    <td colspan="3">
                        <h5>Total Due Amount</h5>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT SUM(`price`) AS value_sum FROM `items` INNER JOIN `customers` ";
                        $sql .= " ON `customers`.`customerId`=`items`.`customerId` ";
                        $sql .= "WHERE `customers`.`customerOf`='$customerOf' AND `customers`.`userId` = '$userId'";
                        $result = $connection->query($sql);
                        $row = $result->fetch_assoc();
                        $sum = $row['value_sum'];
                        ?>
                        <h5>Rs. <span class="text-success"><?php echo htmlentities($sum); ?></span></h5>
                    </td>
                    <td> <button class="btn btn-outline-success">Pay</button></td>
                </tr>
            </tbody>
        </table>
    </div>