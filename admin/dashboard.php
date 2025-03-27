<!DOCTYPE html>
<html lang="en">
<?php
// Include the database connection file
include("../connection/connect.php");
// Disable error reporting
error_reporting(0);
// Start the session
session_start();
// Check if the admin ID is not set in the session, redirect to the login page
if (empty($_SESSION["adm_id"])) {
    header('location:index.php');
    exit(); // Exit the script after redirection
}
?>
<head>
    <meta charset="utf-8"> <!-- Set character encoding -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Set compatibility for Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive design -->
    <meta name="description" content=""> <!-- Page description -->
    <meta name="author" content=""> <!-- Author of the page -->
    <title>Admin Panel</title> <!-- Page title -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="css/helper.css" rel="stylesheet"> <!-- Helper CSS -->
    <link href="css/style.css" rel="stylesheet"> <!-- Custom style CSS -->
</head>

<body class="fix-header"> <!-- Body with fixed header -->

    <div class="preloader"> <!-- Preloader for loading animation -->
        <svg class="circular" viewBox="25 25 50 50"> <!-- SVG for circular loader -->
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>
    
    <div id="main-wrapper"> <!-- Main wrapper for the page layout -->
        <div class="header"> <!-- Header section -->
            <nav class="navbar top-navbar navbar-expand-md navbar-light"> <!-- Navigation bar -->
                <div class="navbar-header"> <!-- Navbar header -->
                    <a class="navbar-brand" href="dashboard.php">
                         THE TEMPLERS CAFE
                    </a> <!-- Brand name -->
                </div>

                <div class="navbar-collapse"> <!-- Navbar collapse for responsive design -->
                    <ul class="navbar-nav mr-auto mt-md-0"></ul> <!-- Left side navbar items -->
                    <li class="nav-item dropdown"> <!-- Dropdown for user profile -->
                        <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" /> <!-- User profile picture -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right animated zoomIn"> <!-- Dropdown menu for user actions -->
                            <ul class="dropdown-user">
                                <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li> <!-- Logout link -->
                            </ul>
                        </div>
                    </li>
                </div>
            </nav>
        </div>
   
        <div class="left-sidebar"> <!-- Left sidebar section -->
            <div class="scroll-sidebar"> <!-- Scrollable sidebar -->
                <nav class="sidebar-nav"> <!-- Sidebar navigation -->
                    <ul id="sidebarnav"> <!-- Sidebar menu items -->
                        <li class="nav-devider"></li> <!-- Divider -->
                        <li class="nav-label">Home</li> <!-- Home label -->
                        <li><a href="dashboard.php"><i class="f-s-20"></i><span>Dashboard</span></a></li> <!-- Dashboard link -->
                        <li class="nav-label">Log</li> <!-- Log label -->
                        <li><a href="all_users.php"><span><i class="f-s-20"></i></span><span>Users</span></a></li> <!-- Users link -->
                        <li><a href="all_reservations.php"><span><i class="f-s-20"></i></span><span>Reservations</span></a></li> <!-- Reservations link -->
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <i class="f-s-20 color-warning"></i><span class="hide-menu">Featured Foods</span>
                            </a>
                            <ul aria-expanded="false" class="collapse"> <!-- Submenu for featured foods -->
                                <li><a href="all_featured_foods.php">All Featured Foods</a></li> <!-- All featured foods link -->
                                <li><a href="add_featured_foods.php">Add Featured Foods</a></li> <!-- Add featured foods link -->
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <i aria-hidden="true"></i><span class="hide-menu">Menu</span>
                            </a>
                            <ul aria-expanded="false" class="collapse"> <!-- Submenu for menu -->
                                <li><a href="all_menu.php">All Menus</a></li> <!-- All menus link -->
                                <li><a href="add_menu.php">Add Menu</a></li> <!-- Add menu link -->
                            </ul>
                        </li>
                        <li><a href="all_orders.php"><i aria-hidden="true"></i><span>Orders</span></a></li> <!-- Orders link -->
                    </ul>
                </nav>
            </div>
        </div>

        <div class="page-wrapper"> <!-- Main content area -->
            <div class="container-fluid"> <!-- Container for fluid layout -->
                <div class="col-lg-12"> <!-- Column for dashboard content -->
                    <div class="card card-outline-primary"> <!-- Card for dashboard section -->
                        <div class="card-header"> <!-- Card header -->
                            <h4 class="m-b-0 text-white">Admin Dashboard</h4> <!-- Title for admin dashboard -->
                        </div>
                        <div class="row"> <!-- Row for dashboard statistics -->
                            <div class="col-md-3"> <!-- Column for featured foods count -->
                                <div class="card p-30"> <!-- Card for displaying featured foods count -->
                                    <div class="media"> <!-- Media object for layout -->
                                        <div class="media-left meida media-middle"> <!-- Left media section -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                                                <path d="M2 2a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v1H2V2zm0 2h12v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4zm1 1v9h10V5H3z"/>
                                            </svg>
                                        </div>
                                        <div class="media-body media-text-right"> <!-- Right media section -->
                                            <h2><?php 
                                                // Query to count featured foods
                                                $sql = "SELECT * FROM featured_food";
                                                $result = mysqli_query($db, $sql); 
                                                $rws = mysqli_num_rows($result); // Get the number of rows
                                                echo $rws; // Display the count
                                            ?></h2>
                                            <p class="m-b-0">Featured Foods</p> <!-- Label for featured foods -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3"> <!-- Column for dishes count -->
                                <div class="card p-30"> <!-- Card for displaying dishes count -->
                                    <div class="media"> <!-- Media object for layout -->
                                        <div class="media-left meida media-middle"> <!-- Left media section -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-knife" viewBox="0 0 16 16">
                                                <path d="M1.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-.5.5H0V0h1.5zM15.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-.5.5h-1V0h1z"/>
                                            </svg>
                                        </div>
                                        <div class="media-body media-text-right"> <!-- Right media section -->
                                            <h2><?php 
                                                // Query to count dishes
                                                $sql = "SELECT * FROM dishes";
                                                $result = mysqli_query($db, $sql); 
                                                $rws = mysqli_num_rows($result); // Get the number of rows
                                                echo $rws; // Display the count
                                            ?></h2>
                                            <p class="m-b-0">Dishes</p> <!-- Label for dishes -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3"> <!-- Column for users count -->
                                <div class="card p-30"> <!-- Card for displaying users count -->
                                    <div class="media"> <!-- Media object for layout -->
                                        <div class="media-left meida media-middle"> <!-- Left media section -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                <path d="M3 14s-1 0-1-1 1-1 1-1h10s1 0 1 1-1 1-1 1H3zm8-8a3 3 0 1 0-6 0 3 3 0 0 0 6 0z"/>
                                            </svg>
                                        </div>
                                        <div class="media-body media-text-right"> <!-- Right media section -->
                                            <h2><?php 
                                                // Query to count users
                                                $sql = "SELECT * FROM users";
                                                $result = mysqli_query($db, $sql); 
                                                $rws = mysqli_num_rows($result); // Get the number of rows
                                                echo $rws; // Display the count
                                            ?></h2>
                                            <p class="m-b-0">Users</p> <!-- Label for users -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3"> <!-- Column for total orders count -->
                                <div class="card p-30"> <!-- Card for displaying total orders count -->
                                    <div class="media"> <!-- Media object for layout -->
                                        <div class="media-left meida media-middle"> <!-- Left media section -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                                <path d="M5.5 0a.5.5 0 0 1 .5.5v1h5V.5a.5.5 0 0 1 1 0v1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1h-1.5l-1.5 8H4.5l-1.5-8H1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h1.5V.5a.5.5 0 0 1 .5-.5zM4.5 3l1.5 8h5l1.5-8H4.5z"/>
                                            </svg>
                                        </div>
                                        <div class="media-body media-text-right"> <!-- Right media section -->
                                            <h2><?php 
                                                // Query to count total orders
                                                $sql = "SELECT * FROM users_orders";
                                                $result = mysqli_query($db, $sql); 
                                                $rws = mysqli_num_rows($result); // Get the number of rows
                                                echo $rws; // Display the count
                                            ?></h2>
                                            <p class="m-b-0">Total Orders</p> <!-- Label for total orders -->
                                        </div>
                                    </div>
                                </div>
                            </div>	                   
                        </div>     
                        
                        <div class="row"> <!-- Row for order status statistics -->
                            <div class="col-md-4"> <!-- Column for processing orders count -->
                                <div class="card p-30"> <!-- Card for displaying processing orders count -->
                                    <div class="media"> <!-- Media object for layout -->
                                        <div class="media-left meida media-middle"> <!-- Left media section -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                                <path d="M8 3a5 5 0 1 0 5 5h-1a4 4 0 1 1-4-4V3z"/>
                                                <path fill-rule="evenodd" d="M8 0a8 8 0 1 1-8 8h1a7 7 0 1 0 7-7V0z"/>
                                            </svg>
                                        </div>
                                        <div class="media-body media-text-right"> <!-- Right media section -->
                                            <h2><?php 
                                                // Query to count processing orders
                                                $sql = "SELECT * FROM users_orders WHERE status = 'in process'";
                                                $result = mysqli_query($db, $sql); 
                                                $rws = mysqli_num_rows($result); // Get the number of rows
                                                echo $rws; // Display the count
                                            ?></h2>
                                            <p class="m-b-0">Processing Orders</p> <!-- Label for processing orders -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4"> <!-- Column for delivered orders count -->
                                <div class="card p-30"> <!-- Card for displaying delivered orders count -->
                                    <div class="media"> <!-- Media object for layout -->
                                        <div class="media-left meida media-middle"> <!-- Left media section -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zm3.5 5.5a.5.5 0 0 0-.7 0L8 9.293 5.207 6.5a.5.5 0 0 0-.707.707l3 3a.5.5 0 0 0 .707 0l4-4a.5.5 0 0 0 0-.707z"/>
                                            </svg>
                                        </div>
                                        <div class="media-body media-text-right"> <!-- Right media section -->
                                            <h2><?php 
                                                // Query to count delivered orders
                                                $sql = "SELECT * FROM users_orders WHERE status = 'closed'";
                                                $result = mysqli_query($db, $sql); 
                                                $rws = mysqli_num_rows($result); // Get the number of rows
                                                echo $rws; // Display the count
                                            ?></h2>
                                            <p class="m-b-0">Delivered Orders</p> <!-- Label for delivered orders -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4"> <!-- Column for cancelled orders count -->
                                <div class="card p-30"> <!-- Card for displaying cancelled orders count -->
                                    <div class="media"> <!-- Media object for layout -->
                                        <div class="media-left meida media-middle"> <!-- Left media section -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zm3.5 5.5a.5.5 0 0 0-.7 0L8 8.293 5.207 5.5a.5.5 0 0 0-.707.707l3 3a.5.5 0 0 0 .707 0l4-4a.5.5 0 0 0 0-.707z"/>
                                            </svg>
                                        </div>
                                        <div class="media-body media-text-right"> <!-- Right media section -->
                                            <h2><?php 
                                                // Query to count cancelled orders
                                                $sql = "SELECT * FROM users_orders WHERE status = 'rejected'";
                                                $result = mysqli_query($db, $sql); 
                                                $rws = mysqli_num_rows($result); // Get the number of rows
                                                echo $rws; // Display the count
                                            ?></h2>
                                            <p class="m-b-0">Cancelled Orders</p> <!-- Label for cancelled orders -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row"> <!-- Row for total earnings -->
                            <div class="col-md-4"> <!-- Column for total earnings -->
                                <div class="card p-30"> <!-- Card for displaying total earnings -->
                                    <div class="media"> <!-- Media object for layout -->
                                        <div class="media-left meida media-middle"> <!-- Left media section -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                                                <path d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3zm2 0h12v10H2V3z"/>
                                                <path d="M4 5h8v2H4V5zm0 3h8v2H4V8z"/>
                                            </svg>
                                        </div>
                                        <div class="media-body media-text-right"> <!-- Right media section -->
                                            <h2><?php 
                                                // Query to calculate total earnings from closed orders
                                                $result = mysqli_query($db, 'SELECT SUM(price) AS value_sum FROM users_orders WHERE status = "closed"'); 
                                                $row = mysqli_fetch_assoc($result); 
                                                $sum = $row['value_sum']; // Get the total earnings
                                                echo $sum; // Display the total earnings
                                            ?></h2>
                                            <p class="m-b-0">Total Earnings</p> <!-- Label for total earnings -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4"> <!-- Column for reservation count -->
                                <div class="card p-30"> <!-- Card for displaying reservations count -->
                                    <div class="media"> <!-- Media object for layout -->
                                        <div class="media-left meida media-middle"> <!-- Left media section -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h9V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H1a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10h14V4H1z"/>
                                            </svg>
                                        </div>
                                        <div class="media-body media-text-right"> <!-- Right media section -->
                                            <h2><?php 
                                                // Query to count reservations
                                                $sql = "SELECT * FROM reservations";
                                                $result = mysqli_query($db, $sql); 
                                                $rws = mysqli_num_rows($result); // Get the number of rows
                                                echo $rws; // Display the count
                                            ?></h2>
                                            <p class="m-b-0">Reservations</p> <!-- Label for reservations -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>     
            </div>
        </div>   
    </div>
   
    <script src="js/lib/jquery/jquery.min.js"></script> <!-- jQuery library -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script> <!-- Bootstrap Popper.js -->
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JavaScript -->
    <script src="js/jquery.slimscroll.js"></script> <!-- Slimscroll for custom scrollbar -->
    <script src="js/sidebarmenu.js"></script> <!-- Sidebar menu script -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script> <!-- Sticky kit for sticky elements -->
    <script src="js/custom.min.js"></script> <!-- Custom JavaScript -->
</body>

</html>
<?php
// End of the PHP script
?>