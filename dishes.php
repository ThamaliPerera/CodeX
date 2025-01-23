<!DOCTYPE html>
<html lang="en">
<?php
// Include database connection and product action scripts
include("connection/connect.php"); 
error_reporting(0); // Disable error reporting for cleaner output
session_start(); // Start the session to access session variables
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Dishes</title>
    <!-- Include CSS files for styling -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> 
</head>
<body>
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
                        if(empty($_SESSION["user_id"])) {
                            // Display login and registration links if not logged in
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
    <div class="page-wrapper">
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="featured_foods.php">Choose Category</a></li>
                    <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
                </ul>
            </div>
        </div>        
        <?php 
        // Fetch restaurant details based on the provided restaurant ID
        $ress = mysqli_query($db, "select * from featured_food where ff_id='$_GET[res_id]'");
        $rows = mysqli_fetch_array($ress);
        ?>        
        <section class="inner-page-hero bg-image" data-image-src="images/img/restrrr.png">
            <div class="profile">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 profile-img">
                            <div class="image-wrap">
                                <!-- Display restaurant image -->
                                <figure><?php echo '<img src="admin/Res_img/'.$rows['image'].'" alt="Restaurant logo">'; ?></figure>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                            <div class="pull-left right-text white-txt">
                                <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                <p><?php echo $rows['description']; ?></p>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
        <div class="breadcrumb">
            <div class="container">
                <!-- Breadcrumbs can be added here if needed -->
            </div>
        </div>       
        <div class="container m-t-30">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                    <div class="widget widget-cart">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">Your Cart</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="order-row bg-white">
                            <div class="widget-body">
                                <?php
                                // Initialize item total for the cart
                                $item_total = 0;

                                // Loop through each item in the cart
                                foreach ($_SESSION["cart_item"] as $item) {
                                ?>									
                                    <div class="title-row">
                                        <?php echo $item["title"]; ?>
                                        <a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                                            <i class="fa fa-trash pull-right"></i>
                                        </a>
                                    </div>
                                    <div class="form-group row no-gutter">
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control b-r-0" value=<?php echo "LKR".$item["price"]; ?> readonly id="exampleSelect1">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input"> 
                                        </div>
                                    </div>
                                <?php
                                // Calculate total price for the items in the cart
                                $item_total += ($item["price"] * $item["quantity"]); 
                                }
                                ?>								  
                            </div>
                        </div>                        
                        <div class="widget-body">
                            <div class="price-wrap text-xs-center">
                                <p>TOTAL</p>
                                <h3 class="value"><strong><?php echo "LKR".$item_total; ?></strong></h3>
                                <p>Free Delivery!</p>
                                <?php
                                // Check if the cart is empty to enable/disable checkout button
                                if($item_total == 0) {
                                ?>
                                    <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check" class="btn btn-danger btn-lg disabled">Checkout</a>
                                <?php
                                } else {   
                                ?>
                                    <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check" class="btn btn-success btn-lg active">Checkout</a>
                                <?php   
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="menu-widget" id="2">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">MENU 
                                <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                                    <i class="fa fa-angle-right pull-right"></i>
                                    <i class="fa fa-angle-down pull-right"></i>
                                </a>
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="collapse in" id="popular2">
                            <?php  
                            // Prepare and execute SQL query to fetch dishes based on restaurant ID
                            $stmt = $db->prepare("select * from dishes where ff_id='$_GET[res_id]'");
                            $stmt->execute();
                            $products = $stmt->get_result();
                            if (!empty($products)) {
                                // Loop through each product and display it
                                foreach($products as $product) {
                            ?>
                                <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
                                            <form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                                <div class="rest-logo pull-left">
                                                    <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/dishes/'.$product['img'].'" alt="Food logo">'; ?></a>
                                                </div>
                                                <div class="rest-descr">
                                                    <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                                    <p><?php echo $product['slogan']; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-lg-3 pull-right item-cart-info"> 
                                                <span class="price pull-left">LKR<?php echo $product['price']; ?></span>
                                                <input class="b-r-0" type="text" name="quantity" style="margin-left:30px;" value="1" size="2" />
                                                <input type="submit" class="btn theme-btn" style="margin-left:40px;" value="Add To Cart" />
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <footer class="footer">
            <div class="container">
                <div class="row bottom-footer">
                    <div class="container">
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
            </div>
            <div style="margin-top: 10px; text-align: center;">
                <p>&copy; <?php echo date("Y"); ?> The Templers Café. All rights reserved.</p>
            </div>
        </footer>
    </div>
</div>
<!-- Modal for order confirmation -->
<div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            <div class="modal-body cart-addon">
                <div class="food-item white">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                            <div class="item-img pull-left">
                                <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                            </div>
                            <div class="rest-descr">
                                <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> 
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">LKR 2.99</span></div>
                        <div class="col-xs-6 col-sm-4 col-lg-4">
                            <div class="row no-gutter">
                                <div class="col-xs-7">
                                    <select class="form-control b-r-0" id="exampleSelect2">
                                        <option>Size SM</option>
                                        <option>Size LG</option>
                                        <option>Size XL</option>
                                    </select>
                                </div>
                                <div class="col-xs-5">
                                    <input class="form-control" type="number" value="0" id="quant-input-2"> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Additional food items can be added here -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-btn">Add To Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
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