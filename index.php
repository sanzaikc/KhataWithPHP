<?php
include_once 'includes/sessionVariables.php';
include_once 'header.php';

if (isset($_GET['tab'])) {
    $tabName = $_GET['tab'];
    $_SESSION['navlink'] = $tabName;
}
$user['isAdmin'] ? include_once 'screens/adminView/switchAdminTab.php' : include_once 'screens/customerView/switchCustomerTab.php';

include_once 'footer.php';