<?php
session_start();
include 'database.php';
if (isset($_GET['id']) && $_GET['id']) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `customers` WHERE `customerId`=$id";
    $stmt = $connection->prepare($sql);
    $result = $stmt->execute();
    if ($result) {
        $_SESSION['successMsg'] = "Customer deleted!";
        header('Location:../screens/adminView/customers.php');
    }
}