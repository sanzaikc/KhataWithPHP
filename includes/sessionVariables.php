<?php function ErrorMessage()
{
    if (isset($_SESSION['errorMsg'])) {
        $output = "<div class=\"alert alert-danger\">";
        $output .= htmlentities($_SESSION['errorMsg']);
        $output .= "</div>";

        $_SESSION['errorMsg'] = null;
        return $output;
    }
}

function SuccessMessage()
{
    if (isset($_SESSION['successMsg'])) {
        $output = "<div class=\"alert alert-success\">";
        $output .= htmlentities($_SESSION['successMsg']);
        $output .= "</div>";

        $_SESSION['successMsg'] = null;
        return $output;
    }
}