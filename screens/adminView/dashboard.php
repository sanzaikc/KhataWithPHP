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
                        <a class="nav-link " href="screens/adminView/dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="screens/adminView/customers.php">My Customers</a>
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
        <div class="row mt-4">
            <div class="col-lg-3 ">
                <h2><i class="fa fa-dashboard"></i> DashBoard</h2>
            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card text-center rounded-lg border-0 shadow p-3 mb-5 bg-white">
                    <div class="card-body">
                        <?php
                        $sql = "SELECT COUNT(*) AS total_customers FROM `customers` WHERE `customerOf` = '$userId'";
                        $result = $connection->query($sql);
                        $row = $result->fetch_assoc();
                        $count = $row['total_customers'];
                        ?>
                        <h1 class="display-3  font-weight-bold">
                            <span class="text-info">
                                <i class="fa fa-users"></i>
                                <?php echo htmlentities($count); ?>
                            </span>
                        </h1>
                        <hr>
                        <h3 class="text-muted">Customers</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-center rounded-lg border-0 shadow p-3 mb-5 bg-white">
                    <div class="card-body">
                        <?php
                        $sql = "SELECT SUM(`dueAmount`) AS total_amount FROM `customers` WHERE `customerOf` = '$userId'";
                        $result = $connection->query($sql);
                        $row = $result->fetch_assoc();
                        $count = $row['total_amount'];
                        ?>
                        <h1 class="display-3  font-weight-bold">
                            <span class="text-success">
                                <i class="fa fa-money"></i>
                                <?php echo htmlentities($count); ?>
                            </span>
                        </h1>
                        <hr>
                        <h3 class="text-muted">Credited</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-center rounded-lg border-0 shadow p-3 mb-5 bg-white">
                    <div class="card-body">
                        <?php
                        $sql = "SELECT COUNT(*) AS total_items FROM `items` INNER JOIN `customers` ON `items`.`customerId`= `customers`.`customerId`WHERE `customers`.`customerOf` = '$userId'";
                        $result = $connection->query($sql);
                        $row = $result->fetch_assoc();
                        $count = $row['total_items'];
                        ?>
                        <h1 class="display-3  font-weight-bold">
                            <span class="text-warning">
                                <i class="fa fa-shopping-basket"></i>
                                <?php echo htmlentities($count); ?>
                            </span>
                        </h1>
                        <hr>
                        <h3 class="text-muted">Items sold</h3>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="col-lg-12">
                <h2>Recent Sales Activities</h2>
                <table class="table table-striped table-hover shadow p-3 mb-5 bg-white mt-4">
                    <thead class="bg-light">
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Item Bought</th>
                        <th>Price</th>
                    </thead>
                    <tbody>
                        <?php
                        $sql = " SELECT `customers`.`fname`,`customers`.`lname`, `items`.`itemName`, `items`.`price`, `items`.`date`";
                        $sql .= "FROM `customers`INNER JOIN `items` ON `customers`.`customerId` = `items`.`customerId` ";
                        $sql .= "WHERE `customers`.`customerOf` = '$userId' ORDER BY `items`.`itemId` DESC LIMIT 0,6";
                        $result = $connection->query($sql);
                        $index = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $name = $row['fname'] . " " . $row['lname'];
                            $date = $row['date'];
                            $itemName = $row['itemName'];
                            $price = $row['price'];
                            $index++;
                            ?>
                        <tr>
                            <td><?php echo htmlentities($index) . "."; ?></td>
                            <td><?php echo htmlentities($name); ?></td>
                            <td><?php echo htmlentities($date); ?></td>
                            <td><?php echo htmlentities($itemName); ?></td>
                            <td><?php echo "Rs." . htmlentities($price); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>