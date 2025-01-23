<!DOCTYPE html>
<html lang="en">
<?php
// Include database connection
include("connection/connect.php");  
error_reporting(0);  // Disable error reporting for cleaner output
session_start(); // Start the session to access session variables
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Home</title>
    <!-- Include CSS files for styling -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/reservation.css" rel="stylesheet"> <!-- Additional CSS for reservation -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="home">
    
    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php">The Templers Café</a>
                <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="featured_foods.php">Category <span class="sr-only"></span></a> </li>
                        
                        <?php
                        // Check if the user is logged in
                        if(empty($_SESSION["user_id"])) { // If user is not logged in
                            // Display login and registration links
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                                  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                        } else {
                            // Display user-specific links if logged in
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

    <section class="hero bg-image" data-image-src="images/img/gallery-5.jpg">
        <div class="hero-inner">
            <div class="container text-center hero-text font-white">
                <h1>Order Delivery & Take-Out </h1>
                <div class="banner-form">
                    <form class="form-inline">
                        <!-- Form for searching or filtering can be added here -->
                    </form>
                </div>
            </div>
        </div>
    </section>
      
    <section class="popular">
        <div class="container">
            <div class="title text-xs-center m-b-30">
                <h2>Popular Meals and Drinks of the Month</h2>
                <p class="lead">Easiest way to order your favourite food among these top 4</p>
            </div>
            <div class="row">
                <?php 					
                // Query to fetch the top 4 dishes
                $query_res = mysqli_query($db, "select * from dishes LIMIT 4"); 
                while($r = mysqli_fetch_array($query_res)) {
                    // Display each popular meal
                    echo '  <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                                <div class="food-item-wrap">
                                    <div class="figure-wrap bg-image" data-image-src="admin/Res_img/dishes/'.$r['img'].'"></div>
                                    <div class="content">
                                        <h5><a href="dishes.php?res_id='.$r['ff_id'].'">'.$r['title'].'</a></h5>
                                        <div class="product-name">'.$r['slogan'].'</div>
                                        <div class="price-btn-block"> <span class="price">LKR'.$r['price'].'</span> <a href="dishes.php?res_id='.$r['ff_id'].'" class="btn theme-btn-dash pull-right">Order Now</a> </div>
                                    </div>
                                </div>
                            </div>';                                      
                }	
                ?>
            </div>
        </div>
    </section>
    
    <title>Table Reservation</title>
</head>
<body>
    <div class="reservation-container">
        <div class="form-header">
            <h2>Table Reservation</h2>
            <p>Please fill out the form below to reserve your table</p>
        </div>

        <form action="/submit-reservation" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="guests">Number of Guests</label>
                <select id="guests" name="guests" required>
                    <option value="">Select number of guests</option>
                    <option value="1">1 Person</option>
                    <option value="2">2 People</option>
                    <option value="3">3 People</option>
                    <option value="4">4 People</option>
                    <option value="5">5 People</option>
                    <option value="6">6 People</option>
                    <option value="7+">7+ People</option>
                </select>
            </div>

            <div class="time-date-group">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
                </div>

                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="time" id="time" name="time" required>
                </div>
            </div>

            <div class="form-group">
                <label for="special-requests">Special Requests (Optional)</label>
                <textarea id="special-requests" name="special-requests"></textarea>
            </div>

            <button type="submit" class="submit-btn">Reserve Table</button>
        </form>
    </div>

    
    
    <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
        <iframe style="border:0; width: 100%; height: 400px;" 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.8399200294716!2d79.86742651390722!3d6.831317811039445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25a9b72577e7f%3A0x32c96cb04e88e407!2s37%20A%20Templers%20Rd%2C%20Dehiwala-Mount%20Lavinia!5e0!3m2!1sen!2slk!4v1676961268712!5m2!1sen!2slk" 
            frameborder="0" 
            allowfullscreen="" 
            loading="eager" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div><!-- End Google Maps -->
      
    <footer class="footer">
        <div class="container">
            <div class="bottom-footer">
                <div class="row">
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
    
    <!-- Include JavaScript files for functionality -->
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