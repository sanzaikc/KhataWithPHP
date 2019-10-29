<?php
session_start();
include 'database.php';
if (isset($_GET['id'])) {
    $cid = $_GET['id'];
    $sql = "DELETE FROM `customers` WHERE `customerId`=$cid";
    $stmt = $connection->prepare($sql);
    $result = $stmt->execute();
    if ($result) {
        $_SESSION['successMsg'] = "Customer deleted!";
        $_SESSION['navlink'] = "mycustomers";
        header('location:../index.php?tab=mycustomers');
    }
}