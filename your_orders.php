<!DOCTYPE html>
<html lang="en">
<?php
// Include the database connection file
include("connection/connect.php");

// Disable error reporting for production
error_reporting(0);

// Start a session to manage user login state
session_start();

// Check if the user is not logged in (user_id is not set in the session)
if(empty($_SESSION['user_id']))  
{
    // Redirect the user to the login page
    header('location:login.php');
}
else
{
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icn.png" type="image/x-icon"><!--favicon-->
    <title>My Orders</title>
    <!-- Include Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Include Animsition CSS -->
    <link href="css/animsition.min.css" rel="stylesheet">
    <!-- Include Animate CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Include Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Include Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<style type="text/css" rel="stylesheet">
    /* Custom CSS styles for the page */
    .indent-small {
      margin-left: 5px;
    }
    .form-group.internal {
      margin-bottom: 0;
    }
    .dialog-panel {
      margin: 10px;
    }
    .datepicker-dropdown {
      z-index: 200 !important;
    }
    .panel-body {
      background: #e5e5e5;
      /* Gradient background */
      background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
      background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
      background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
      background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
      background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
      background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
      font: 600 15px "Open Sans", Arial, sans-serif;
    }
    label.control-label {
      font-weight: 600;
      color: #777;
    }
</style>
</head>

<body>
    <!-- Header Section -->
    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <!-- Navbar Toggle Button for Mobile -->
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <!-- Brand Logo -->
                <a class="navbar-brand" href="index.php">The Templers Café</a>
                <!-- Navbar Links -->
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="featured_foods.php">Category <span class="sr-only"></span></a> </li>
                        
                        
                        <?php
                        // Check if the user is logged in
                        if(empty($_SESSION["user_id"]))
                        {
                            // Display login and register links if not logged in
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                                  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                        }
                        else
                        {
                            // Display loyalty, orders, and logout links if logged in
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

    <!-- Main Content Section -->
    <div class="page-wrapper">
        <!-- Hero Image Section -->
        <div class="inner-page-hero bg-image" data-image-src="images/img/pimg.jpg">
            <div class="container"></div>
        </div>

        <!-- Orders Table Section -->
        <section class="restaurants-page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bg-gray">
                            <div class="row">
                                <!-- Orders Table -->
                                <table class="table table-bordered table-hover">
                                    <thead style="background: #404040; color:white;">
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
                                        // Query to fetch orders for the logged-in user
                                        $query_res= mysqli_query($db,"select * from users_orders where u_id='".$_SESSION['user_id']."'");
                                        if(!mysqli_num_rows($query_res) > 0 )
                                        {
                                            // Display message if no orders are found
                                            echo '<td colspan="6"><center>You have No orders Placed yet. </center></td>';
                                        }
                                        else
                                        {
                                            // Loop through each order and display in the table
                                            while($row=mysqli_fetch_array($query_res))
                                            {
                                        ?>
                                                <tr>	
                                                    <td data-column="Item"> <?php echo $row['title']; ?></td>
                                                    <td data-column="Quantity"> <?php echo $row['quantity']; ?></td>
                                                    <td data-column="price">LKR<?php echo $row['price']; ?></td>
                                                    <td data-column="status"> 
                                                        <?php 
                                                        // Display order status with appropriate styling
                                                        $status=$row['status'];
                                                        if($status=="" or $status=="NULL")
                                                        {
                                                        ?>
                                                            <button type="button" class="btn btn-info"><span class="fa fa-bars"  aria-hidden="true" ></span> Dispatch</button>
                                                        <?php 
                                                        }
                                                        if($status=="in process")
                                                        { ?>
                                                            <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true" ></span> On The Way!</button>
                                                        <?php
                                                        }
                                                        if($status=="closed")
                                                        {
                                                        ?>
                                                            <button type="button" class="btn btn-success" ><span  class="fa fa-check-circle" aria-hidden="true"></span> Delivered</button> 
                                                        <?php 
                                                        } 
                                                        ?>
                                                        <?php
                                                        if($status=="rejected")
                                                        {
                                                        ?>
                                                            <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Cancelled</button>
                                                        <?php 
                                                        } 
                                                        ?>
                                                    </td>
                                                    <td data-column="Date"> <?php echo $row['date']; ?></td>
                                                    <td data-column="Action"> 
                                                        <!-- Delete Order Button -->
                                                        <a href="delete_orders.php?order_del=<?php echo $row['o_id'];?>" onclick="return confirm('Are you sure you want to cancel your order?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                                                    </td>
                                                </tr>
                                        <?php }} ?>					
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        <footer class="footer">
            <div class="row bottom-footer">
                <div class="container">
                    <div class="row">
                        <!-- Payment Options -->
                        <div class="col-xs-12 col-sm-3 payment-options color-gray">
                            <h5>Payment Options</h5>
                            <ul>
                                <li>
                                    <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/maestro.png" alt="Maestro"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/stripe.png" alt="Stripe"> </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Address Section -->
                        <div class="col-xs-12 col-sm-4 address color-gray">
                            <h5>Address</h5>
                            <p>Templers Road, Mount Lavinia, Sri Lanka</p>
                            <h5>Phone: 071 722 2444</a></h5> 
                        </div>
                        <!-- Social Media Links -->
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
            <!-- Copyright Notice -->
            <div style="margin-top: 10px; text-align: center;">
                <p>&copy; <?php echo date("Y"); ?> The Templers Café. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Include JavaScript Files -->
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