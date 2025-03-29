<?php
// Include the database connection file
include("connection/connect.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $contact_name = mysqli_real_escape_string($db, $_POST['contact-name']);
    $contact_email = mysqli_real_escape_string($db, $_POST['contact-email']);
    $contact_message = mysqli_real_escape_string($db, $_POST['contact-message']);

    // Insert contact message into the database
    $query = "INSERT INTO contact_messages (contact_name, contact_email, contact_message) 
              VALUES ('$contact_name', '$contact_email', '$contact_message')";

    // Execute the query and check for success
    if (mysqli_query($db, $query)) {
        // Redirect or show a success message
        header("Location: index.php?message=Message sent successfully!");
        exit;
    } else {
        // Handle error
        echo "Error: " . mysqli_error($db);
    }
}
?>