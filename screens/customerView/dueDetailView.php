<?php $_SESSION['navlink'] = null;
$customerOf = $_SESSION['customerOf'];
$_SESSION['customerOf'];
?>
<div class="container">
    <div class="row mt-4 mb-3">
        <div class="col-lg-12 ">
            <h2>
                <?php
                $sql = "SELECT `fname` FROM `users` WHERE `userId` = '$customerOf'";
                $result = $connection->query($sql);
                $row = $result->fetch_assoc();
                $name = $row['fname'];
                ?>
                <?php echo "Dues from " . htmlentities($name); ?>'s Shop
            </h2>
        </div>
    </div>
    <hr>
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
                <td><?php echo  htmlentities($index) . "."; ?></td>
                <td><?php echo htmlentities($name); ?></td>
                <td><?php echo htmlentities($date); ?></td>
                <td>Rs. <span class="text-success"><?php echo htmlentities($price); ?></span></td>
                <td> <button class="btn btn-outline-success">Pay</button></td>
            </tr>
            <?php } ?>
            <tr class="bg-light">
                <td colspan="3">
                    Total Due Amount
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
                    Rs. <span class="text-success"><?php echo htmlentities($sum); ?></span>
                </td>
                <td> <button class="btn btn-outline-success">Pay</button></td>
            </tr>
        </tbody>
    </table>
</div>