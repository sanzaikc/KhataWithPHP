<?php
session_start();
if (isset($_POST['itemName'], $_POST['itemPrice'], $_POST['id'])) {
    include 'database.php';

    $itemName = $_POST['itemName'];
    $price = $_POST['itemPrice'];
    $cid = $_POST['id'];

    $sql = "INSERT INTO `items`(`customerId`,`itemName`,`price`) VALUES(?,?,?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss", $cid, $itemName, $price);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['successMsg'] = "Item Added";
        header('Location:../screens/adminView/itemDetailView.php?id=' . $cid);
    }
}