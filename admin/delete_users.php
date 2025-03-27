<?php
// Include the database connection file
include("../connection/connect.php");
// Disable error reporting
error_reporting(0);
// Start the session
session_start();

// Execute a DELETE query to remove a user from the database
// The user to be deleted is identified by the 'u_id' passed via the URL parameter 'user_del'
mysqli_query($db, "DELETE FROM users WHERE u_id = '".$_GET['user_del']."'");

// Redirect the user back to the 'all_users.php' page after deletion
header("location:all_users.php");  
?>