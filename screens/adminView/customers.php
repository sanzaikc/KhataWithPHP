<?php $_SESSION['navlink'] = null; ?>
<div class="row mt-4">
    <div class="col-lg-4 ">
        <h2><i class="fa fa-users text-info"></i> My Customers</h2>
    </div>
    <hr>
    <div class="col-lg-2 ml-auto">
        <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#exampleModal"
            data-whatever="@mdo">Add New Customer</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="includes/addCustomer.php" method="post">
                            <div class="form-group">
                                <label for="userName" class="col-form-label">User Name:</label>
                                <input type="text" name="userName" class="form-control" id="userName" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add Customer</button>
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
<table class="table table-striped table-hover shadow p-3 mb-3 bg-white mt-4">
    <thead class="bg-light">
        <tr class="table-success">
            <th>#</th>
            <th>Name</th>
            <th>Total Due Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM `customers` WHERE `customerOf` = '$userId'";
        $result = mysqli_query($connection, $sql);
        $index = 0;
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['customerId'];
                $name = $row['fname'] . " " . $row['lname'];
                $due = $row['dueAmount'];
                $notice = "";
                $index++;
                ?>
        <tr>
            <td><?php echo htmlentities($index) . "."; ?></td>
            <td>
                <?php echo htmlentities($name); ?>
            </td>
            <td>
                Rs. <span class="text-success"><?php echo htmlentities($due) ?></span>
            </td>
            <td>
                <a href='index.php?tab=itemDetail&id=<?php echo htmlentities($id) ?>'
                    class='btn btn-outline-success btn-sm'>View Detail</a>
                <a href='includes/deleteCustomer.php?id=<?php echo htmlentities($id) ?>'
                    class='btn btn-outline-danger btn-sm'>Delete</button>
            </td>
        </tr>
        <?php }
        } else {
            $notice = "Seems there are no customers, Add new customers to show them here.";
        }
        ?>
    </tbody>
</table>
<h3 class="text-center"><?php echo htmlentities($notice); ?></h3>
</div>