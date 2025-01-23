<?php
session_start(); // Start the session to access session variables
include("connection/connect.php"); // Include your database connection file

// Assuming user is logged in and their ID is stored in session
$userId = $_SESSION['user_id']; // Retrieve the user ID from the session

// Prepare a query to fetch user data from the database
$query = "SELECT username, f_name, l_name, email, phone, loyalty_points FROM users WHERE u_id = ?"; // SQL query to select user details
$stmt = $db->prepare($query); // Prepare the SQL statement
$stmt->bind_param("i", $userId); // Bind the user ID parameter to the query
$stmt->execute(); // Execute the prepared statement
$result = $stmt->get_result(); // Get the result set from the executed statement
$user = $result->fetch_assoc(); // Fetch the user data as an associative array

// Check if the user data was found
if (!$user) {
    echo "User  not found."; // Display an error message if no user is found
    exit; // Exit the script
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Compatibility with Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Responsive design settings -->
    <meta name="description" content=""> <!-- Description for SEO -->
    <meta name="author" content=""> <!-- Author meta tag -->
    <link rel="icon" href="#"> <!-- Favicon for the website -->
    <title>Loyalty</title> <!-- Title of the page -->
    
    <!-- CSS files for styling -->
    <link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet"> <!-- Font Awesome for icons -->
    <link href="css/animsition.min.css" rel="stylesheet"> <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet"> <!-- Additional animation CSS -->
    <link href="css/style.css" rel="stylesheet"> <!-- Custom styles -->
    <link href="css/styles_loyalty.css" rel="stylesheet"> <!-- Specific styles for loyalty page -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> <!-- Bootstrap Icons -->
</head>

<body>

<header id="header" class="header-scroll top-header headrom"> <!-- Header section -->
    <nav class="navbar navbar-dark"> <!-- Navigation bar -->
        <div class="container">
            <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button> <!-- Button for mobile view -->
            <a class="navbar-brand" href="index.php">The Templers Café</a> <!-- Brand name linking to home -->
            <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse"> <!-- Collapsible menu for larger screens -->
                <ul class="nav navbar-nav"> <!-- Navigation links -->
                    <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li> <!-- Home link -->
                    <li class="nav-item"> <a class="nav-link active" href="featured_foods.php">Category <span class="sr-only"></span></a> </li> <!-- Category link -->
                    
                    <?php
                    // Check if user is logged in
                    if(empty($_SESSION["user_id"])) {
                        // Show login and registration links if not logged in
                        echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                              <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                    } else {
                        // Show loyalty and order links if logged in
                        echo '<li class="nav-item"><a href="loyalty-system.php" class="nav-link active">Loyalty</a> </li>';
                        echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                        echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container"> <!-- Main container for the content -->
    
    <!-- Customer Profile Section -->
    <section class="profile-section"> <!-- Section for user profile -->
        <div class="profile-card"> <!-- Card to display user profile information -->
            <div class="profile-header"> <!-- Header of the profile card -->
                <img src="/api/placeholder/80/80" alt="Profile Picture of <?php echo htmlspecialchars($user['f_name']); ?>" class="profile-image"> <!-- Placeholder image for profile -->
                <div class="profile-info"> <!-- Container for user information -->
                    <h2 id="customerName"><?php echo htmlspecialchars($user['f_name'] . ' ' . $user['l_name']); ?></h2> <!-- Display user's full name -->
                    <p class="membership-id">User  ID: #<?php echo htmlspecialchars($userId); ?></p> <!-- Display user's ID -->
                </div>
            </div>
            <div class="points-display"> <!-- Section to display loyalty points -->
                <div class="points-circle"> <!-- Circle to visually represent points -->
                    <span class="points-number" id="pointsBalance"><?php echo htmlspecialchars($user['loyalty_points']); ?></span> <!-- Display user's loyalty points -->
                    <span class="points-label">Points</span> <!-- Label for points -->
                </div>
            </div>
        </div>
    </section>
    
    <!-- JavaScript files for functionality -->
    <script src="js/jquery.min.js"></script> <!-- jQuery library -->
    <script src="js/tether.min.js"></script> <!-- Tether for Bootstrap -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap JavaScript -->
    <script src="js/animsition.min.js"></script> <!-- Animation JavaScript -->
    <script src="js/bootstrap-slider.min.js"></script> <!-- Bootstrap slider -->
    <script src="js/jquery.isotope.min.js"></script> <!-- Isotope for filtering -->
    <script src="js/headroom.js"></script> <!-- Headroom.js for hiding header on scroll -->
    <script src="js/foodpicky.min.js"></script> <!-- Custom JavaScript for the application -->
</body>

</html>