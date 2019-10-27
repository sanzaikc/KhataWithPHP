<?php $_SESSION['navlink'] = null; ?>
<div class="container">
    <div class="row mt-4">
        <div class="col-lg-3 ">
            <h2><i class="fas fa-file-invoice"></i> My Dues</h2>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-hover shadow p-3 mb-3 bg-white mt-4">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>From</th>
                        <th>Due Owned</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `customers` WHERE `userId` = '$userId'";
                    $result = mysqli_query($connection, $sql);
                    $index = 0;
                    if (mysqli_num_rows($result)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['customerId'];
                            $due = $row['dueAmount'];
                            $customerOf = $row['customerOf'];
                            $notice = "";
                            $index++;
                            ?>
                    <tr>
                        <td><?php echo htmlentities($index) . "."; ?></td>
                        <td>
                            <?php
                                            $anotherSql = "SELECT * FROM `users` WHERE `userId` = '$customerOf'";
                                            $newResult = $connection->query($anotherSql);
                                            $datas = $newResult->fetch_assoc();
                                            $name = $datas['fname'] . " " . $datas['lname'];
                                            ?>
                            <?php echo  htmlentities($name); ?>

                        </td>
                        <td>
                            Rs.
                            <span class="text-success">
                                <?php echo htmlentities($due); ?>
                            </span>
                        </td>
                        <td>
                            <a href='index.php?tab=dueDetail&customerOf=<?php echo htmlentities($customerOf) ?>'
                                class='btn btn-outline-success btn-sm'> View Detail</a>
                        </td>
                    </tr>
                    <?php }
                    } else {
                        $notice = "Seems you haven't any items in credit!";
                    }
                    ?>
                </tbody>
            </table>
            <h3 class="text-center"><?php echo htmlentities($notice); ?></h3>
        </div>
    </div>
</div>