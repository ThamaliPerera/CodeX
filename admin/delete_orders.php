<?php
// Include the database connection file
include("../connection/connect.php");
// Disable error reporting
error_reporting(0);
// Start the session
session_start();

// Execute a DELETE query to remove an order from the database
// The order to be deleted is identified by the 'o_id' passed via the URL parameter 'order_del'
mysqli_query($db, "DELETE FROM users_orders WHERE o_id = '".$_GET['order_del']."'");

// Redirect the user back to the 'all_orders.php' page after deletion
header("location:all_orders.php");  
?>