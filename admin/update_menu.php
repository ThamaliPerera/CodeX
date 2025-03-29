<!DOCTYPE html>
<html lang="en">
<?php
// Include the database connection file
include("../connection/connect.php");
// Start the session
session_start();

// Initialize error and success messages
$error = '';
$success = '';

// Check if the menu ID is set in the URL
if (!isset($_GET['menu_upd'])) {
    die("Menu ID not specified."); // Terminate the script if menu ID is not provided
}

// Handle form submission
if (isset($_POST['submit'])) {
    // Validate input fields
    $d_name = trim($_POST['d_name']); // Get and trim the dish name
    $about = trim($_POST['about']); // Get and trim the about description
    $price = trim($_POST['price']); // Get and trim the price
    $res_name = $_POST['res_name']; // Get the selected featured food ID
    $fname = $_FILES['file']['name']; // Get the uploaded file name
    $temp = $_FILES['file']['tmp_name']; // Get the temporary file path
    $fsize = $_FILES['file']['size']; // Get the file size
    $extension = strtolower(pathinfo($fname, PATHINFO_EXTENSION)); // Get the file extension

    // Check for empty fields
    if (empty($d_name) || empty($about) || empty($price) || empty($res_name)) {
        // Set error message if fields are empty
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>All fields must be filled!</strong>
                  </div>';
    } elseif (!in_array($extension, ['jpg', 'png', 'gif']) && !empty($fname)) {
        // Set error message if the file type is invalid
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Invalid file type! Only JPG, PNG, and GIF are allowed.</strong>
                  </div>';
    } elseif ($fsize > 1000000) {
        // Set error message if the file size exceeds the limit
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Max image size is 1MB! Try a different image.</strong>
                  </div>';
    } else {
        // Prepare the new file name and store path
        $fnew = uniqid() . '.' . $extension; // Create a unique file name
        $store = "Res_img/dishes/" . basename($fnew); // Set the storage path

        // Update the database
        $sql = "UPDATE dishes SET ff_id=?, title=?, slogan=?, price=?, img=? WHERE d_id=?";
        $stmt = $db->prepare($sql); // Prepare the SQL statement
        $stmt->bind_param("issssi", $res_name, $d_name, $about, $price, $fnew, $_GET['menu_upd']); // Bind parameters

        // Execute the statement and check for success
        if ($stmt->execute()) {
            if (!empty($fname)) {
                move_uploaded_file($temp, $store); // Move the uploaded file to the specified directory
            }
            // Set success message
            $success = '<div class="alert alert-success alert-dismissible fade show">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Record updated successfully!</strong>
                        </div>';
        } else {
            // Set error message for database update failure
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error updating record!</strong>
                      </div>';
        }
        $stmt->close(); // Close the prepared statement
    }
}

// Fetch existing data for the menu item
$qml = $db->prepare("SELECT * FROM dishes WHERE d_id=?"); // Prepare the SQL query
$qml->bind_param("i", $_GET['menu_upd']); // Bind the menu ID parameter
$qml->execute(); // Execute the query
$result = $qml->get_result(); // Get the result set
$roww = $result->fetch_assoc(); // Fetch the result as an associative array
$qml->close(); // Close the prepared statement

