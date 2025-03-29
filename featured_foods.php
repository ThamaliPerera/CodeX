<!DOCTYPE html>
<html lang="en">
<?php
// Include database connection
include("connection/connect.php");
// Suppress error reporting
error_reporting(0);
// Start session management
session_start();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icn.png" type="image/x-icon"><!--favicon-->
    <title>Featured Foods</title>
    <!-- Include CSS files for styling -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/reservation.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> <!-- Bootstrap Icons -->
</head>

<body>

    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <!-- Navbar toggler for mobile view -->
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php">The Templers Café</a>
                <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="featured_foods.php">Category <span class="sr-only"></span></a> </li>
                        
                        <?php
                        // Check if user is logged in
                        if(empty($_SESSION["user_id"])) {
                            // Show login and registration links
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                                  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                        } else {
                            // Show user-specific links
                            echo '<li class="nav-item"><a href="loyalty-system.php" class="nav-link active">Loyalty</a> </li>';
                            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                            echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
<!--top link section-->
    <div class="page-wrapper">
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="#">Choose Category</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
                </ul>
            </div>
        </div>

        <div class="inner-page-hero bg-image" data-image-src="images/img/pimg.jpg">
            <div class="container"> </div>
        </div>

        <div class="result-show">
            <div class="container">
                <div class="row">     
                </div>
            </div>
        </div>

        <section class="restaurants-page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                        <div class="bg-gray restaurant-entry">
                            <div class="row">
                                <?php 
                                // Fetch featured food items from the database
                                $ress = mysqli_query($db, "select * from featured_food");
                                while($rows = mysqli_fetch_array($ress)) {
                                    // Display each featured food item
                                    echo '<div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                            <div class="entry-logo">
                                                <a class="img-fluid" href="dishes.php?res_id='.$rows['ff_id'].'"> <img src="admin/Res_img/'.$rows['image'].'" alt="Food logo"></a>
                                            </div>
                                            <div class="entry-dscr">
                                                <h5><a href="dishes.php?res_id='.$rows['ff_id'].'">'.$rows['title'].'</a></h5> <span>'.$rows['description'].'</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                            <div class="right-content bg-white">
                                                <div class="right-review">
                                                    <a href="dishes.php?res_id='.$rows['ff_id'].'" class="btn btn-purple">View Menu</a>
                                                </div>
                                            </div>
                                        </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       <!--footer section-->
        <footer class="footer">
            <div class="container">
                <div class="bottom-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 payment-options color-gray">
                            <h5>Payment Options</h5>
                            <ul>
                                <li>
                                    <a href="#"><img src="images/mastercard.png" alt="Mastercard"></a>
                                </li>
                                <li>
                                    <a href="#"><img src="images/maestro.png" alt="Maestro"></a>
                                </li>
                                <li>
                                    <a href="#"><img src="images/stripe.png" alt="Stripe"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-4 address color-gray">
                            <h5>Address</h5>
                            <p>Templers Road, Mount Lavinia, Sri Lanka</p>
                            <h5>Phone: 071 722 2444</h5>
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
            <div style="margin-top: 10px; text-align: center;">
                <p>&copy; <?php echo date("Y"); ?> The Templers Café. All rights reserved.</p>
            </div>
        </footer>
        
     <!--js files-->
        <script src="js/jquery.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/animsition.min.js"></script>
        <script src="js/bootstrap-slider.min.js"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <script src="js/headroom.js"></script>
        <script src="js/foodpicky.min.js"></script>
    </body>
</html> ⬤