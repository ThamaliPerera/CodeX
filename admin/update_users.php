<!DOCTYPE html>
<html lang="en">
<?php
// Start the session
session_start();
// Disable error reporting
error_reporting(0);
// Include the database connection file
include("../connection/connect.php");

// Initialize error and success messages
$error = '';
$success = '';

// Check if the menu ID is set in the URL
if (isset($_POST['submit'])) { // Check if the form is submitted
    // Validate input fields
    if (empty($_POST['uname']) || // Check if username is empty
        empty($_POST['fname']) || // Check if first name is empty
        empty($_POST['lname']) || // Check if last name is empty
        empty($_POST['email']) || // Check if email is empty
        empty($_POST['password']) || // Check if password is empty
        empty($_POST['phone'])) { // Check if phone is empty
        // Set error message if any field is empty
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>All fields Required!</strong>
                  </div>';
    } else {
        // Validate email format
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { // Validate email address
            // Set error message for invalid email
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Invalid email!</strong>
                      </div>';
        } elseif (strlen($_POST['password']) < 6) { // Check if password length is less than 6
            // Set error message for short password
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Password must be >=6!</strong>
                      </div>';
        } elseif (strlen($_POST['phone']) < 10) { // Check if phone number length is less than 10
            // Set error message for invalid phone number
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Invalid phone!</strong>
                      </div>';
        } else {
            // Use prepared statements to prevent SQL injection
            $stmt = $db->prepare("UPDATE users SET username=?, f_name=?, l_name=?, email=?, phone=?, password=? WHERE u_id=?");
            $hashedPassword = md5($_POST['password']); // Hash the password for security
            // Bind parameters to the prepared statement
            $stmt->bind_param("ssssssi", $_POST['uname'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $hashedPassword, $_GET['user_upd']);
            $stmt->execute(); // Execute the prepared statement
            // Set success message if the update is successful
            $success = '<div class="alert alert-success alert-dismissible fade show">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>User Updated!</strong>
                        </div>';
        }
    }
}
?>
<head>
    <meta charset="utf-8"> <!-- Set character encoding -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Set compatibility for Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive design -->
    <meta name="description" content=""> <!-- Page description -->
    <meta name="author" content=""> <!-- Author of the page -->
    <title>Update Users</title> <!-- Page title -->
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
                    <a class="navbar-brand" href="dashboard.php">THE TEMPLERS CAFE</a> <!-- Brand name -->
                </div>
                <div class="navbar-collapse"> <!-- Navbar collapse for responsive design -->
                    <ul class="navbar-nav mr-auto mt-md-0"></ul> <!-- Left side navbar items -->
                    <ul class="navbar-nav my-lg-0"> <!-- Right side navbar items -->
                        <li class="nav-item dropdown"> <!-- Dropdown for user profile -->
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
                        <li class="nav-item dropdown"> <!-- Dropdown for user actions -->
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
                        <li><a href="dashboard.php"><i class="f-s-20"></i><span>Dashboard</span></a></li> <!-- Dashboard link -->
                        <li class="nav-label">Log</li> <!-- Log label -->
                        <li><a href="all_users.php"><span><i class="f-s-20"></i></span><span>Users</span></a></li> <!-- Users link -->
                        <li><a href="all_reservations.php"><span><i class="f-s-20"></i></span><span>Reservations</span></a></li> <!-- Reservations link -->
                        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="f-s-20 color-warning"></i><span class="hide-menu">Featured Foods</span></a>
                            <ul aria-expanded="false" class="collapse"> <!-- Submenu for featured foods -->
                                <li><a href="all_featured_foods.php">All Featured Foods</a></li> <!-- All featured foods link -->
                                <li><a href="add_featured_foods.php">Add Featured Foods</a></li> <!-- Add featured foods link -->
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="#" aria-expanded="false"><i aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
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
                <div class="row"> <!-- Row for layout -->
                    <div class="container-fluid"> <!-- Container for update form -->
                        <?php
                        echo $error; // Display error message if any
                        echo $success; // Display success message if any
                        ?>
                        <div class="col-lg-12"> <!-- Column for update form -->
                            <div class="card card-outline-primary"> <!-- Card for update section -->
                                <div class="card-header"> <!-- Card header -->
                                    <h4 class="m-b-0 text-white">Update Users</h4> <!-- Title for update section -->
                                </div>
                                <div class="card-body"> <!-- Card body -->
                                    <?php
                                    // Query to fetch the current details of the user
                                    $ssql = "SELECT * FROM users WHERE u_id='" . $_GET['user_upd'] . "'";
                                    $res = mysqli_query($db, $ssql); // Execute the query
                                    $newrow = mysqli_fetch_array($res); // Fetch the result as an associative array
                                    ?>
                                    <form action='' method='post'> <!-- Form for updating user details -->
                                        <div class="form-body"> <!-- Form body -->
                                            <hr>
                                            <div class="row p-t-20"> <!-- Row for input fields -->
                                                <div class="col-md-6"> <!-- Column for username -->
                                                    <div class="form-group"> <!-- Form group for input -->
                                                        <label class="control-label">Username</label> <!-- Label for input -->
                                                        <input type="text" name="uname" class="form-control" value="<?php echo $newrow['username']; ?>" placeholder="username"> <!-- Input for username -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> <!-- Column for first name -->
                                                    <div class="form-group has-danger"> <!-- Form group for input -->
                                                        <label class="control-label">First-Name</label> <!-- Label for input -->
                                                        <input type="text" name="fname" class="form-control form-control-danger" value="<?php echo $newrow['f_name']; ?>" placeholder="jon"> <!-- Input for first name -->
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row p-t-20"> <!-- Row for last name and email -->
                                                <div class="col-md-6"> <!-- Column for last name -->
                                                    <div class="form-group"> <!-- Form group for input -->
                                                        <label class="control-label">Last-Name</label> <!-- Label for input -->
                                                        <input type="text" name="lname" class="form-control" placeholder="doe" value="<?php echo $newrow['l_name']; ?>"> <!-- Input for last name -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> <!-- Column for email -->
                                                    <div class="form-group has-danger"> <!-- Form group for input -->
                                                        <label class="control-label">Email</label> <!-- Label for input -->
                                                        <input type="text" name="email" class="form-control form-control-danger" value="<?php echo $newrow['email']; ?>" placeholder="example@gmail.com"> <!-- Input for email -->
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row"> <!-- Row for password and phone -->
                                                <div class="col-md-6"> <!-- Column for password -->
                                                    <div class="form-group"> <!-- Form group for input -->
                                                        <label class="control-label">Password</label> <!-- Label for input -->
                                                        <input type="text" name="password" class="form-control form-control-danger" placeholder="password"> <!-- Input for password -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> <!-- Column for phone -->
                                                    <div class="form-group"> <!-- Form group for input -->
                                                        <label class="control-label">Phone</label> <!-- Label for input -->
                                                        <input type="text" name="phone" class="form-control form-control-danger" value="<?php echo $newrow['phone']; ?>" placeholder="phone"> <!-- Input for phone -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"> <!-- Column for loyalty points -->
                                                    <div class="form-group"> <!-- Form group for input -->
                                                        <label class="control-label">Loyalty Points</label> <!-- Label for input -->
                                                        <input type="text" name="loyalty_points" class="form-control form-control-danger" value="<?php echo $newrow['loyalty_points']; ?>" placeholder="loyalty_points"> <!-- Input for loyalty points -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions"> <!-- Form actions -->
                                            <input type="submit" name="submit" class="btn btn-primary" value="Save"> <!-- Save button -->
                                            <a href="all_users.php" class="btn btn-inverse">Cancel</a> <!-- Cancel button -->
                                        </div>
                                    </form>
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