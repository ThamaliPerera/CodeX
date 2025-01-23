<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); // Include the database connection file
error_reporting(0); // Suppress error reporting
session_start(); // Start the session to access session variables

// Check if the user is logged in
if(empty($_SESSION['user_id']))  
{
    header('location:login.php'); // Redirect to login page if not logged in
}
else
{
?>
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Compatibility with Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Responsive design settings -->
    <meta name="description" content=""> <!-- Description for SEO -->
    <meta name="author" content=""> <!-- Author meta tag -->
    <link rel="icon" href="#"> <!-- Favicon for the website -->
    <title>My Orders</title> <!-- Title of the page -->
    
    <!-- CSS files for styling -->
    <link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet"> <!-- Font Awesome for icons -->
    <link href="css/animsition.min.css" rel="stylesheet"> <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet"> <!-- Additional animation CSS -->
    <link href="css/style.css" rel="stylesheet"> <!-- Custom styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> <!-- Bootstrap Icons -->
    
    <style type="text/css" rel="stylesheet"> <!-- Custom styles for the page -->
        .indent-small {
            margin-left: 5px; // Small indentation for elements
        }
        .form-group.internal {
            margin-bottom: 0; // Remove bottom margin for internal form groups
        }
        .dialog-panel {
            margin: 10px; // Margin for dialog panels
        }
        .datepicker-dropdown {
            z-index: 200 !important; // Ensure datepicker dropdown is above other elements
        }
        .panel-body {
            background: #e5e5e5; // Background color for panel body
            background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%); // Radial gradient background
            font: 600 15px "Open Sans", Arial, sans-serif; // Font styling
        }
        label.control-label {
            font-weight: 600; //Bold font for labels
            color: #777; //Color for labels
        }
    </style>
</head>

<body>
    <header id="header" class="header-scroll top-header headrom"> <!-- Header section -->
        <nav class="navbar navbar-dark"> <!-- Navigation bar -->
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button> <!-- Button for mobile view -->
                <a class="navbar-brand" href="index.php">The Templers Café</a> <!-- Brand name linking to home -->
                <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse"> <!-- Collapsible menu for larger screens -->
                    <ul class="nav navbar-nav"> <!-- Navigation links -->
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li> <!-- Home link -->
                        <li class="nav-item"> <a class="nav-link active" href="featured_foods.php">Category <span class="sr-only"></span></a> </li> <!-- Category link -->
                        <li class="nav-item"> <a class="nav-link active" href="loyalty-system.php">Loyalty <span class="sr-only"></span></a> </li> <!-- Loyalty link -->
                        <?php
                        // Check if user is logged in
                        if(empty($_SESSION["user_id"])) {
                            // Show login and registration links if not logged in
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                                  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                        } else {
                            // Show loyalty and order links if logged in
                            echo  '<li class="nav-item"><a href="loyalty-system.php" class="nav-link active">Loyalty</a> </li>';
                            echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                            echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="page-wrapper"> <!-- Wrapper for the page content -->
        <div class="inner-page-hero bg-image" data-image-src="images/img/pimg.jpg"> <!-- Hero section with background image -->
            <div class="container"> </div> <!-- Container for hero content -->
        </div>
        
        <div class="result-show"> <!-- Section to show results -->
            <div class="container">
                <div class="row">
                    <!-- Additional content can be added here -->
                </div>
            </div>
        </div>
    
        <section class="restaurants-page"> <!-- Section for displaying orders -->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bg-gray"> <!-- Background for the orders section -->
                            <div class="row">
                                <table class="table table-bordered table-hover"> <!-- Table for displaying orders -->
                                    <thead style="background: #404040; color:white;"> <!-- Table header -->
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        // Query to fetch user orders
                                        $query_res = mysqli_query($db, "SELECT * FROM users_orders WHERE u_id='" . $_SESSION['user_id'] . "'");
                                        if(!mysqli_num_rows($query_res) > 0) {
                                            echo '<td colspan="6"><center>You have No orders Placed yet.</center></td>'; // Message if no orders found
                                        } else {
                                            // Loop through each order and display in table
                                            while($row = mysqli_fetch_array($query_res)) {
                                        ?>
                                                <tr>	
                                                    <td data-column="Item"><?php echo $row['title']; ?></td> <!-- Item title -->
                                                    <td data-column="Quantity"><?php echo $row['quantity']; ?></td> <!-- Quantity of item -->
                                                    <td data-column="price">LKR<?php echo $row['price']; ?></td> <!-- Price of item -->
                                                    <td data-column="status"> 
                                                        <?php 
                                                        $status = $row['status']; // Get order status
                                                        if($status == "" || $status == "NULL") {
                                                        ?>
                                                            <button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span> Dispatch</button> <!-- Dispatch button -->
                                                        <?php 
                                                        }
                                                        if($status == "in process") { ?>
                                                            <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> On The Way!</button> <!-- On the way button -->
                                                        <?php
                                                        }
                                                        if($status == "closed") {
                                                        ?>
                                                            <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true"></span> Delivered</button> <!-- Delivered button -->
                                                        <?php 
                                                        } 
                                                        if($status == "rejected") {
                                                        ?>
                                                            <button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Cancelled</button> <!-- Cancelled button -->
                                                        <?php 
                                                        } 
                                                        ?>
                                                    </td>
                                                    <td data-column="Date"><?php echo $row['date']; ?></td> <!-- Order date -->
                                                    <td data-column="Action">
                                                        <a href="delete_orders.php?order_del=<?php echo $row['o_id'];?>" onclick="return confirm('Are you sure you want to cancel your order?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> <!-- Delete order button -->
                                                    </td>
                                                </tr>
                                        <?php 
                                            } 
                                        } 
                                        ?>					
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer"> <!-- Footer section -->
            <div class="row bottom-footer">
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
                            <p>Templers Road, Mount Lavinia, Sri Lanka</p> <!-- Address details -->
                            <h5>Phone: 071 722 2444</h5> <!-- Phone number -->
                        </div>
                        <div class="col-lg-3 col-md-6">
                                <h5>Follow Us</h5>
                               
<div class="social-links d-flex">
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
				<div style="margin-top: 10px; text-align: center;">
        <p>&copy; <?php echo date("Y"); ?> The Templers Café. All rights reserved.</p>
    </div>
            </footer>
        
        </div>
  
    
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>
<?php
}
?>