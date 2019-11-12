<?php
switch ($_SESSION['navlink']) {
    case "dashboard":
        include('dashboard.php');
        break;
    case "mycustomers":
        include('customers.php');
        break;
    case "itemDetail":
        if (isset($_GET['id'])) {
            $_SESSION['customerId'] = $_GET['id'];
        }
        include('itemDetailView.php');
        break;
    default:
        include('dashboard.php');
}