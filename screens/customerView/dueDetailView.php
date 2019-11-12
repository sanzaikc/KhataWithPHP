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
        <tr class="table-warning">
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
            <td> <button data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-success btn-sm"
                    data-name="<?= $name ?>" data-price="<?= $price ?>" data-id=<?= $itemId ?>>Pay</button>
            </td>
        </tr>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Payment?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="payment-button">Pay with Khalti</button>
                    </div>
                </div>
            </div>
        </div>
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
            <td>
                <!-- <a href="includes/payAll.php?cid=<?php echo htmlentities($cid); ?>&remark=Not Paid by Cash"
                    class="btn btn-outline-success" id="payment-button">Pay all</a> -->
            </td>
        </tr>
    </tbody>
</table>
</div>

<script src="https://khalti.com/static/khalti-checkout.js"></script>
<script>
var price = 0;
var id = 0;
var name = "";
var url = "";
$("#exampleModal").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget);
    name = button.data("name");
    price = button.data("price");
    id = button.data("id");
    url = `includes/payment.php?itemId=${id}&remark=Paid with Khalti`;

    var modal = $(this);
    modal.find('.modal-body').text(`Are you sure you want to pay for ${name}  of Rs.${price} ?`)
});

var config = {
    // replace the publicKey with yours
    "publicKey": "test_public_key_8414d9695e554fddbf38e127e247aa9c",
    "productIdentity": "1233",
    "productName": "adsads",
    "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
    "eventHandler": {
        onSuccess(payload) {
            // hit merchant api for initiating verfication
            console.log(payload);
            location.replace(url);

        },
        onError(error) {
            console.log(error);
        },
        onClose() {
            console.log('widget is closing');
        }
    }
};

var checkout = new KhaltiCheckout(config);
var btn = document.getElementById("payment-button");
btn.onclick = function() {
    checkout.show({
        amount: price * 100
    });
}
</script>