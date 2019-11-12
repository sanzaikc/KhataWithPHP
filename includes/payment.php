<?php
session_start();
if (isset($_GET['itemId'], $_GET['remark'])) {
    include 'database.php';
    $itemId = $_GET['itemId'];
    $remark = $_GET['remark'];
    $sql = "SELECT * FROM `items` WHERE `itemId` ='$itemId'";
    $stmt = $connection->query($sql);
    if ($stmt) {
        while ($datas = $stmt->fetch_assoc()) {
            $id = $datas['itemId'];
            $cid = $datas['customerId'];
            $name = $datas['itemName'];
            $price = $datas['price'];
        }
        $insertSql = "INSERT INTO `payment`(`customerId`,`itemName`,`amount`,`remark`) VALUES(?,?,?,?)";
        $insertStmt = $connection->prepare($insertSql);
        $insertStmt->bind_param("ssss", $cid, $name, $price, $remark);
        $result = $insertStmt->execute();
        if ($result) {
            $Sql = "DELETE FROM `items` WHERE `itemId`=$id";
            $Stmt = $connection->prepare($Sql);
            $Result = $Stmt->execute();
            $_SESSION['successMsg'] = "Successfully Paid for " . $name . "!";
            if ($Result) {
                if ($remark === "Paid with Khalti") {
                    header('location:../index.php?tab=dueDetail&id=' . $cid);
                } else {
                    header('location:../index.php?tab=itemDetail&id=' . $cid);
                }
            }
        }
    }
}