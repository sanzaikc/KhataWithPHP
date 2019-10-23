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
    <script src="https://use.fontawesome.com/c0cc80b7cc.js"></script>
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
                        <a class="nav-link " href="#">My Customers</a>
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
            <div class="col-lg-3 ">
                <h2><i class="fa fa-users"></i> My Customers</h2>
            </div>
            <div class="col-lg-2 ml-auto">
                <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal"
                    data-target="#exampleModal" data-whatever="@mdo">Add New Customer</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../../includes/addCustomer.php" method="post">
                                    <div class="form-group">
                                        <label for="userName" class="col-form-label">User Name:</label>
                                        <input type="text" name="userName" class="form-control" id="userName" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Add Customer</button>
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
                    <th>Name</th>
                    <th>Total Due Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `customers` WHERE `customerOf` = '$userId'";
                $result = mysqli_query($connection, $sql);
                $index = 0;
                if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['customerId'];
                        $name = $row['fname'] . " " . $row['lname'];
                        $due = $row['dueAmount'];
                        $notice = "";
                        $index++;
                        ?>
                <tr>
                    <td><?php echo htmlentities($index) . "."; ?></td>
                    <td>
                        <h6><?php echo htmlentities($name); ?></h6>
                    </td>
                    <td>
                        <h6> Rs. <span class="text-success"><?php echo htmlentities($due) ?></h6></span>
                    </td>
                    <td>
                        <a href='itemDetailView.php?id=<?php echo htmlentities($id) ?>'
                            class='btn btn-outline-success btn-sm'>View Detail</a>
                        <a href='../../includes/deleteCustomer.php?id=<?php echo htmlentities($id) ?>'
                            class='btn btn-outline-danger btn-sm'>Delete</button>
                    </td>
                </tr>
                <?php }
                } else {
                    $notice = "Seems there are no customers, Add new customers to show them here.";
                }
                ?>
            </tbody>
        </table>
        <h3 class="text-center"><?php echo htmlentities($notice); ?></h3>
    </div>