<?php
session_start(); // Start the session
include("connection/connect.php"); // Include your database connection file

// Check if the user is logged in
if (empty($_SESSION["user_id"])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit(); // Stop further execution
}

// Assuming user is logged in and their ID is stored in session
$userId = $_SESSION['user_id']; // Get the user ID from session

// Fetch user data from the database
$query = "SELECT username, f_name, l_name, email, phone, loyalty_points FROM users WHERE u_id = ?"; // Prepare query to fetch user details
$stmt = $db->prepare($query); // Prepare the statement
$stmt->bind_param("i", $userId); // Bind the user ID parameter
$stmt->execute(); // Execute the query
$result = $stmt->get_result(); // Get the result set
$user = $result->fetch_assoc(); // Fetch the user data as an associative array

if (!$user) {
    echo "User  not found."; // Display message if user is not found
    exit; // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en"> <!-- Start of HTML document -->
<head>
    <meta charset="utf-8"> <!-- Character encoding -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Compatibility with IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive design -->
    <title>Loyalty</title> <!-- Page title -->
    <link rel="icon" href="images/icn.png" type="image/x-icon"><!--favicon-->
    <!-- CSS Links -->
    <link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet"> <!-- Font Awesome CSS -->
    <link href="css/animsition.min.css" rel="stylesheet"> <!-- Animsition CSS for animations -->
    <link href="css/animate.css" rel="stylesheet"> <!-- Animate CSS for animations -->
    <link href="css/style.css" rel="stylesheet"> <!-- Custom CSS -->
    <link href="css/styles_loyalty.css" rel="stylesheet"> <!-- Loyalty specific CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> <!-- Bootstrap Icons -->
    
    <!-- QR Code Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script> <!-- QRious library for generating QR codes -->

    <style>
        .centered {
            text-align: center; /* Center text and inline elements */
            margin-top: 20px; /* Add some space above */
        }
        #qrcode {
            margin-top: 20px; /* Add space above the QR code */
            display: none; /* Initially hidden */
        }
        .spinner-container {
            margin-top: 40px; /* Space above the spinner */
        }
        .spinner {
            width: 200px;
            height: 200px;
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            animation: spin 2s linear infinite; /* Spin animation */
            display: none; /* Initially hidden */
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .spin-result {
            margin-top: 20px; /* Space above the result */
            font-size: 1.5em; /* Larger font for result */
        }
    </style>
</head>

<body>
    <header id="header" class="header-scroll top-header headrom"> <!-- Header section -->
        <nav class="navbar navbar-dark"> <!-- Navigation bar -->
            <div class="container"> <!-- Container for navbar content -->
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button> <!-- Mobile toggle button -->
                <a class="navbar-brand" href="index.php">The Templers Café</a> <!-- Brand name -->
                <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse"> <!-- Collapsible navbar -->
                    <ul class="nav navbar-nav"> <!-- Navigation links -->
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a></li> <!-- Home link -->
                        <li class="nav-item"><a class="nav-link active" href="featured_foods.php">Category <span class="sr-only"></span></a></li> <!-- Category link -->
                        
                        <?php
                        // Check if user is logged in
                        if (empty($_SESSION["user_id"])) {
                            // Show login and registration links if not logged in
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a></li>
                                  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a></li>';
                        } else {
                            // Show user-specific links if logged in
                            echo '<li class="nav-item"><a href="loyalty-system.php" class="nav-link active">Loyalty</a></li>';
                            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a></li>'; // My Orders link
                            echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a></li>'; // Logout link
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container"> <!-- Main container for the page content -->
        <!-- Customer Profile Section -->
        <section class="profile-section"> <!-- Profile section for displaying user information -->
            <div class="profile-card"> <!-- Card to display user profile -->
                <div class="profile-header"> <!-- Header of the profile card -->
                    <img src="/api/placeholder/80/80" alt="Profile Picture of <?php echo htmlspecialchars($user['f_name']); ?>" class="profile-image"> <!-- Profile image -->
                    <div class="profile-info"> <!-- User information section -->
                        <h2 id="customerName"><?php echo htmlspecialchars($user['f_name'] . ' ' . $user['l_name']); ?></h2> <!-- Display full name -->
                        <p class="membership-id">User  ID: #<?php echo htmlspecialchars($userId); ?></p> <!-- Display user ID -->
                    </div>
                </div>
                <div class="points-display"> <!-- Section to display loyalty points -->
                    <div class="points-circle"> <!-- Circle display for points -->
                        <span class="points-number" id="pointsBalance"><?php echo htmlspecialchars($user['loyalty_points']); ?></span> <!-- Display points balance -->
                        <span class="points-label">Points</span> <!-- Label for points -->
                    </div>
                </div>
                <div class="centered"> <!-- Centered button section -->
                    <button id="redeemButton" class="btn btn-primary">Redeem Now</button> <!-- Button to redeem points -->
                    <canvas id="qrcode"></canvas> <!-- Canvas for QR code -->
                </div>
            </div>
        </section>

        <!-- Daily Spinner Section -->
        <div class="spinner-container centered">
            <h2>Daily Spinner</h2>
            <div id="spinner" class="spinner"></div>
            <button id="spinButton" class="btn btn-success">Spin Now!</button>
            <div id="spinResult" class="spin-result"></div>
        </div>
    </div>

    <script>
        document.getElementById('redeemButton').addEventListener('click', function() { // Event listener for redeem button
            // Get the loyalty points
            const points = document.getElementById('pointsBalance').innerText; // Get points balance

            // Create a QR code
            const qr = new QRious({
                element: document.getElementById('qrcode'), // Target canvas for QR code
                value: `Loyalty Points: ${points}`, // Value to encode in QR code
                size: 200 // Size of the QR code
            });

            // Show the QR code
            document.getElementById('qrcode').style.display = 'block'; // Make QR code visible
        });

        document.getElementById('spinButton').addEventListener('click', function() {
            const spinner = document.getElementById('spinner');
            const spinResult = document.getElementById('spinResult');
            
            // Show the spinner
            spinner.style.display = 'block';
            
            // Hide the result initially
            spinResult.innerText = '';
            
            // Simulate spinning
            setTimeout(() => {
                // Hide the spinner after 2 seconds
                spinner.style.display = 'none';
                
                // Randomly select a point value or "Try Again"
                const pointsOptions = [200, 100, 50, 500, 'Try Again'];
                const randomIndex = Math.floor(Math.random() * pointsOptions.length);
                const result = pointsOptions[randomIndex];
                
                // Display the result
                spinResult.innerText = `You won: ${result} points!`;
                
                // If points are won, update the loyalty points display and database
                if (typeof result === 'number') {
                    const currentPoints = parseInt(document.getElementById('pointsBalance').innerText);
                    const newPoints = currentPoints + result; // Update points balance
                    document.getElementById('pointsBalance').innerText = newPoints; // Update points display

                    // Update the database with the new points
                    updateLoyaltyPoints(newPoints);
                }
            }, 2000); // Duration of the spin
        });

        function updateLoyaltyPoints(newPoints) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "update_points.php", true); // URL of the PHP script to update points
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    console.log(xhr.responseText); // Log the response from the server
                }
            };
            xhr.send("user_id=<?php echo $userId; ?>&loyalty_points=" + newPoints); // Send user ID and new points
        }

        // Function to handle QR code scan
        document.getElementById('qrcode').addEventListener('click', function() {
            deductPoints(1000); // Deduct 1000 points when QR code is scanned
        });

        function deductPoints(pointsToDeduct) {
            const currentPoints = parseInt(document.getElementById('pointsBalance').innerText);
            if (currentPoints >= pointsToDeduct) {
                const newPoints = currentPoints - pointsToDeduct; // Calculate new points balance
                document.getElementById('pointsBalance').innerText = newPoints; // Update points display

                // Update the database with the new points
                updateLoyaltyPoints(newPoints);
            } else {
                alert("Insufficient points to redeem."); // Alert if not enough points
            }
        }
    </script>
    <footer class="footer"> <!-- Footer section -->
        <div class="container"> <!-- Container for footer -->
            <div class="bottom-footer"> <!-- Bottom footer section -->
                <div class="row"> <!-- Row for footer content -->
                    <div class="col-xs-12 col-sm-3 payment-options color-gray"> <!-- Payment options column -->
                        <h5>Payment Options</h5> <!-- Payment options heading -->
                        <ul> <!-- List of payment options -->
                            <li><a href="#"><img src="images/mastercard.png" alt="Mastercard"></a></li> <!-- Mastercard option -->
                            <li><a href="#"><img src="images/maestro.png" alt="Maestro"></a></li> <!-- Maestro option -->
                            <li><a href="#"><img src="images/stripe.png" alt="Stripe"></a></li> <!-- Stripe option -->
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4 address color-gray"> <!-- Address column -->
                        <h5>Address</h5> <!-- Address heading -->
                        <p>Templers Road, Mount Lavinia, Sri Lanka</p> <!-- Address details -->
                        <h5>Phone: 071 722 2444</h5> <!-- Phone number -->
                    </div>
                    <div class="col-lg-3 col-md-6"> <!-- Social media column -->
                        <h5>Follow Us</h5> <!-- Follow us heading -->
                        <div class="social-links d-flex"> <!-- Social links container -->
                            <a href="https://www.facebook.com/thetemplerscafe?mibextid=kFxxJD" class="facebook" target="_blank" rel="noopener noreferrer"> <!-- Facebook link -->
                                <i class="bi bi-facebook"></i> <!-- Facebook icon -->
                            </a>
                            <a href="https://www.instagram.com/thetemplers cafe?igsh=MXF1N3dxN3hhbXYw" class="instagram" target="_blank" rel="noopener noreferrer"> <!-- Instagram link -->
                                <i class="bi bi-instagram"></i> <!-- Instagram icon -->
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 10px; text-align: center;"> <!-- Centered copyright section -->
                <p>&copy; <?php echo date("Y"); ?> The Templers Café. All rights reserved.</p> <!-- Copyright notice -->
            </div>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script> <!-- jQuery library -->
    <script src="js/tether.min.js"></script> <!-- Tether library for Bootstrap -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap JavaScript -->
    <script src="js/animsition.min.js"></script> <!-- Animsition JavaScript for animations -->
    <script src="js/bootstrap-slider.min.js"></script> <!-- Bootstrap slider JavaScript -->
    <script src="js/jquery.isotope.min.js"></script> <!-- Isotope layout library -->
    <script src="js/headroom.js"></script> <!-- Headroom.js for hiding header on scroll -->
    <script src="js/foodpicky.min.js"></script> <!-- Custom JavaScript for the site -->
</body>
</html>