<?php
// Include the database connection file
include("../connection/connect.php");
// Disable error reporting
error_reporting(0);
// Start the session
session_start();

// Execute a DELETE query to remove a featured food item from the database
// The item to be deleted is identified by the 'ff_id' passed via the URL parameter 'res_del'
mysqli_query($db, "DELETE FROM featured_food WHERE ff_id = '".$_GET['res_del']."'");

// Redirect the user back to the 'all_featured_foods.php' page after deletion
header("location:all_featured_foods.php");  
?>