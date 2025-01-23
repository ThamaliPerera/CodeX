<!DOCTYPE html>
<html lang="en">
<?php
session_start(); // Start the session to access session variables
error_reporting(0); // Suppress error reporting
include("../connection/connect.php"); // Include the database connection file

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Validate that all required fields are filled
    if (empty($_POST['uname']) ||
        empty($_POST['fname']) ||
        empty($_POST['lname']) ||
        empty($_POST['email']) ||
        empty($_POST['password']) ||
        empty($_POST['phone'])) {
        // Display error message if any field is empty
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>All fields Required!</strong>
                  </div>';
    } else {
        // Validate email address format
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Invalid email!</strong>
                      </div>';
        } elseif (strlen($_POST['password']) < 6) {
            // Check if password length is at least 6 characters
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Password must be >=6!</strong>
                      </div>';
        } elseif (strlen($_POST['phone']) < 10) {
            // Check if phone number is valid
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Invalid phone!</strong>
                      </div>';
        } else {
            // Use prepared statements to prevent SQL injection
            $stmt = $db->prepare("UPDATE users SET username=?, f_name=?, l_name=?, email=?, phone=?, password=? WHERE u_id=?");
            $hashedPassword = md5($_POST['password']); // Hash the password (consider using password_hash() for better security)
            $stmt->bind_param("ssssssi", $_POST['uname'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $hashedPassword, $_GET['user_upd']); // Bind parameters
            $stmt->execute(); // Execute the prepared statement
            // Display success message after updating user
            $success = '<div class="alert alert-success alert-dismissible fade show">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>User Updated!</strong>
                        </div>';
        }
    }
}
?>
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Compatibility with Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive design settings -->
    <meta name="description" content=""> <!-- Description for SEO -->
    <meta name="author" content=""> <!-- Author meta tag -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png"> <!-- Favicon for the website -->
    <title>Update Users</title> <!-- Title of the page -->
    <!-- CSS files for styling -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="css/helper.css" rel="stylesheet"> <!-- Helper CSS for additional styles -->
    <link href="css/style.css" rel="stylesheet"> <!-- Custom styles -->
</head>

<body class="fix-header"> <!-- Body with fixed header -->
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
                       
                        </li>
                       
                    </ul>
                </nav>
            </div>
        </div>

        <div class="page-wrapper" style="height:1200px;"> <!-- Main content area -->
            <div class="row page-titles"> <!-- Row for page title -->
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> <!-- Dashboard title -->
                </div>
            </div>

            <div class="container-fluid"> <!-- Container for fluid layout -->
                <div class="row">
                    <div class="container-fluid">
                        <?php
                        echo $error; // Display error message if any
                        echo $success; // Display success message if any
                        ?>
                        <div class="col-lg-12"> <!-- Column for the card -->
                            <div class="card card-outline-primary"> <!-- Card for updating user -->
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Update Users</h4> <!-- Card title -->
                                </div>
                                <div class="card-body">
                                    <?php
                                    // SQL query to fetch user data for the given user ID
                                    $ssql = "SELECT * FROM users WHERE u_id='" . $_GET['user_upd'] . "'";
                                    $res = mysqli_query($db, $ssql); // Execute the query
                                    $newrow = mysqli_fetch_array($res); // Fetch the user data
                                    ?>
                                    <form action='' method='post'> <!-- Form for updating user data -->
                                        <div class="form-body">
                                            <hr>
                                            <div class="row p-t-20"> <!-- Row for input fields -->
                                                <div class="card-body">
                                                <?php
// SQL query to fetch user data for the given user ID from the URL
$ssql = "SELECT * FROM users WHERE u_id='" . $_GET['user_upd'] . "'";
$res = mysqli_query($db, $ssql); // Execute the query
$newrow = mysqli_fetch_array($res); // Fetch the user data as an associative array
?>
<form action='' method='post'> <!-- Form for updating user data -->
    <div class="form-body"> <!-- Container for form body -->
        <hr> <!-- Horizontal line for separation -->
        <div class="row p-t-20"> <!-- Row for input fields -->
            <div class="col-md-6"> <!-- Column for username input -->
                <div class="form-group"> <!-- Form group for styling -->
                    <label class="control-label">Username</label> <!-- Label for username -->
                    <input type="text" name="uname" class="form-control" value="<?php echo $newrow['username']; ?>" placeholder="username"> <!-- Input for username with pre-filled value -->
                </div>
            </div>
            <div class="col-md-6"> <!-- Column for first name input -->
                <div class="form-group has-danger"> <!-- Form group with danger styling -->
                    <label class="control-label">First-Name</label> <!-- Label for first name -->
                    <input type="text" name="fname" class="form-control form-control-danger" value="<?php echo $newrow['f_name']; ?>" placeholder="jon"> <!-- Input for first name with pre-filled value -->
                </div>
            </div>
        </div>

        <div class="row p-t-20"> <!-- Row for additional input fields -->
            <div class="col-md-6"> <!-- Column for last name input -->
                <div class="form-group"> <!-- Form group for styling -->
                    <label class="control-label">Last-Name</label> <!-- Label for last name -->
                    <input type="text" name="lname" class="form-control" placeholder="doe" value="<?php echo $newrow['l_name']; ?>"> <!-- Input for last name with pre-filled value -->
                </div>
            </div>
            <div class="col-md-6"> <!-- Column for email input -->
                <div class="form-group has-danger"> <!-- Form group with danger styling -->
                    <label class="control-label">Email</label> <!-- Label for email -->
                    <input type="text" name="email" class="form-control form-control-danger" value="<?php echo $newrow['email']; ?>" placeholder="example@gmail.com"> <!-- Input for email with pre-filled value -->
                </div>
            </div>
        </div>

        <div class="row"> <!-- Row for password and phone input fields -->
            <div class="col-md-6"> <!-- Column for password input -->
                <div class="form-group"> <!-- Form group for styling -->
                    <label class="control-label">Password</label> <!-- Label for password -->
                    <input type="text" name="password" class="form-control form-control-danger" placeholder="password"> <!-- Input for password -->
                </div>
            </div>
            <div class="col-md-6"> <!-- Column for phone input -->
                <div class="form-group"> <!-- Form group for styling -->
                    <label class="control-label">Phone</label> <!-- Label for phone -->
                    <input type="text" name="phone" class="form-control form-control-danger" value="<?php echo $newrow['phone']; ?>" placeholder="phone"> <!-- Input for phone with pre-filled value -->
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions"> <!-- Container for form action buttons -->
        <input type="submit" name="submit" class="btn btn-primary" value="Save"> <!-- Submit button to save changes -->
        <a href="all_users.php" class="btn btn-inverse">Cancel</a> <!-- Cancel button to go back to all users -->
    </div>
</form>
</div>
</div>
</div>
</div>
</div>

<footer class="footer"> © 2025 - The Templers Cafe </footer> <!-- Footer section -->
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