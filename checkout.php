<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();

function function_alert() { 
    echo "<script>alert('Thank you. Your Order has been placed!');</script>"; 
    echo "<script>window.location.replace('your_orders.php');</script>"; 
} 

if(empty($_SESSION["user_id"])) {
    header('location:login.php');
} else {
    $item_total = 0; // Initialize item total
    $delivery_charge = 400; // Fixed delivery charge

    foreach ($_SESSION["cart_item"] as $item) {
        $item_total += ($item["price"] * $item["quantity"]);
        
        if($_POST['submit']) {
            $SQL = "INSERT INTO users_orders(u_id, title, quantity, price) VALUES('".$_SESSION["user_id"]."', '".$item["title"]."', '".$item["quantity"]."', '".$item["price"]."')";
            mysqli_query($db, $SQL);
            
            unset($_SESSION["cart_item"]);
            $success = "Thank you. Your order has been placed!";
            function_alert();
        }
    }
?>
<!--header section-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icn.png" type="image/x-icon"><!--favicon-->
    <title>Checkout</title>
    <!--css files-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/reservation.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="site-wrapper">
        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php">The Templers Café</a>
                    <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"><a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a></li>
                            <li class="nav-item"><a class="nav-link active" href="featured_foods.php">Category <span class="sr-only"></span></a></li>
                            
                            <?php
                            //shows when user logs out
                            if (empty($_SESSION["user_id"])) {
                                echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a></li>
                                      <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a></li>';
                                      //shows if user login only
                            } else {
                                echo '<li class="nav-item"><a href="loyalty-system.php" class="nav-link active">Loyalty</a></li>';
                                echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a></li>';
                                echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a></li>';
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
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="#">Choose Category</a></li>
                        <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="#">Order and Pay</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="container">
                <span style="color:green;">
                    <?php echo $success; ?>
                </span>
            </div>

            <!--cart summary-->
            <div class="container m-t-30">
                <form action="" method="post">
                    <div class="widget clearfix">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Cart Summary</h4>
                                        </div>
                                        <div class="cart-totals-fields">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Cart Subtotal</td>
                                                        <td><?php echo "LKR " . $item_total; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Delivery Charges</td>
                                                        <td><?php echo "LKR " . $delivery_charge; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        <td class="text-color"><strong><?php echo "LKR " . ($item_total + $delivery_charge); ?></strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="payment-option">
                                        <ul class="list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio m-b-20">
                                                    <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> 
                                                    <span class="custom-control-indicator"></span> 
                                                    <span class="custom-control-description">Cash on Delivery</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio m-b-10">
                                                    <input name="mod" type="radio" value="visa" class="custom-control-input" onclick="window.location.href='cardpayment.php';"> 
                                                    <span class="custom-control-indicator"></span> 
                                                    <span class="custom-control-description">Card Payment <img src="images/paypal.jpg" alt="" width="90"></span> 
                                                </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> 
                                            <input type="submit" onclick="return confirm('Do you want to confirm the order?');" name="submit" class="btn btn-success btn-block" value="Order Now"> 
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!--footer section-->
            <footer class="footer">
                <div class="container">
                    <div class="bottom-footer">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 payment-options color-gray">
                                <h5>Payment Options</h5>
                                <ul>
                                    <li><a href="#"><img src="images/mastercard.png" alt="Mastercard"></a></li>
                                    <li><a href="#"><img src="images/maestro.png" alt="Maestro"></a></li>
                                    <li><a href="#"><img src="images/stripe.png" alt="Stripe"></a></li>
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
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <a href="https://www.instagram.com/thetemplerscafe?igsh=MXF1N3dxN3hhbXYw" class="instagram" target="_blank" rel="noopener noreferrer">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 10px; text-align: center;">
                        <p>&copy; <?php echo date("Y"); ?> The Templers Café. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

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
</html>

<?php
}
?>