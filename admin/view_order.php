<!DOCTYPE html>
<html lang="en">
<?php
// Include the database connection file
include("../connection/connect.php");
// Disable error reporting
error_reporting(0);
// Start the session
session_start();
?>
<head>
    <meta charset="utf-8"> <!-- Set character encoding -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Set compatibility for Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive design -->
    <meta name="description" content=""> <!-- Page description -->
    <meta name="author" content=""> <!-- Author of the page -->
    <title>View Order</title> <!-- Page title -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="css/helper.css" rel="stylesheet"> <!-- Helper CSS -->
    <link href="css/style.css" rel="stylesheet"> <!-- Custom style CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- jQuery library -->
    <script language="javascript" type="text/javascript">
        var popUpWin=0; // Variable to hold the popup window reference
        function popUpWindow(URLStr, left, top, width, height) {
            // Close the popup window if it already exists
            if(popUpWin) {
                if(!popUpWin.closed) popUpWin.close();
            }
            // Open a new popup window with specified dimensions
            popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+1000+',height='+1000+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
        }
    </script>
</head>

<body class="fix-header fix-sidebar"> <!-- Body with fixed header and sidebar -->
    
    <div class="preloader"> <!-- Preloader for loading animation -->
        <svg class="circular" viewBox="25 25 50 50"> <!-- SVG for circular loader -->
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>
   
    <div id="main-wrapper"> <!-- Main wrapper for the page layout -->

        <div class="header"> <!-- Header section -->
            <nav class="navbar top-navbar navbar-expand-md navbar-light"> <!-- Navigation bar -->
                <div class="navbar-header"> <!-- Navbar header -->
                    <a class="navbar-brand" href="dashboard.php">THE TEMPLERS CAFE</a> <!-- Brand name -->
                </div>
                <div class="navbar-collapse"> <!-- Navbar collapse for responsive design -->
                    <ul class="navbar-nav mr-auto mt-md-0"></ul> <!-- Left side navbar items -->
                    <ul class="navbar-nav my-lg-0"> <!-- Right side navbar items -->
                        <li class="nav-item dropdown"> <!-- Dropdown for notifications -->
                            <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn"> <!-- Dropdown menu -->
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div> <!-- Title for notifications -->
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a> <!-- Link to check notifications -->
                                    </li>
                                </ul>
                            </div>
                        </li>
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
                    </ul>
                </div>
            </nav>
        </div>

        <div class="left-sidebar"> <!-- Left sidebar section -->
            <div class="scroll-sidebar"> <!-- Scrollable sidebar -->
                <nav class="sidebar-nav"> <!-- Sidebar navigation -->
                   <ul id="sidebarnav"> <!-- Sidebar menu items -->
                        <li class="nav-devider"></li> <!-- Divider -->
                        <li class="nav-label">Home</li> <!-- Home label -->
                        <li> <a href="dashboard.php"><i class="f-s-20"></i><span>Dashboard</span></a></li> <!-- Dashboard link -->
                        <li class="nav-label">Log</li> <!-- Log label -->
                        <li> <a href="all_users.php">  <span><i class="f-s-20 "></i></span><span>Users</span></a></li> <!-- Users link -->
                        <li><a href="all_reservations.php"><span><i class="f-s-20"></i></span><span>Reservations</span></a></li> <!-- Reservations link -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="f-s-20 color-warning"></i><span class="hide-menu">Featured Foods</span></a>
                            <ul aria-expanded="false" class="collapse"> <!-- Submenu for featured foods -->
                                <li><a href="all_featured_foods.php">All Featured Foods</a></li> <!-- All featured foods link -->
                                <li><a href="add_featured_foods.php">Add Featured Foods</a></li> <!-- Add featured foods link -->
                            </ul>
                        </li>
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse"> <!-- Submenu for menu -->
                                <li><a href="all_menu.php">All Menus</a></li> <!-- All menus link -->
                                <li><a href="add_menu.php">Add Menu</a></li> <!-- Add menu link -->
                            </ul>
                        </li>
                        <li> <a href="all_orders.php"><i aria-hidden="true"></i><span>Orders</span></a></li> <!-- Orders link -->
                    </ul>
                </nav>
            </div>
        </div>
    
        <div class="page-wrapper"> <!-- Main content area -->
            <div class="container-fluid"> <!-- Container for fluid layout -->
                <div class="row"> <!-- Row for layout -->
                    <div class="col-12"> <!-- Full width column -->
                        <div class="col-lg-12"> <!-- Column for order details -->
                            <div class="card card-outline-primary"> <!-- Card for displaying order details -->
                                <div class="card-header"> <!-- Card header -->
                                    <h4 class="m-b-0 text-white">View Order</h4> <!-- Title for view order section -->
                                </div>
                                <div class="table-responsive m-t-20"> <!-- Responsive table -->
                                    <table id="myTable" class="table table-bordered table-striped"> <!-- Table for displaying order information -->
                                        <tbody>
                                           <?php
                                           // Query to fetch order details based on the order ID
                                           $sql = "SELECT users.*, users_orders.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id WHERE o_id='" . $_GET['user_upd'] . "'";
                                           $query = mysqli_query($db, $sql); // Execute the query
                                           $rows = mysqli_fetch_array($query); // Fetch the result as an associative array
                                           ?>
                                           
                                           <tr>
                                                <td><strong>Username:</strong></td> <!-- Label for username -->
                                                <td><center><?php echo $rows['username']; ?></center></td> <!-- Display username -->
                                                <td><center>
                                                    <a href="javascript:void(0);" onClick="popUpWindow('order_update.php?form_id=<?php echo htmlentities($rows['o_id']); ?>');" title="Update order">
                                                        <button type="button" class="btn btn-primary">Update Order Status</button></a> <!-- Button to update order status -->
                                                </center></td>
                                           </tr>	
                                           <tr>
                                                <td><strong>Title:</strong></td> <!-- Label for order title -->
                                                <td><center><?php echo $rows['title']; ?></center></td> <!-- Display order title -->
                                                <td><center>
                                                    <a href="javascript:void(0);" onClick="popUpWindow('userprofile.php?newform_id=<?php echo htmlentities($rows['o_id']); ?>');" title="View user details">
                                                        <button type="button" class="btn btn-primary">View User Details</button></a> <!-- Button to view user details -->
                                                </center></td>
                                           </tr>	
                                           <tr>
                                                <td><strong>Quantity:</strong></td> <!-- Label for quantity -->
                                                <td><center><?php echo $rows['quantity']; ?></center></td> <!-- Display quantity -->
                                           </tr>
                                           <tr>
                                                <td><strong>Price:</strong></td> <!-- Label for price -->
                                                <td><center>LKR<?php echo $rows['price']; ?></center></td> <!-- Display price -->
                                           </tr>
                                           <tr>
                                                <td><strong>Address:</strong></td> <!-- Label for address -->
                                                <td><center><?php echo $rows['address']; ?></center></td> <!-- Display address -->
                                           </tr>
                                           <tr>
                                                <td><strong>Date:</strong></td> <!-- Label for date -->
                                                <td><center><?php echo $rows['date']; ?></center></td> <!-- Display date -->
                                           </tr>
                                           <tr>
                                                <td><strong>Status:</strong></td> <!-- Label for status -->
                                                <?php 
                                                $status = $rows['status']; // Get the order status
                                                if ($status == "" || $status == "NULL") { ?>
                                                    <td><center><button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span> Dispatch</button></center></td> <!-- Button for dispatch -->
                                                <?php } elseif ($status == "in process") { ?>
                                                    <td><center><button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> On the Way!</button></center></td> <!-- Button for in process -->
                                                <?php } elseif ($status == "closed") { ?>
                                                    <td><center><button type="button" class="btn btn-primary"><span class="fa fa-check-circle" aria-hidden="true"></span> Delivered</button></center></td> <!-- Button for delivered -->
                                                <?php } elseif ($status == "rejected") { ?>
                                                    <td><center><button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Cancelled</button></center></td> <!-- Button for cancelled -->
                                                <?php } ?>
                                           </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
            <footer class="footer"> © 2025 - The Templers Cafe </footer> <!-- Footer section -->
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