// Check if the row was found
if (!$roww) {
    die("No record found for the specified menu ID."); // Terminate the script if no record is found
}
?>
<head>
    <meta charset="utf-8"> <!-- Set character encoding -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- Set compatibility for Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive design -->
    <title>Update Menu</title> <!-- Page title -->
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
                    <ul class="navbar-nav my-lg-0">                                                       
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
                        <li><a href="dashboard.php"><i class="f-s-20"></i><span>Dashboard</span></a></li> <!-- Dashboard link -->
                        <li class="nav-label">Log</li> <!-- Log label -->
                        <li><a href="all_users.php"><span><i class="f-s-20"></i></span><span>Users</span></a></li> <!-- Users link -->
                        <li><a href="all_reservations.php"><span><i class="f-s-20"></i></span><span>Reservations</span></a></li> <!-- Reservations link -->
                        <li class="has-arrow"><a href="#" aria-expanded="false"><i class="f-s-20 color-warning"></i><span class="hide-menu">Featured Foods</span></a>
                            <ul aria-expanded="false" class="collapse"> <!-- Submenu for featured foods -->
                                <li><a href="all_featured_foods.php">All Featured Foods</a></li> <!-- All featured foods link -->
                                <li><a href="add_featured_foods.php">Add Featured Foods</a></li> <!-- Add featured foods link -->
                            </ul>
                        </li>
                        <li class="has-arrow"><a href="#" aria-expanded="false"><i aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
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
                <?php echo $error; echo $success; ?> <!-- Display error or success messages -->
                <div class="col-lg-12"> <!-- Column for update form -->
                    <div class="card card-outline-primary"> <!-- Card for update section -->
                        <div class="card-body"> <!-- Card body -->
                            <form action='' method='post' enctype="multipart/form-data"> <!-- Form for updating menu -->
                                <div class="form-body"> <!-- Form body -->
                                    <hr>
                                    <div class="row p-t-20"> <!-- Row for input fields -->
                                        <div class="col-md-6"> <!-- Column for dish name -->
                                            <div class="form-group"> <!-- Form group for input -->
                                                <label class="control-label">Dish Name</label> <!-- Label for input -->
                                                <input type="text" name="d_name" value="<?php echo htmlspecialchars($roww['title']); ?>" class="form-control" placeholder="Dish Name" required> <!-- Input for dish name -->
                                            </div>
                                        </div>
                                        <div class="col-md-6"> <!-- Column for about description -->
                                            <div class="form-group"> <!-- Form group for input -->
                                                <label class="control-label">About</label> <!-- Label for input -->
                                                <input type="text" name="about" value="<?php echo htmlspecialchars($roww['slogan']); ?>" class="form-control" placeholder="About" required> <!-- Input for about description -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row p-t-20"> <!-- Row for price input -->
                                        <div class="col-md-6"> <!-- Column for price -->
                                            <div class="form-group"> <!-- Form group for input -->
                                                <label class="control-label">Price</label> <!-- Label for input -->
                                                <input type="text" name="price" value="<?php echo htmlspecialchars($roww['price']); ?>" class="form-control" placeholder="Price" required> <!-- Input for price -->
                                            </div>
                                        </div>
                                        <div class="col-md-6"> <!-- Column for image upload -->
                                            <div class="form-group"> <!-- Form group for file input -->
                                                <label class="control-label">Image</label> <!-- Label for file input -->
                                                <input type="file" name="file" class="form-control" placeholder="Upload Image"> <!-- File input for image -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row"> <!-- Row for featured food selection -->
                                        <div class="col-md-12"> <!-- Full width column -->
                                            <div class="form-group"> <!-- Form group for dropdown -->
                                                <label class="control-label">Select Featured Food</label> <!-- Label for dropdown -->
                                                <select name="res_name" class="form-control custom-select" required> <!-- Dropdown for selecting featured food -->
                                                    <option value="">--Select Featured Food--</option> <!-- Default option -->
                                                    <?php
                                                    // Query to fetch all featured foods
                                                    $ssql = "SELECT * FROM featured_food";
                                                    $res = mysqli_query($db, $ssql);
                                                    while ($row = mysqli_fetch_array($res)) {
                                                        // Populate dropdown with featured foods
                                                        echo '<option value="' . $row['ff_id'] . '"' . ($row['ff_id'] == $roww['ff_id'] ? ' selected' : '') . '>' . htmlspecialchars($row['title']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions"> <!-- Form actions -->
                                    <input type="submit" name="submit" class="btn btn-primary" value="Save"> <!-- Save button -->
                                    <a href="all_menu.php" class="btn btn-inverse">Cancel</a> <!-- Cancel button -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <footer class="footer"> © 2025 - The Templers Cafe </footer> <!-- Footer section -->
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