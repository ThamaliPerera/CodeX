<!DOCTYPE html>
<html lang="en">
<?php
// Include the database connection file
include("../connection/connect.php");
// Disable error reporting
error_reporting(0);
// Start the session
session_start();

// Check if the login form is submitted
if(isset($_POST['submit'])) {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Check if the submit button was clicked
    if(!empty($_POST["submit"])) {
        // Prepare the SQL query to check for a matching admin user
        $loginquery = "SELECT * FROM admin WHERE username='$username' && password='".md5($password)."'"; // Password is hashed using md5
        $result = mysqli_query($db, $loginquery); // Execute the query
        $row = mysqli_fetch_array($result); // Fetch the result as an associative array
        
        // Check if a matching user was found
        if(is_array($row)) {
            // Store the admin ID in the session
            $_SESSION["adm_id"] = $row['adm_id'];
            // Redirect to the dashboard after a short delay
            header("refresh:1;url=dashboard.php");
        } else {
            // Show an alert if the username or password is invalid
            echo "<script>alert('Invalid Username or Password!');</script>"; 
        }
    }
}
?>

<head>
  <meta charset="UTF-8"> <!-- Set character encoding -->
  <title>Admin Login</title> <!-- Page title -->
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"> <!-- CSS reset -->

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'> <!-- Google font -->
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'> <!-- Google font -->
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'> <!-- Font Awesome icons -->

  <link rel="stylesheet" href="css/login.css"> <!-- Custom login CSS -->
</head>

<body>
  
<div class="container"> <!-- Container for the login form -->
  <div class="info">
    <h1>Admin Panel </h1> <!-- Title for the admin panel -->
  </div>
</div>
<div class="form"> <!-- Form section -->
  <div class="thumbnail"><img src="images/manager.png"/> <!-- Thumbnail image for the login form --></div>
  <span style="color:red;"><?php echo $message; ?></span> <!-- Display error message if any -->
  <span style="color:green;"><?php echo $success; ?></span> <!-- Display success message if any -->
  <form class="login-form" action="index.php" method="post"> <!-- Login form -->
    <input type="text" placeholder="Username" name="username"/> <!-- Username input field -->
    <input type="password" placeholder="Password" name="password"/> <!-- Password input field -->
    <input type="submit" name="submit" value="Login" /> <!-- Submit button -->
  </form>
  
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> <!-- jQuery library -->
  <script src='js/index.js'></script> <!-- Custom JavaScript for the login page -->
</body>

</html>