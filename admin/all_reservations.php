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
    <title>All Reservations</title> <!-- Page title -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="css/helper.css" rel="stylesheet"> <!-- Helper CSS -->
    <link href="css/style.css" rel="stylesheet"> <!-- Custom style CSS -->
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
            
                    <ul class="navbar-nav mr-auto mt-md-0"> <!-- Left side navbar items -->
                    </ul>
            
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
                        <li> <a href="dashboard.php"><i class="f-s-20 "></i><span>Dashboard</span></a></li> <!-- Dashboard link -->
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
                        <div class="col-lg-12"> <!-- Column for reservations table -->
                            <div class="card card-outline-primary"> <!-- Card for reservations section -->
                                <div class="card-header"> <!-- Card header -->
                                    <h4 class="m-b-0 text-white">All Reservations</h4> <!-- Title for reservations section -->
                                </div>
                                <div class="table-responsive m-t-40"> <!-- Responsive table -->
                                    <table id="myTable" class="table table-bordered table-striped table-hover"> <!-- Table for displaying reservations -->
                                        <thead class="thead-dark"> <!-- Table header -->
                                            <tr>
                                                <th>Name</th> <!-- name column -->
                                                <th>Email</th> <!-- Email column -->
                                                <th>Phone</th> <!-- Phone column -->
                                                <th>Guests</th> <!-- Guests column -->
                                                <th>Date</th> <!-- date column -->
                                                <th>Time</th> <!-- Time column -->
                                                <th>Special-Requests</th> <!-- special-requests column -->
                                                <th>Action</th> <!-- Action column -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // Query to select all reservations from the database
                                                $sql = "SELECT * FROM reservations ORDER BY id DESC";
                                                $query = mysqli_query($db, $sql);
                                                
                                                // Check if there are no reservations
                                                if (!mysqli_num_rows($query) > 0) {
                                                    echo '<td colspan="8"><center>No Reservations</center></td>'; // Display message if no reservations
                                                } else {				
                                                    // Loop through each reservation and display their details
                                                    while ($rows = mysqli_fetch_array($query)) {
                                                        echo '<tr>
                                                                <td>' . htmlspecialchars($rows['name']) . '</td>
                                                                <td>' . htmlspecialchars($rows['email']) . '</td>
                                                                <td>' . htmlspecialchars($rows['phone']) . '</td>
                                                                <td>' . htmlspecialchars($rows['guests']) . '</td>
                                                                <td>' . htmlspecialchars($rows['date']) . '</td>
                                                                <td>' . htmlspecialchars($rows['time']) . '</td>
                                                                <td>' . htmlspecialchars($rows['special_requests']) . '</td>
                                                                <td>
                                                                    <a href="delete_reservations.php?reservation_del=' . $rows['id'] . '" 
                               class="btn btn-danger btn-flat btn-addon btn-xs m-b-10" 
                               onclick="return confirm(\'Are you sure you want to delete this reservation?\');">
                               <i class="fa fa-trash-o" style="font-size:16px"></i> Delete
                            </a> 
                                                                    <a href="update_reservations.php?reserv_upd=' . $rows['id'] . '" 
                               class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5">
                               <i class="fa fa-edit"></i> Edit
                            </a>
                                                                </td>
                                                            </tr>'; // Display reservation details in table row
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
            </div>
            <footer class="footer"> © 2025 - The Templers Cafe</footer> <!-- Footer section -->
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