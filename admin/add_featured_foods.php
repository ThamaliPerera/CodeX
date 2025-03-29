<!DOCTYPE html>
<html lang="en">
<?php
// Include the database connection file to establish a connection to the database
include("../connection/connect.php");

// Enable error reporting for debugging purposes
error_reporting(E_ALL); 
ini_set('display_errors', 1); 

// Start a new session or resume the existing session
session_start();

// Initialize variables to hold error and success messages
$error = '';
$success = '';

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Validate that required fields are not empty
    if (empty($_POST['res_name']) || empty($_POST['description']) || empty($_FILES['file']['name'])) {
        // Set an error message if any of the required fields are empty
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>All fields must be filled!</strong>
                  </div>';
    } else {
        // Get the uploaded file details
        $fname = $_FILES['file']['name']; // Original file name
        $temp = $_FILES['file']['tmp_name']; // Temporary file path
        $fsize = $_FILES['file']['size']; // File size in bytes
        $extension = strtolower(pathinfo($fname, PATHINFO_EXTENSION)); // Get the file extension in lowercase
        $fnew = uniqid() . '.' . $extension; // Generate a unique file name using a unique ID
        $store = "Res_img/" . basename($fnew); // Set the storage path for the uploaded file

        // Check if the file extension is valid (only allow jpg, png, and gif)
        if (in_array($extension, ['jpg', 'png', 'gif'])) {
            // Check if the file size exceeds the limit of 1MB (1000000 bytes)
            if ($fsize >= 1000000) {
                // Set an error message for file size exceeding the limit
                $error = '<div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Max Image Size is 1024kb! Try a different image.</strong>
                          </div>';
            } else {
                // Get the form data for the featured food
                $res_name = $_POST['res_name']; // Featured food name
                $description = $_POST['description']; // Description of the featured food

                // Use prepared statements to prevent SQL injection when inserting data into the database
                $stmt = $db->prepare("INSERT INTO featured_food(title, description, image) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $res_name, $description, $fnew); // Bind parameters to the SQL query
                
                // Execute the prepared statement and check for success
                if ($stmt->execute()) {
                    // Move the uploaded file from the temporary location to the specified directory
                    move_uploaded_file($temp, $store);
                    // Set a success message indicating that the featured food was added successfully
                    $success = '<div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                New Featured Food Added Successfully.
                              </div>';
                } else {
                    // Set an error message if there was a problem adding the featured food to the database
                    $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error adding featured food!</strong>
                              </div>';
                }
            }
        } elseif ($extension == '') {
            // Set an error message if no image is selected
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Select an image</strong>
                      </div>';
        } else {
            // Set an error message for invalid file extensions
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Invalid extension! Only png, jpg, and gif are accepted.</strong>
                      </div>';
        }
    }
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png"> <!-- Favicon for the page -->
    <title>Add Featured Food</title>
    <!-- Link to CSS files for styling -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>
    
   <!-- Main wrapper for the page -->
    <div id="main-wrapper">
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">THE TEMPLERS CAFE</a> <!-- Brand name -->
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
        
      <!-- Left sidebar for navigation -->
        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                   <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li> <!-- Dashboard link -->
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php">  <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li> <!-- Users link -->
                        <li><a href="all_reservations.php"><span><i class="fa fa-user f-s-20"></i></span><span>Reservations</span></a></li> <!-- Reservations link -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Featured Foods</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_featured_foods.php">All Featured Foods</a></li> <!-- Link to view all featured foods -->
                                <li><a href="add_featured_foods.php">Add Featured Foods</a></li> <!-- Link to add new featured food -->
                            </ul>
                        </li>
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_menu.php">All Menus</a></li> <!-- Link to view all menus -->
                                <li><a href="add_menu.php">Add Menu</a></li> <!-- Link to add a new menu -->
                            </ul>
                        </li>
                        <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li> <!-- Orders link -->
                    </ul>
                </nav>
            </div>
        </div>
      
        <div class="page-wrapper">
            <div class="container-fluid">
                <?php echo $error; echo $success; // Display any error or success messages ?>
                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Add Featured Food</h4> <!-- Card title -->
                        </div>
                        <div class="card-body">
                            <!-- Form to add a new featured food -->
                            <form action='' method='post' enctype="multipart/form-data">
                                <div class="form-body">
                                    <hr>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Featured Food Name</label>
                                                <input type="text" name="res_name" class="form-control" required> <!-- Input for food name -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Image</label>
                                                <input type="file" name="file" id="lastName" class="form-control form-control-danger" required> <!-- Input for image upload -->
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="box-title m-t-40">Description</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <textarea name="description" type="text" style="height:100px;" class="form-control" required></textarea> <!-- Textarea for food description -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Save"> <!-- Submit button to save the featured food -->
                                    <a href="add_featured_foods.php" class="btn btn-inverse">Cancel</a> <!-- Cancel button to go back -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <footer class="footer"> © 2025 - The Templers Cafe </footer> <!-- Footer with copyright -->
            </div>
        </div>
    </div>
    
    <!-- JavaScript files for functionality -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
</body>
</html>