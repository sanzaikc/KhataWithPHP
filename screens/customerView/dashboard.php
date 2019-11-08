<?php
$_SESSION['navlink'] = null;
?>
<div class="row mt-4">
    <div class="col-lg-3 ">
        <h2><i class="fas fa-tachometer-alt"></i> DashBoard</h2>
    </div>
</div>
<hr>
<div class="row mt-4">
    <div class="col-lg-5 mx-auto">
        <div class="card text-center rounded-lg border-0 shadow p-2 mb-3 bg-white forCardHover">
            <div class="card-body">
                <?php
                $sql = "SELECT SUM(`dueAmount`) AS `totalDue` FROM `customers` WHERE `userId` = '$userId'";
                $result = $connection->query($sql);
                $row = $result->fetch_assoc();
                $count = $row['totalDue'];
                if ($count == null) {
                    $count = "0";
                }
                ?>
                <h1 class="display-3  font-weight-bold">
                    <span class="text-success">
                        <i class="fas fa-money-bill-wave"></i>
                        <?php echo htmlentities($count); ?>
                    </span>
                </h1>
                <h3>Remaining Dues</h3>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row mt-4">
    <div class="col-lg-12">
        <h2>Recently Bought Items</h2>
        <table class="table table-striped table-hover shadow p-3 mb-3 bg-white mt-4 ">
            <thead class="bg-light">
                <tr class="table-info">
                    <th>#</th>
                    <th>From</th>
                    <th>Date</th>
                    <th>Item Bought</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = " SELECT  `customers`.`customerOf`,`items`.`itemName`, `items`.`price`, `items`.`date`";
                $sql .= "FROM `customers`INNER JOIN `items` ON `customers`.`customerId` = `items`.`customerId` ";
                $sql .= "WHERE `customers`.`userId` = '$userId' ORDER BY `items`.`itemId` DESC LIMIT 0,10";
                $result = $connection->query($sql);
                $index = 0;
                if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $date = $row['date'];
                        $itemName = $row['itemName'];
                        $price = $row['price'];
                        $customerOf = $row['customerOf'];
                        $index++;
                        $notice = "";
                        ?>
                <tr>
                    <td><?php echo htmlentities($index) . "."; ?></td>
                    <td><?php
                                        $anotherSql = "SELECT * FROM `users` WHERE `userId` = '$customerOf'";
                                        $anotherResult = $connection->query($anotherSql);
                                        $data = mysqli_fetch_assoc($anotherResult);
                                        $anotherName = $data['shopName'];
                                        echo htmlentities($anotherName); ?>
                    </td>
                    <td><?php echo htmlentities($date); ?></td>
                    <td><?php echo htmlentities($itemName); ?></td>
                    <td><?php echo "Rs." . htmlentities($price); ?></td>
                </tr>
                <?php }
                } else {
                    $notice = "No item bought in credit!";
                } ?>
            </tbody>
        </table>
        <h3 class="text-center"><?php echo $notice; ?></h3>

    </div>
</div>
</div>