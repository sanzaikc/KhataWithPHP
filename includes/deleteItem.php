<?php
session_start();
include 'database.php';
if (isset($_GET['id'], $_GET['cid'])) {
    $id = $_GET['id'];
    $cid = $_GET['cid'];
    echo $cid;
    $sql = "DELETE FROM `items` WHERE `itemId`=$id";
    $stmt = $connection->prepare($sql);
    $result = $stmt->execute();
    if ($result) {
        $_SESSION['successMsg'] = "Item deleted!";
        header('Location:../screens/adminView/itemDetailView.php?id=' . $cid);
    }
}