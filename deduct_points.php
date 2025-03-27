<?php
session_start();
include("connection/connect.php"); // Include your database connection file

// Check if the user is logged in
if (empty($_SESSION["user_id"])) {
    echo json_encode(["status" => "error", "message" => "User  not logged in."]);
    exit();
}

// Get the user ID from the session
$userId = $_SESSION['user_id'];

// Fetch current loyalty points
$query = "SELECT loyalty_points FROM users WHERE u_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo json_encode(["status" => "error", "message" => "User  not found."]);
    exit();
}

$currentPoints = $user['loyalty_points'];
$pointsToDeduct = 1000;

if ($currentPoints >= $pointsToDeduct) {
    $newPoints = $currentPoints - $pointsToDeduct;

    // Update the user's loyalty points
    $updateQuery = "UPDATE users SET loyalty_points = ? WHERE u_id = ?";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bind_param("ii", $newPoints, $userId);

    if ($updateStmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Points deducted successfully.", "new_points" => $newPoints]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to deduct points."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Insufficient points to deduct."]);
}

// Close the statement and connection
$stmt->close();
$db->close();
?>