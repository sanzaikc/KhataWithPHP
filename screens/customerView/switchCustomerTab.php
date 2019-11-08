<?php
switch ($_SESSION['navlink']) {
    case "dashboard":
        include('dashboard.php');
        break;
    case "myDues":
        include('myDues.php');
        break;
    case "dueDetail":
        if (isset($_GET['customerOf'])) {
            $_SESSION['customerOf'] = $_GET['customerOf'];
        }
        include('dueDetailView.php');
        break;
    case "statement":
        include('statements.php');
        break;
    default:
        include('dashboard.php');
}