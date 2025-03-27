<?php
session_start();
include("connection/connect.php"); // Include your database connection file

// Check if the user is logged in
if (empty($_SESSION["user_id"])) {
    echo json_encode(["status" => "error", "message" => "User  not logged in."]);
    exit();
}

// Get the user ID and new loyalty points from the POST request
$userId = $_POST['user_id'];
$newPoints = $_POST['loyalty_points'];

// Prepare the update query
$query = "UPDATE users SET loyalty_points = ? WHERE u_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("ii", $newPoints, $userId);

// Execute the query
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Loyalty points updated successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to update loyalty points."]);
}

// Close the statement and connection
$stmt->close();
$db->close();
?>