<?php
// Include the database connection file
include("../connection/connect.php");
// Disable error reporting
error_reporting(0);
// Start the session
session_start();

// Execute a DELETE query to remove a reservation from the database
// The reservation to be deleted is identified by the 'id' passed via the URL parameter 'reservation_del'
mysqli_query($db, "DELETE FROM reservations WHERE id = '".$_GET['reservation_del']."'");

// Redirect the reservation back to the 'all_reservations.php' page after deletion
header("location:all_reservations.php");  
?>