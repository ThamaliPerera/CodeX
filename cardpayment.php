<?php
// Start the session
session_start(); // Initializes session data

// Check if the user is logged in
if (empty($_SESSION["user_id"])) { // If user_id is not set in session
    header('Location: login.php'); // Redirect to login page
    exit(); // Stop further execution
}

// Initialize variables for error and success messages
$error_message = ""; // Variable to hold error messages
$success_message = ""; // Variable to hold success messages

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the request method is POST
    // Validate and sanitize input data
    $firstname = htmlspecialchars(trim($_POST['firstname'])); // Sanitize first name
    $email = htmlspecialchars(trim($_POST['email'])); // Sanitize email
    $address = htmlspecialchars(trim($_POST['address'])); // Sanitize address
    $city = htmlspecialchars(trim($_POST['city'])); // Sanitize city
    $state = htmlspecialchars(trim($_POST['state'])); // Sanitize state
    $zip = htmlspecialchars(trim($_POST['zip'])); // Sanitize zip code
    $cardname = htmlspecialchars(trim($_POST['cardname'])); // Sanitize card name
    $cardnumber = htmlspecialchars(trim($_POST['cardnumber'])); // Sanitize card number
    $expmonth = htmlspecialchars(trim($_POST['expmonth'])); // Sanitize expiration month
    $expyear = htmlspecialchars(trim($_POST['expyear'])); // Sanitize expiration year
    $cvv = htmlspecialchars(trim($_POST['cvv'])); // Sanitize CVV

    // Here you would typically process the payment using a payment gateway API
    // For example, using Stripe, PayPal, etc.
    // This is where you would add your payment processing logic.

    // Simulate payment processing (replace this with actual payment processing logic)
    $payment_successful = true; // Change this based on actual payment processing result

    if ($payment_successful) { // If payment is successful
        $success_message = "Payment successful! Thank you for your order."; // Set success message
        // Redirect to your orders page after processing
        header('Location: your_orders.php'); // Redirect to orders page
        exit(); // Stop further execution
    } else {
        $error_message = "Payment failed. Please try again."; // Set error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"> <!-- Set character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive design -->
    <title>Payment Form</title> <!-- Page title -->

    <!-- CSS Links -->
    <link rel="stylesheet" href="css/payment-style.css"> <!-- Link to custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Link to Font Awesome -->
</head>

<body>
    <h2>Payment Form</h2> <!-- Main heading -->

    <div class="row"> <!-- Start of row -->
        <div class="col-75"> <!-- Column for main content -->
            <div class="container"> <!-- Container for form -->
                <?php if ($error_message): ?> <!-- Check if there is an error message -->
                    <div class="alert alert-danger"><?php echo $error_message; ?></div> <!-- Display error message -->
                <?php endif; ?>
                <?php if ($success_message): ?> <!-- Check if there is a success message -->
                    <div class="alert alert-success"><?php echo $success_message; ?></div> <!-- Display success message -->
                <?php endif; ?>
                <form action="" method="POST"> <!-- Start of form -->
                    <div class="row"> <!-- Start of inner row -->
                        <div class="col-50"> <!-- Column for billing address -->
                            <h3>Billing Address</h3> <!-- Section heading -->
                            <label for="fname"><i class="fa fa-user"></i> Full Name</label> <!-- Label for full name -->
                            <input type="text" id="fname" name="firstname" required> <!-- Input for first name -->
                            <label for="email"><i class="fa fa-envelope"></i> Email</label> <!-- Label for email -->
                            <input type="email" id="email" name="email" required> <!-- Input for email -->
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label> <!-- Label for address -->
                            <input type="text" id="adr" name="address" required> <!-- Input for address -->
                            <label for="city"><i class="fa fa-institution"></i> City</label> <!-- Label for city -->
                            <input type="text" id="city" name="city " required> <!-- Input for city -->

                            <div class="row"> <!-- Start of inner row for state and zip -->
                                <div class="col-50"> <!-- Column for state -->
                                    <label for="state">State</label> <!-- Label for state -->
                                    <input type="text" id="state" name="state" required> <!-- Input for state -->
                                </div>
                                <div class="col-50"> <!-- Column for zip -->
                                    <label for="zip">Zip</label> <!-- Label for zip -->
                                    <input type="text" id="zip" name="zip" required> <!-- Input for zip -->
                                </div>
                            </div>
                        </div>

                        <div class="col-50"> <!-- Column for payment information -->
                            <h3>Payment</h3> <!-- Section heading -->
                            <label for="fname">Accepted Cards</label> <!-- Label for accepted cards -->
                            <div class="icon-container"> <!-- Container for card icons -->
                                <i class="fa fa-cc-visa" style="color:navy;"></i> <!-- Visa icon -->
                                <i class="fa fa-cc-amex" style="color:blue;"></i> <!-- American Express icon -->
                                <i class="fa fa-cc-mastercard" style="color:red;"></i> <!-- MasterCard icon -->
                                <i class="fa fa-cc-discover" style="color:orange;"></i> <!-- Discover card icon -->
                            </div>
                            <label for="cname">Name on Card</label> <!-- Label for card name -->
                            <input type="text" id="cname" name="cardname" required> <!-- Input for card name -->
                            <label for="ccnum">Credit Card Number</label> <!-- Label for credit card number -->
                            <input type="text" id="ccnum" name="cardnumber" required> <!-- Input for credit card number -->
                            <label for="expmonth">Exp Month</label> <!-- Label for expiration month -->
                            <input type="text" id="expmonth" name="expmonth" required> <!-- Input for expiration month -->
                            <div class="row"> <!-- Start of inner row for expiration year and CVV -->
                                <div class="col-50"> <!-- Column for expiration year -->
                                    <label for="expyear">Exp Year</label> <!-- Label for expiration year -->
                                    <input type="text" id="expyear" name="expyear" required> <!-- Input for expiration year -->
                                </div>
                                <div class="col-50"> <!-- Column for CVV -->
                                    <label for="cvv">CVV</label> <!-- Label for CVV -->
                                    <input type="text" id="cvv" name="cvv" required> <!-- Input for CVV -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <label> <!-- Checkbox for shipping address -->
                        <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing <!-- Checkbox label -->
                    </label>
                    <input type="button" value="Continue to Checkout" class="btn" onclick="window.location.href='checkout.php';"> <!-- Button to continue to checkout -->
                </form> <!-- End of form -->
            </div>
        </div>
    </div>
</body>

</html>