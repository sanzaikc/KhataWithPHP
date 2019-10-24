<?php
$_SESSION['navlink'] = null;
?>
<div class="container">
    <div class="row mt-4">
        <div class="col-lg-3 ">
            <h2><i class="fas fa-tachometer-alt"></i> DashBoard</h2>
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