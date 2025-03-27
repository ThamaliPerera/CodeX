<?php
// Include the database connection file
include("../connection/connect.php");
// Disable error reporting
error_reporting(0);
// Start the session
session_start();

// Execute a DELETE query to remove a dish from the database
// The dish to be deleted is identified by the 'd_id' passed via the URL parameter 'menu_del'
mysqli_query($db, "DELETE FROM dishes WHERE d_id = '".$_GET['menu_del']."'");

// Redirect the user back to the 'all_menu.php' page after deletion
header("location:all_menu.php");  
?>