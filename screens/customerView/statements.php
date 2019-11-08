<?php $_SESSION['navlink'] = null; ?>
<div class="row mt-4">
    <div class="col-lg-3 ">
        <h2><i class="fas fa-file-invoice"></i> Statements</h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-hover shadow p-3 mb-3 bg-white mt-4">
            <thead class="bg-light">
                <tr class="table-success">
                    <th>#</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Method</th>
                    <th>Dr.</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `payment` INNER JOIN `customers` ON `payment`.`customerId` = `customers`.`customerId` WHERE `customers`.`userId` = '$userId' ORDER BY `paymentId` DESC";
                $result = $connection->query($sql);
                $index = 0;
                if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $date = $row['date'];
                        $itemName = $row['itemName'];
                        $amount = $row['amount'];
                        $remark = $row['remark'];
                        $customerOf = $row['customerOf'];
                        $index++;
                        $notice = " ";
                        ?>
                <tr>
                    <td><?php echo htmlentities($index) . "."; ?></td>
                    <td><?php echo htmlentities($date); ?></td>
                    <td><?php
                                        $query = "SELECT `shopName` FROM `users` WHERE `userId` = '$customerOf'";
                                        $execute = $connection->query($query);
                                        $data = $execute->fetch_assoc();
                                        $name = $data['shopName'];
                                        ?>
                        <h4 class="text-info"><?php echo htmlentities($name); ?></h4>
                        <p><?php echo htmlentities($itemName); ?></p>
                    </td>
                    <td><?php echo htmlentities($remark); ?></td>
                    <td><?php echo "Rs." . htmlentities($amount); ?></td>
                </tr>
                <?php }
                } else {
                    $notice = "No Payment Activities done!";
                } ?>
            </tbody>
        </table>
        <h3 class="text-center"><?php echo htmlentities($notice); ?></h3>
    </div>
</div>
</div>