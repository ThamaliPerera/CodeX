<!DOCTYPE html>
<html lang="en">
<?php
// Include the database connection file
include("../connection/connect.php");
// Enable error reporting for debugging
error_reporting(E_ALL); 
ini_set('display_errors', 1); // Display errors on the page
// Start the session
session_start();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>All Featured Foods</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<!--preloader-->
<body class="fix-header fix-sidebar">
  
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>


   <!--header section-->
    <div id="main-wrapper">
       
         <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">THE TEMPLERS CAFE</a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0"></ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!--left side panel-->
  
        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                   <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php">  <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                        <li><a href="all_reservations.php"><span><i class="fa fa-user f-s-20"></i></span><span>Reservations</span></a></li> <!-- Reservations link -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Featured Foods</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_featured_foods.php">All Featured Foods</a></li>
                                <li><a href="add_featured_foods.php">Add Featured Foods</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_menu.php">All Menus</a></li>
                                <li><a href="add_menu.php">Add Menu</a></li>
                            </ul>
                        </li>
                        <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>

     <!--all featured foods section-->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">All Featured Foods</h4>
                                </div>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Action</th>  
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Query to select all featured foods from the database
                                            $sql = "SELECT * FROM featured_food ORDER BY ff_id DESC";
                                            $query = mysqli_query($db, $sql);
                                            
                                            // Check if there are no featured foods
                                            if (mysqli_num_rows($query) == 0) {
                                                echo '<tr><td colspan="4"><center>No Featured Foods</center></td></tr>';
                                            } else {                
                                                // Loop through each row and display the data
                                                while ($rows = mysqli_fetch_array($query)) {
                                                    echo '<tr>
                                                            <td>' . htmlspecialchars($rows['title']) . '</td>
                                                            <td>' . htmlspecialchars($rows['description']) . '</td>
                                                            <td>
                                                                <div class="col-md-3 col-lg-8 m-b-10">
                                                                    <center><img src="Res_img/' . htmlspecialchars($rows['image']) . '" class="img-responsive radius" style="min-width:150px;min-height:100px;"/></center>
                                                                </div>
                                                            </td>
                                                            <td>
                                                               <a href="delete_featured_foods.php?res_del=' . $rows['ff_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i>Delete</a> 
                                                                <a href="update_featured_foods.php?res_upd=' . $rows['ff_id'] . '" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i>Edit</a>
                                                            </td>
                                                        </tr>';
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
         
            <footer class="footer"> © 2025 - The Templers Cafe </footer>
        </div>
    </div>

    <!--js files-->
   
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdn.jsdelivr.net/npm/jszip@2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
</body>
</html>