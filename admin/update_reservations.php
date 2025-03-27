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

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Validate input fields
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $guests = trim($_POST['guests']);
    $date = trim($_POST['date']);
    $time = trim($_POST['time']);
    $special_requests = trim($_POST['special_requests']);

    // Check if any field is empty
    if (empty($name) || empty($email) || empty($phone) || empty($guests) || empty($date) || empty($time) || empty($special_requests)) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>All fields are required!</strong>
                  </div>';
    } else {
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Invalid email format!</strong>
                      </div>';
        } elseif (!preg_match('/^[0-9]{10,}$/', $phone)) { // Validate phone number (at least 10 digits)
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Invalid phone number!</strong>
                      </div>';
        } elseif (!is_numeric($guests) || $guests <= 0) { // Validate guests
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Guests must be a positive number!</strong>
                      </div>';
        } else {
            // Use prepared statements to prevent SQL injection
            $stmt = $db->prepare("UPDATE reservations SET name=?, email=?, phone=?, guests=?, date=?, time=?, special_requests=? WHERE id=?");
            // Bind parameters to the prepared statement
            $stmt->bind_param("sssssssi", $name, $email, $phone, $guests, $date, $time, $special_requests, $_GET['reserv_upd']);
            if ($stmt->execute()) { // Execute the prepared statement
                // Set success message if the update is successful
                $success = '<div class="alert alert-success alert-dismissible fade show">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <strong>Reservation Updated!</strong>
                            </div>';
            } else {
                $error = '<div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Failed to update reservation!</strong>
                          </div>';
            }
            $stmt->close(); // Close the statement
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
    <title>Update Reservations</title>
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
                        <li><a href="dashboard.php"><i class="f-s-20"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                        <li><a href="all_users.php"><span><i class="f-s-20"></i></span><span>Users</span></a></li>
                        <li><a href="all_reservations.php"><span><i class="f-s-20"></i></span><span>Reservations</span></a></li> <!-- Reservations link -->
                        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="f-s-20 color-warning"></i><span class="hide-menu">Featured Foods</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_featured_foods.php">All Featured Foods</a></li>
                                <li><a href="add_featured_foods.php">Add Featured Foods</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="#" aria-expanded="false"><i aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_menu.php">All Menus</a></li>
                                <li><a href="add_menu.php">Add Menu</a></li>
                            </ul>
                        </li>
                        <li><a href="all_orders.php"><i aria-hidden="true"></i><span>Orders</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="container-fluid">
                        <?php
                        echo $error; // Display error message if any
                        echo $success; // Display success message if any
                        ?>
                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Update Reservations</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Query to fetch the current details of the reservation
                                    $ssql = "SELECT * FROM reservations WHERE id='" . $_GET['reserv_upd'] . "'";
                                    $res = mysqli_query($db, $ssql);
                                    $newrow = mysqli_fetch_array($res);
                                    ?>
                                    <form action='' method='post'>
                                        <div class="form-body">
                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Name</label>
                                                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($newrow['name']); ?>" placeholder="name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group has-danger">
                                                        <label class="control-label">Email</label>
                                                        <input type="text" name="email" class="form-control form-control-danger" value="<?php echo htmlspecialchars($newrow['email']); ?>" placeholder="example@gmail.com">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Phone</label>
                                                        <input type="text" name="phone" class="form-control form-control-danger" value="<?php echo htmlspecialchars($newrow['phone']); ?>" placeholder="phone">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Guests</label>
                                                        <input type="text" name="guests" class="form-control form-control-danger" value="<?php echo htmlspecialchars($newrow['guests']); ?>" placeholder="guests">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Date</label>
                                                        <input type="date" name="date" class="form-control form-control-danger" value="<?php echo htmlspecialchars($newrow['date']); ?>" placeholder="date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Time</label>
                                                        <input type="time" name="time" class="form-control form-control-danger" value="<?php echo htmlspecialchars($newrow['time']); ?>" placeholder="time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Special Requests</label>
                                                        <input type="text" name="special_requests" class="form-control form-control-danger" value="<?php echo htmlspecialchars($newrow['special_requests']); ?>" placeholder="special_requests">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                                <a href="all_users.php" class="btn btn-inverse">Cancel</a>
                                            </div>
                                    </form>
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
</body>
</html>