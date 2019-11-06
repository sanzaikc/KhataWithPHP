<?php $_SESSION['navlink'] = null;
$customerOf = $_SESSION['customerOf'];
$sql = "SELECT `customerId` FROM `customers` WHERE `customerOf` = '$customerOf' AND `userId` = '$userId'";
$result = $connection->query($sql);
$data = $result->fetch_assoc();
$cid = $data['customerId'];
?>
<div class="row mt-4 mb-3">
    <div class="col-lg-2">
        <?php
        $sql = "SELECT * FROM `users` WHERE `userId` = '$customerOf'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $shopName = $row['shopName'];
        ?>
        <a href="././index.php?tab=myDues" class="btn btn-outline-primary">
            Back
        </a>
    </div>
    <div class="col-lg-8 text-center">
        <h2 class="">
            <?php echo htmlentities($shopName); ?>
        </h2>
    </div>
</div>
<hr>
<?php
echo  ErrorMessage();
echo SuccessMessage();
?>
<table class="table table-striped table-hover shadow p-3 mb-5  mt-4">
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
            $itemId = $data['itemId'];
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
            <td> <a href="includes/payment.php?itemId=<?php echo htmlentities($itemId); ?>&remark=Paid"
                    class="btn btn-outline-success btn-sm">Pay</a>
            </td>
        </tr>
        <?php } ?>
        <tr class="bg-light">
            <td colspan="3">
                Total Due Amount
            </td>
            <td>
                <?php
                $sql = "SELECT SUM(`price`) AS value_sum FROM `items` INNER JOIN `customers`";
                $sql .= " ON `customers`.`customerId`=`items`.`customerId` ";
                $sql .= "WHERE `customers`.`customerOf`='$customerOf' AND `customers`.`userId` = '$userId'";
                $result = $connection->query($sql);
                $row = $result->fetch_assoc();
                $sum = $row['value_sum'];
                if ($sum >= 0) {
                    $sql = "UPDATE `customers` SET `dueAmount` ='$sum' WHERE `customerId`= '$cid'";
                    $stmt = $connection->prepare($sql);
                    $stmt->execute();
                }
                ?>
                Rs. <span class="text-success"><?php echo htmlentities($sum); ?></span>
            </td>
            <td><a href="" class="btn btn-outline-success disabled">Pay all</a></td>
        </tr>
    </tbody>
</table>
</div>