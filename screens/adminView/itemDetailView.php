<?php
session_start();
include_once '../../includes/sessionVariables.php';
if (!isset($_SESSION['userId'])) {
    header('Location:login.php');
} else {
    include '../../includes/database.php';
    $cid = $_GET['id'];
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
            <a class="navbar-brand" href="">Khata</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="../.././index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="customers.php">My Customers</a>
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
        <div class="row mt-4">
            <div class="col-lg-6 mr-auto">
                <?php
                $sql = "SELECT `fname` ,`lname` FROM `customers` WHERE `customerId`= '$cid'";
                $result = $connection->query($sql);
                if (mysqli_num_rows($result)) {
                    $row = $result->fetch_assoc();
                    $name = $row['fname'] . " " . $row['lname'];
                }
                ?>
                <div class="row">
                    <h2 class="">
                        <a href="customers.php" class="btn btn-outline-primary">
                            <span>&#171;</span>
                        </a> <?php echo htmlentities($name); ?>
                    </h2>
                </div>
            </div>
            <div class="col-lg-2 ml-auto">
                <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal"
                    data-target="#exampleModal" data-whatever="@mdo">Add Item</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../../includes/addItems.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $cid ?>">
                                    <div class="form-group">
                                        <label for="itemName" class="col-form-label">Item Name:</label>
                                        <input type="text" name="itemName" class="form-control" id="itemName" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="itemPrice" class="col-form-label">Price:</label>
                                        <input type="tel" name="itemPrice" class="form-control" id="itemPrice" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Add Item</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php
        echo  ErrorMessage();
        echo SuccessMessage();
        ?>
        <table class="table table-striped table-hover shadow p-3 mb-5 bg-white mt-4">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Item Name</th>
                    <th>On Date</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead class="bg-light">
            <tbody>
                <?php
                // check if the customer is in the customer table 
                $sql = "SELECT * FROM `items` WHERE `customerId`= '$cid'";
                $result = mysqli_query($connection, $sql);
                $index = 0;
                if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $itemId = $row['itemId'];
                        $itemName = $row['itemName'];
                        $price = $row['price'];
                        $date = $row['date'];
                        $index++;
                        $notice = "";
                        ?>
                <tr>
                    <td><?php echo htmlentities($index) . "."; ?></td>
                    <td><?php echo htmlentities($itemName); ?></td>
                    <td><?php echo htmlentities($date); ?></td>
                    <td><?php echo "Rs. " . htmlentities($price); ?></td>
                    <td>
                        <a href='../../includes/deleteItem.php?id=<?php echo $itemId ?>&cid=<?php echo $cid ?>'
                            class='btn btn-outline-info btn-sm'>Paid</button>
                    </td>
                </tr>
                <?php }
                } else {
                    $notice = "Customer havent taken any items yet!";
                }
                ?>
                <tr class="bg-light">
                    <td colspan="3">
                        <h5>Total</h5>
                    </td>
                    <td colspan="2">
                        <?php
                        $sql = "SELECT SUM(`price`) AS value_sum FROM `items` WHERE `customerId`= '$cid'";
                        $result = $connection->query($sql);
                        $row = $result->fetch_assoc();
                        $sum = $row['value_sum'];

                        if ($sum > 0) {
                            $sql = "UPDATE `customers` SET `dueAmount` ='$sum' WHERE `customerId`= '$cid'";
                            $stmt = $connection->prepare($sql);
                            $stmt->execute();
                        }
                        ?>
                        <h5>Rs. <span class="text-success"><?php echo htmlentities($sum); ?></span></h5>
                    </td>
                </tr>
            </tbody>
        </table>
        <h3 class="text-center"><?php echo htmlentities($notice); ?></h3>
    </div>