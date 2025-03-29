<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8"> <!-- Character encoding for the document -->
  <title>Login</title> <!-- Title of the page -->
  <link rel="icon" href="images/icn.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"> <!-- CSS reset for consistent styling across browsers -->

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'> <!-- Google Fonts for typography -->
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'> <!-- Font Awesome for icons -->

  <link rel="stylesheet" href="css/login.css"> <!-- Custom CSS for login page -->

<!--login button-->
  <style type="text/css"> 
    #buttn{
      color:#fff;
      background-color: #5c4ac7; 
    }
  </style>

<!--css files-->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Responsive design settings -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/reservation.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> <!-- Bootstrap Icons -->
</head>

<body>
<header id="header" class="header-scroll top-header headrom"> <!-- Header section -->
  <nav class="navbar navbar-dark"> <!-- Navigation bar -->
    <div class="container"> <!-- Container for navbar content -->
      <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button> <!-- Mobile toggle button -->
      <a class="navbar-brand" href="index.php">The Templers Café</a> <!-- Brand name -->
      <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse"> <!-- Collapsible navbar -->
        <ul class="nav navbar-nav"> <!-- Navigation links -->
          <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li> <!-- Home link -->
          <li class="nav-item"> <a class="nav-link active" href="featured_foods.php">Category <span class="sr-only"></span></a> </li> <!-- Category link -->
          
          <?php
          // Check if user is logged in
          if(empty($_SESSION["user_id"])) {
            // Show login and registration links if not logged in
            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
          } else {
            // Show user-specific links if logged in
            echo '<li class="nav-item"><a href="loyalty-system.php" class="nav-link active">Loyalty</a> </li>';
            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
            echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>'; // Logout link
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>

<div style="background-image: url('images/img/pimg.jpg');"> <!-- Background image for the login section -->

<?php
include("connection/connect.php"); // Include database connection
error_reporting(0); // Suppress error reporting
session_start(); // Start session management

// Check if the form is submitted
if(isset($_POST['submit'])) {
  $username = $_POST['username']; // Get username from form
  $password = $_POST['password']; // Get password from form
  
  // Check if the submit button was pressed
  if(!empty($_POST["submit"])) {
    $loginquery ="SELECT * FROM users WHERE username='$username' && password='".md5($password)."'"; // Query to select matching user records
    $result=mysqli_query($db, $loginquery); // Execute the query
    $row=mysqli_fetch_array($result); // Fetch the result as an array
    
    // Check if a matching user was found
    if(is_array($row) ) {
      $_SESSION["user_id"] = $row['u_id']; // Store user ID in session
      header("refresh:1;url=index.php"); // Redirect to index page after 1 second
    } else {
      $message = "Invalid Username or Password!"; // Set error message for invalid login
    }
  }
}
?>

<div class="pen-title"> <!-- Title for the login form -->
  <h1>Login</h1> <!-- Heading for the login form -->
</div>

<div class="module form-module"> <!-- Main container for the login form -->
  <div class="toggle"> <!-- Toggle for switching forms (if applicable) -->
  </div>
  <div class="form"> <!-- Form container -->
    <h2>Login to your account</h2> <!-- Form heading -->
    <span style="color:red;"><?php echo $message; ?></span> <!-- Display error message if any -->
    <span style="color:green;"><?php echo $success; ?></span> <!-- Display success message if any -->
    <form action="" method="post"> <!-- Form submission -->
      <input type="text" placeholder="Username" name="username"/> <!-- Input for username -->
      <input type="password" placeholder="Password" name="password"/> <!-- Input for password -->
      <input type="submit" id="buttn" name="submit" value="Login" /> <!-- Submit button -->
    </form>
  </div>
  
  <div class="cta">Not registered?<a href="registration.php" style="color:#5c4ac7;"> Create an account</a></div> <!-- Link to registration page -->
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> <!-- jQuery library -->

<div class="container-fluid pt-3"> <!-- Container for additional content -->
  <p></p> <!-- Placeholder paragraph -->
</div>

<footer class="footer"> <!-- Footer section -->
  <div class="container"> <!-- Container for footer content -->
    <div class="bottom-footer"> <!-- Bottom footer section -->
      <div class="row"> <!-- Row for footer content -->
        <div class="col-xs-12 col-sm-3 payment-options color-gray"> <!-- Payment options column -->
          <h5>Payment Options</h5> <!-- Heading for payment options -->
          <ul> <!-- List of payment options -->
            <li>
              <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a> <!-- Mastercard option -->
            </li>
            <li>
              <a href="#"> <img src="images/maestro.png" alt="Maestro"> </a> <!-- Maestro option -->
            </li>
            <li>
              <a href="#"> <img src="images/stripe.png" alt="Stripe"> </a> <!-- Stripe option -->
            </li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-4 address color-gray"> <!-- Address column -->
          <h5>Address</h5> <!-- Heading for address -->
          <p>Templers Road, Mount Lavinia, Sri Lanka</p> <!-- Address details -->
          <h5>Phone:071 722 2444</h5> <!-- Phone number -->
        </div>
        <div class="col-lg-3 col-md-6"> <!-- Social media column -->
          <h5>Follow Us</h5> <!-- Heading for social media -->
          <div class="social-links d-flex"> <!-- Social links container -->
            <a href="https://www.facebook.com/thetemplerscafe?mibextid=kFxxJD" class="facebook" target="_blank" rel="noopener noreferrer"> <!-- Facebook link -->
              <i class="bi bi-facebook"></i> <!-- Facebook icon -->
            </a>
            <a href="https://www.instagram.com/thetemplerscafe?igsh=MXF1N3dxN3hhbXYw" class="instagram" target="_blank" rel="noopener noreferrer"> <!-- Instagram link -->
              <i class="bi bi-instagram"></i> <!-- Instagram icon -->
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div style="margin-top: 10px; text-align: center;"> <!-- Centered copyright section -->
    <p>&copy; <?php echo date("Y"); ?> The Templers Café. All rights reserved.</ p> <!-- Copyright notice -->
  </div>
</footer>

</body>

</html>