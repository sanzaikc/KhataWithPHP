<?php
$sql = "SELECT * FROM `customers` WHERE `userId` = '$userId'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
$customerId = $row['customerId'];
$customerOf = $row['customerOf'];
?>

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
                        <a class="nav-link " href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="screens/customerView/myDues.php">My Dues</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <img src="images/avatar.png" alt="Avatar" class="avatar mr-2">
                        <span class="text-monospace"><?php echo $user['fname'] . " " . $user['lname']; ?></span>
                        <a href="includes/logout.php">
                            <button class="btn btn-sm btn-outline-danger ml-4">Logout</button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-4 mb-3">
            <div class="col-lg-3 ">
                <h2>Dashboard</h2>
            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card text-center">
                    <div class="card-body">
                        <?php
                        $sql = "SELECT COUNT(*) AS total_customers FROM `customers` WHERE `customerOf` = '$userId'";
                        $result = $connection->query($sql);
                        $row = $result->fetch_assoc();
                        $count = $row['total_customers'];
                        ?>
                        <h1><?php echo htmlentities($count); ?></h1>
                        <h1>Remaining Due</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>