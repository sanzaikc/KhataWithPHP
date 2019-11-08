<?php
$_SESSION['navlink'] = null;
$cid = $_SESSION['customerId'];
echo $cid;
?>
<script>
$(function() {
    $('[data-toggle="popover"]').popover()
})
</script>
<div class="row mt-4">
    <div class="col-lg-2 mr-auto">
        <?php
        $sql = "SELECT `fname` ,`lname` FROM `customers` WHERE `customerId`= '$cid'";
        $result = $connection->query($sql);
        if (mysqli_num_rows($result)) {
            $row = $result->fetch_assoc();
            $name = $row['fname'] . " " . $row['lname'];
        }
        ?>
        <a href="././index.php?tab=mycustomers" class="btn btn-outline-primary">
            Back
        </a>
    </div>
    <div class="col-lg-8 text-center">
        <h2>
            <?php echo htmlentities($name); ?>
            <button class="btn btn-outline-success ml-2" tabindex="0" data-toggle="popover" data-trigger="focus"
                data-placement="bottom" title="Recent transactions" data-html="true" data-content="
          <div class='list-group list-group-flush'>
              <?php
                $sql = "SELECT * FROM `payment` WHERE `customerId` = '$cid' ORDER BY `paymentId` DESC LIMIT 0,5";
                $result = $connection->query($sql);
                $index = 0;
                if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $date = $row['date'];
                        $itemName = $row['itemName'];
                        $amount = $row['amount'];
                        $remark = $row['remark'];
                        $index++;
                        $notice = "";
                        ?>
                        <div class='list-group-item flex-column align-items-start'>
                            <h6 class='mb-1'><?= $date ?></h6>
                                <small>Paid for : <?= $itemName ?></small>
                                <small>Amount : Rs.<?= $amount ?></small>
                                <small> Remarks : <?= $remark ?></small>
                        </div>
                <?php }
                } else {
                    $notice = "No Payment Activities done!";
                } ?>
                <?php echo htmlentities($notice); ?>
    </div>"><i class="fas fa-history mr-2"></i> Payment History</button>
        </h2>
    </div>
    <div class="col-lg-2 mr-auto">
        <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#exampleModal"
            data-whatever="@mdo">Add Item</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="includes/addItems.php" method="post">
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
        <tr class="table-info">
            <th>#</th>
            <th>Item Name</th>
            <th>On Date</th>
            <th>Price</th>
            <th>Actions</th>
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
                <a href='includes/deleteItem.php?id=<?php echo $itemId ?>&cid=<?php echo $cid ?>'
                    class='btn btn-outline-danger btn-sm'>Delete</a>
                <a href="includes/payment.php?itemId=<?php echo htmlentities($itemId); ?>&remark=Paid by Cash"
                    class="btn btn-outline-info btn-sm">Paid by Cash</a>
            </td>
        </tr>
        <?php }
        } else {
            $notice = "Customer havent taken any items yet!";
        }
        ?>
        <tr class="bg-light">
            <td colspan="3">
                Total
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
                } else {
                    $sum = "0";
                }
                ?>
                Rs. <span class="text-success"><?php echo htmlentities($sum); ?></span>
            </td>
        </tr>
    </tbody>
</table>
<h3 class="text-center"><?php echo htmlentities($notice); ?></h3>
</div>