<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php"); // Include the database connection file
error_reporting(0); // Suppress error reporting
session_start(); // Start the session to access session variables
?>
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Compatibility with Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive design settings -->
    <meta name="description" content=""> <!-- Description for SEO -->
    <meta name="author" content=""> <!-- Author meta tag -->
    <title>All Users</title> <!-- Title of the page -->
    
    <!-- CSS files for styling -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="css/helper.css" rel="stylesheet"> <!-- Helper CSS for additional styles -->
    <link href="css/style.css" rel="stylesheet"> <!-- Custom styles -->
</head>

<body class="fix-header fix-sidebar"> <!-- Body with fixed header and sidebar -->
 
    <div class="preloader"> <!-- Preloader for loading animation -->
        <svg class="circular" viewBox="25 25 50 50"> <!-- SVG for circular preloader -->
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>
    
    <div id="main-wrapper"> <!-- Main wrapper for the page content -->

        <div class="header"> <!-- Header section -->
            <nav class="navbar top-navbar navbar-expand-md navbar-light"> <!-- Navigation bar -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php"> <!-- Brand name linking to dashboard -->
                        THE TEMPLERS CAFE
                    </a>
                </div>
                <div class="navbar-collapse"> <!-- Collapsible part of the navbar -->
                    <ul class="navbar-nav mr-auto mt-md-0"> <!-- Left side of the navbar -->
                        <!-- Additional items can be added here -->
                    </ul>
                    <ul class="navbar-nav my-lg-0"> <!-- Right side of the navbar -->
                        <li class="nav-item dropdown"> <!-- Notifications dropdown -->
                            <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div> <!-- Title for notifications -->
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown"> <!-- User profile dropdown -->
                            <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" /> <!-- User profile picture -->
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li> <!-- Logout option -->
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
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php">  <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li> <!-- Users link -->
                        
                        
                        
                    </ul>
                </nav>
            </div>
        </div>

        <div class="page-wrapper"> <!-- Main content area -->
            <div class="container-fluid"> <!-- Container for fluid layout -->
                <div class="row">
                    <div class="col-12"> <!-- Full width column -->
                        <div class="col-lg-12"> <!-- Column for the card -->
                            <div class="card card-outline-primary"> <!-- Card for displaying users -->
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">All Users</h4> <!-- Card title -->
                                </div>
                                <div class="table-responsive m-t-40"> <!-- Responsive table -->
                                    <table id="myTable" class="table table-bordered table-striped table-hover"> <!-- Table for user data -->
                                        <thead class="thead-dark"> <!-- Table header -->
                                            <tr>
                                                <th>Username</th>
                                                <th>FirstName</th>
                                                <th>LastName</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Reg-Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // SQL query to fetch all users
                                                $sql = "SELECT * FROM users ORDER BY u_id DESC";
                                                $query = mysqli_query($db, $sql); // Execute the query
                                                
                                                // Check if there are no users
                                                if(!mysqli_num_rows($query) > 0) {
                                                    echo '<td colspan="7"><center>No Users</center></td>'; // Message if no users found
                                                } else {				
                                                    // Loop through each user and display in table
                                                    while($rows = mysqli_fetch_array($query)) {
                                                        echo '<tr>
                                                                <td>'.$rows['username'].'</td>
                                                                <td>'.$rows['f_name'].'</td>
                                                                <td>'.$rows['l_name'].'</td>
                                                                <td>'.$rows['email'].'</td>
                                                                <td>'.$rows['phone'].'</td>
                                                                <td>'.$rows['address'].'</td>
                                                                <td>'.$rows['date'].'</td>
                                                                <td>
                                                                    <a href="delete_users.php?user_del='.$rows['u_id'].'" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                                                                    <a href="update_users.php?user_upd='.$rows['u_id'].'" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                                                                </td>
                                                            </tr>'; // Display user data in table row
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
    
    <!-- JavaScript files for functionality -->
    <script src="js/lib/jquery/jquery.min.js"></script> <!-- jQuery library -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script> <!-- Popper.js for Bootstrap -->
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JavaScript -->
    <script src="js/jquery.slimscroll.js"></script> <!-- Slimscroll for custom scrollbars -->
    <script src="js/sidebarmenu.js"></script> <!-- Sidebar menu script -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script> <!-- Sticky kit for sticky elements -->
    <script src="js/custom.min.js"></script> <!-- Custom JavaScript for the application -->
</body>
</html>