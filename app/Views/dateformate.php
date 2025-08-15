<?php
if (isset($_POST['dynamic_date'])) {
    $dynamicDate = $_POST['dynamic_date'];
    
    // Convert the JavaScript ISO date to a PHP date
    $phpDate = date($GLOBALS['defaultdateformat'], strtotime($dynamicDate));
    
    // Return the formatted date
    echo $phpDate;
}
?>