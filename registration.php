<!DOCTYPE html>
<html lang="en">
<?php
// Start a session
session_start(); 

// Disable error reporting for production
error_reporting(0); 

// Include database connection
include("connection/connect.php"); 

// Check if the form is submitted
if(isset($_POST['submit'])) 
{
    // Initialize an array to hold error messages
    $errors = [];

    // Check if any required fields are empty
    if(empty($_POST['firstname'])) {
        $errors[] = "First name is required.";
    }
    if(empty($_POST['lastname'])) {
        $errors[] = "Last name is required.";
    }
    if(empty($_POST['email'])) {
        $errors[] = "Email is required.";
    }
    if(empty($_POST['phone'])) {
        $errors[] = "Phone number is required.";
    }
    if(empty($_POST['password'])) {
        $errors[] = "Password is required.";
    }
    if(empty($_POST['cpassword'])) {
        $errors[] = "Confirm password is required.";
    }
    if(empty($_POST['address'])) {
        $errors[] = "Address is required.";
    }

    // If there are no errors, proceed with validation
    if(empty($errors)) {
        // Check if the username already exists
        $check_username = mysqli_query($db, "SELECT username FROM users WHERE username = '".mysqli_real_escape_string($db, $_POST['username'])."'");
        
        // Check if the email already exists
        $check_email = mysqli_query($db, "SELECT email FROM users WHERE email = '".mysqli_real_escape_string($db, $_POST['email'])."'");
        
        // Check if passwords match
        if($_POST['password'] != $_POST['cpassword']) {  
            $errors[] = "Passwords do not match.";
        }
        // Check if password length is less than 6
        elseif(strlen($_POST['password']) < 6) {
            $errors[] = "Password must be at least 6 characters.";
        }
        // Check if phone number length is less than 10
        elseif(strlen($_POST['phone']) < 10) {
            $errors[] = "Invalid phone number!";
        }
        // Validate email format
        elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email address!";
        }
        // Check if username already exists
        elseif(mysqli_num_rows($check_username) > 0) {
            $errors[] = "Username already exists!";
        }
        // Check if email already exists
        elseif(mysqli_num_rows($check_email) > 0) {
            $errors[] = "Email already exists!";
        }
        else {
            // Insert new user into the database with 1000 loyalty points
            $mql = "INSERT INTO users(username, f_name, l_name, email, phone, password, address, loyalty_points) VALUES('".mysqli_real_escape_string($db, $_POST['username'])."', '".mysqli_real_escape_string($db, $_POST['firstname'])."', '".mysqli_real_escape_string($db, $_POST['lastname'])."', '".mysqli_real_escape_string($db, $_POST['email'])."', '".mysqli_real_escape_string($db, $_POST['phone'])."', '".md5($_POST['password'])."', '".mysqli_real_escape_string($db, $_POST['address'])."', 1000)";
            mysqli_query($db, $mql);
            
            // Redirect to login page
            header("Location: login.php");
            exit; // Ensure no further code is executed
        }
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icn.png" type="image/x-icon"><!--favicon-->
    <title>Registration</title>
    <!-- Include CSS files -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/reservation.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
<div style="background-image: url('images/img/pimg.jpg');">
<header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php">The Templers Café</a>
                <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="featured_foods.php">Category<span class="sr-only"></span></a> </li>
                        
                        <?php
                        // Check if user is logged in
                        if(empty($_SESSION["user_id"]))
                        {
                            // Show login and registration links
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                                  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                        }
                        else
                        {
                            // Show user orders and logout links
                            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                            echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="page-wrapper">
        <div class="container">
            <ul>
                <!-- Placeholder for any additional content -->
            </ul>
        </div>
        
        <section class="contact-page inner-page">
            <div class="container ">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="widget-body">
                                <!-- Registration form -->
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="exampleInputEmail1">User  -Name</label>
                                            <input class="form-control" type="text" name="username" id="example-text-input" required> 
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">First Name</label>
                                            <input class="form-control" type="text" name="firstname" id="example-text-input" required> 
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">Last Name</label>
                                            <input class="form-control" type="text" name="lastname" id="example-text-input-2" required> 
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">Email Address</label>
                                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required> 
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">Phone number</label>
                                            <input class="form-control" type="text" name="phone" id="example-tel-input-3" required> 
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" required> 
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputPassword1">Confirm Password</label>
                                            <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" required> 
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="exampleTextarea">Delivery Address</label>
                                            <textarea class="form-control" id="exampleTextarea" name="address" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p> <input type="submit" value="Register" name="submit" class="btn theme-btn"> </p>
                                            </div>
                                </form>
                                <?php
                                // Display error messages if any
                                if (!empty($errors)) {
                                    echo '<div class="alert alert-danger">';
                                    foreach ($errors as $error) {
                                        echo '<p>' . htmlspecialchars($error) . '</p>'; // Display each error message
                                    }
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <footer class="footer"> <!-- Footer section -->
            <div class="container">
                <div class="row bottom-footer"> <!-- Bottom footer row -->
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 payment-options color-gray"> <!-- Payment options section -->
                                <h5>Payment Options</h5>
                                <ul>
                                    <li><a href="#"><img src="images/mastercard.png" alt="Mastercard"></a></li> <!-- Mastercard option -->
                                    <li><a href="#"><img src="images/maestro.png" alt="Maestro"></a></li> <!-- Maestro option -->
                                    <li><a href="#"><img src="images/stripe.png" alt="Stripe"></a></li> <!-- Stripe option -->
                                </ul>
                            </div>
                            <div class="col-xs-12 col-sm-4 address color-gray"> <!-- Address section -->
                                <h5>Address</h5>
                                <p>Templers Road, Mount Lavinia, Sri Lanka</p> <!-- Physical address -->
                                <h5>Phone: 071 722 2444</h5> <!-- Contact phone number -->
                            </div>
                            <div class="col-lg-3 col-md-6"> <!-- Social media section -->
                                <h5>Follow Us</h5>
                                <div class="social-links d-flex"> <!-- Social media links -->
                                    <a href="https://www.facebook.com/thetemplerscafe?mibextid=kFxxJD" class="facebook" target="_blank" rel="noopener noreferrer">
                                        <i class="bi bi-facebook"></i> <!-- Facebook Icon -->
                                    </a>
                                    <a href="https://www.instagram.com/thetemplerscafe?igsh=MXF1N3dxN3hhbXYw" class="instagram" target="_blank" rel="noopener noreferrer">
                                        <i class="bi bi-instagram"></i> <!-- Instagram Icon -->
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 10px; text-align: center;"> <!-- Copyright section -->
                <p>&copy; <?php echo date("Y"); ?> The Templers Café. All rights reserved.</p> <!-- Current year copyright -->
            </div>
        </footer>
    </div>
    
    <!-- Include JavaScript files -->
    <script src="js/jquery.min.js"></script> <!-- jQuery library -->
    <script src="js/tether.min.js"></script> <!-- Tether library -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap JavaScript -->
    <script src="js/animsition.min.js"></script> <!-- Animsition effects -->
    <script src="js/bootstrap-slider.min.js"></script> <!-- Bootstrap slider -->
    <script src="js/jquery.isotope.min.js"></script> <!-- Isotope layout library -->
    <script src="js/headroom.js"></script> <!-- Headroom.js for hiding header -->
    <script src="js/foodpicky.min.js"></script> <!-- Custom JavaScript for the site -->
</body>
</html>