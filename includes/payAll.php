<?php
session_start();
if (isset($_GET['cid'], $_GET['remark'])) {
    include 'database.php';
    $cid = $_GET['cid'];
    $remark = $_GET['remark'];
    $sql = "SELECT * FROM `items` WHERE `customerId` ='$cid'";
    $stmt = $connection->query($sql);
    if ($stmt) {
        while ($datas = $stmt->fetch_assoc()) {
            $id = $datas['itemId'];
            $name = $datas['itemName'];
            $price = $datas['price'];

            $insertSql = "INSERT INTO `payment`(`customerId`,`itemName`,`amount`,`remark`) VALUES(?,?,?,?)";
            $insertStmt = $connection->prepare($insertSql);
            $insertStmt->bind_param("ssss", $cid, $name, $price, $remark);
            $result = $insertStmt->execute();
            if ($result) {
                $Sql = "DELETE FROM `items` WHERE `itemId`=$id";
                $Stmt = $connection->prepare($Sql);
                $Result = $Stmt->execute();
                $_SESSION['successMsg'] = "Successfully Paid for all items!";
                if ($Result) {
                    header('location:../index.php?tab=dueDetail&id=' . $cid);
                }
            }
        }
    }
}