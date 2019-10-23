<?php
include_once 'header.php';
require_once 'includes/sessionVariables.php';
$user['isAdmin'] ? include_once 'screens/adminView/dashboard.php' : include_once 'screens/customerView/customerDashboard.php';
?>
</body>

</html>