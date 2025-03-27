<?php
// Start output buffering
ob_start();

// Include the database connection file
include("connection/connect.php");  
// Suppress error reporting
error_reporting(0);  
// Start a new session
session_start(); 

// Include TCPDF library
require_once('tcpdf/tcpdf.php'); // Adjust the path as necessary

// Handle reservation form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reservation'])) {
    // Sanitize and retrieve reservation form data
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $guests = (int)$_POST['guests']; // Cast guests to an integer
    $date = mysqli_real_escape_string($db, $_POST['date']);
    $time = mysqli_real_escape_string($db, $_POST['time']);
    $special_requests = mysqli_real_escape_string($db, $_POST['special-requests']);

    // Insert reservation into the database
    $query = "INSERT INTO reservations (name, email, phone, guests, date, time, special_requests) 
              VALUES ('$name', '$email', '$phone', $guests, '$date', '$time', '$special_requests')";

    // Execute the query and check for success
    if (mysqli_query($db, $query)) {
        $success_message = "Reservation successfully made!"; // Success message
        generatePDFReceipt($name, $email, $phone, $guests, $date, $time, $special_requests); // Generate PDF receipt
    } else {
        $error_message = "Error: " . mysqli_error($db); // Error message
    }
}

// Handle customer review form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['review'])) {
    // Sanitize and retrieve review form data
    $customer_name = mysqli_real_escape_string($db, $_POST['customer-name']);
    $review_text = mysqli_real_escape_string($db, $_POST['review-text']);
    $rating = (int)$_POST['rating']; // Get the rating

    // Insert review into the database
    $query = "INSERT INTO reviews (customer_name, review_text, rating) 
              VALUES ('$customer_name', '$review_text', $rating)";

    // Execute the query and check for success
    if (mysqli_query($db, $query)) {
        $success_message = "Thank you for your review!"; // Success message
    } else {
        $error_message = "Error: " . mysqli_error($db); // Error message
    }
}

// Function to generate PDF receipt
function generatePDFReceipt($name, $email, $phone, $guests, $date, $time, $special_requests) {
    // Create new PDF document
    $pdf = new TCPDF();
    $pdf->SetCreator('CodeX');
    $pdf->SetAuthor('The Templers Café');
    $pdf->SetTitle('Reservation Receipt');
    $pdf->SetHeaderData('', 0,  'The Templers Café');
    $pdf->setHeaderFont(Array('helvetica', 'B', 14));
    $pdf->setFooterFont(Array('helvetica', '', 10));
    $pdf->SetDefaultMonospacedFont('courier');
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->AddPage();

    // Add content to the PDF
    $html = '<h1>Reservation Receipt</h1>
             <p><strong>Name:</strong> ' . $name . '</p>
             <p><strong>Email:</strong> ' . $email . '</p>
             <p><strong>Phone:</strong> ' . $phone . '</p>
             <p><strong>Number of Guests:</strong> ' . $guests . '</p>
             <p><strong>Date:</strong> ' . $date . '</p>
             <p><strong>Time:</strong> ' . $time . '</p>
             <p><strong>Special Requests:</strong> ' . $special_requests . '</p>
             <p><strong>Payment:</strong> Card</p>
             <p><strong>Total Cost:</strong> LKR 1200</p>'; // Added total cost

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('reservation_receipt.pdf', 'D'); // Download the PDF
    exit; // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icn.png" type="image/x-icon">
    <title>Home</title>

    <!--CSS file-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/reservation.css" rel="stylesheet">
    <link href="css/review.css" rel="stylesheet">
    <link href="css/chatbot.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
   
</head>

<!--nav bar section-->
<body class="home">
    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php">The Templers Café</a>
                <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item"><a class="nav-link active" href="featured_foods.php">Category <span class="sr-only"></span></a></li>
                        <li class="nav-item"><a class="nav-link active" href="#reservation">Reservation <span class="sr-only"></span></a></li>
                        <li class="nav-item"><a class="nav-link active" href="#contact">Contact us <span class="sr-only"></span></a></li>
                        <li class="nav-item"><a class="nav-link active" href="#review">Customer reviews <span class="sr-only"></span></a></li>
                      <?php
                        if(empty($_SESSION["user_id"])) {
                            //show login and registration links
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a></li>
                                  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a></li>';
                        } else {
                            echo '<li class="nav-item"><a href="loyalty-system.php" class="nav-link active">Loyalty</a></li>';
                            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a></li>';
                            echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="hero bg-image" data-image-src="images/img/gallery-5.jpg">
        <div class="hero-inner">
            <div class="container text-center hero-text font-white">
                <h1>Order Delivery & Take-Out</h1>
                <div class="banner-form">
                    <form class="form-inline"></form>
                </div>
            </div>
        </div>
    </section>

    <!--popular food section-->
    <section class="popular">
        <div class="container">
            <div class="title text-xs-center m-b-30">
                <h2>Popular Meals and Drinks of the Month</h2>
                <p class="lead">Easiest way to order your favourite food among these top 4</p>
            </div>
            <div class="row">
                <?php
                $query_res = mysqli_query($db, "SELECT * FROM dishes LIMIT 4");
                while($r = mysqli_fetch_array($query_res)) {
                    echo '<div class="col-xs-12 col-sm-6 col-md-4 food-item">
                            <div class="food-item-wrap">
                                <div class="figure-wrap bg-image" data-image-src="admin/Res_img/dishes/'.$r['img'].'"></div>
                                <div class="content">
                                    <h5><a href="dishes.php?res_id='.$r['ff_id'].'">'.$r['title'].'</a></h5>
                                    <div class="product-name">'.$r['slogan'].'</div>
                                    <div class="price-btn-block">
                                        <span class="price">LKR'.$r['price'].'</span>
                                        <a href="dishes.php?res_id='.$r['ff_id'].'" class="btn theme-btn-dash pull-right">Order Now</a>
                                    </div>
                                </div>
                            </div>
                          </div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!--reservation section-->
    <div class="reservation-container">
        <div class="form-header">
            <h2 id="reservation">Table Reservation</h2>
            <p>Please fill out the form below to reserve your table</p>
        </div>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="reservation" value="1">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="guests">Number of Guests</label>
                <select id="guests" name="guests" required>
                    <option value="">Select number of guests</option>
                    <option value="1">1 Person</option>
                    <option value="2">2 People</option>
                    <option value="3">3 People</option>
                    <option value="4">4 People</option>
                    <option value="5">5 People</option>
                    <option value="6">6 People</option>
                    <option value="7+">7+ People</option>
                </select>
            </div>

            <div class="time-date-group">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
                </div>

                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="time" id="time" name="time" required>
                </div>
            </div>

            <div class="form-group">
                <label for="special-requests">Special Requests (Optional)</label>
                <textarea id="special-requests" name="special-requests"></textarea>
            </div>

            <div class="form-group">
                <label>Payment Method</label>
                <input type="radio" id="credit-card" name="payment_method" value="Credit Card" required>
                <label for="credit-card">Debit Card/Credit Card</label>
            </div>

            <button type="submit" class="submit-btn">Reserve Table</button>
        </form>
    </div>

    <!--location section-->
    <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
        <iframe style="border:0; width: 100%; height: 400px;" 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.8399200294716!2d79.86742651390722!3d6.831317811039445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25a9b72577e7f%3A0x32c96cb04e88e407!2s37%20A%20Templers%20Rd%2C%20Dehiwala-Mount%20Lavinia!5e0!3m2!1sen!2slk!4v1676961268712!5m2!1sen!2slk" 
            frameborder="0" 
            allowfullscreen="" 
            loading="eager" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

     <!-- Contact Us Section -->
  <div class="contact-us-container">
        <div class="form-header">
            <h2 id="contact">Contact Us</h2>
            <p>If you have any questions, feel free to reach out!</p>
        </div>

        <form action="contact_process.php" method="POST">
            <div class="form-group">
                <label for="contact-name">Full Name</label>
                <input type="text" id="contact-name" name="contact-name" required>
            </div>

            <div class="form-group">
                <label for="contact-email">Email</label>
                <input type="email" id="contact-email" name="contact-email" required>
            </div>

            <div class="form-group">
                <label for="contact-message">Message</label>
                <textarea id="contact-message" name="contact-message" required></textarea>
            </div>

            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div>

    <!-- Customer Review Section -->
<div class="customer-review-container">
    <div class="form-header">
        <h2>Customer Reviews</h2>
        <p>Share your experience with us!</p>
    </div>

    <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php elseif (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="hidden" name="review" value="1">
        <div class="form-group">
            <label for="customer-name">Full Name</label>
            <input type="text" id="customer-name" name="customer-name" required>
        </div>

        <div class="form-group">
            <label for="review-text">Your Review</label>
            <textarea id="review-text" name="review-text" required></textarea>
        </div>

        <div class="form-group">
            <label for="rating">Rating</label>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5" required>
                <label for="star5" title="5 stars">★</label>
                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4" title="4 stars">★</label>
                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3" title="3 stars">★</label>
                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2" title="2 stars">★</label>
                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1" title="1 star">★</label>
            </div>
        </div>

        <button type="submit" class="submit-btn">Submit Review</button>
    </form>
</div>

    <!-- Customer Reviews Display Section -->
    <div class="customer-reviews-container">
        <div class="form-header">
            <h2 id="review">What Our Customers Say</h2>
        </div>

        <div class="reviews">
            <?php
            $reviews_query = mysqli_query($db, "SELECT * FROM reviews ORDER BY created_at DESC LIMIT 5");
            while($review = mysqli_fetch_array($reviews_query)) {
                echo '<div class="review-item">
                        <h5>' . htmlspecialchars($review['customer_name']) . '</h5>
                        <p>' . htmlspecialchars($review['review_text']) . '</p>
                        <p>Rating: ' . str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']) . '</p>
                        <small>' . htmlspecialchars($review['created_at']) . '</small>
                      </div>';
            }
            ?>
        </div>
    </div>

    <!--footer section-->
    <footer class="footer">
        <div class="container">
            <div class="bottom-footer">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 payment-options color-gray">
                        <h5>Payment Options</h5>
                        <ul>
                            <li><a href="#"><img src="images/mastercard.png" alt="Mastercard"></a></li>
                            <li><a href="#"><img src="images/maestro.png" alt="Maestro"></a></li>
                            <li><a href="#"><img src="images/stripe.png" alt="Stripe"></a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4 address color-gray">
                        <h5>Address</h5>
                        <p>Templers Road, Mount Lavinia, Sri Lanka</p>
                        <h5>Phone: 071 722 2444</h5>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5>Follow Us</h5>
                        <div class="social-links d-flex">
                            <a href="https://www.facebook.com/thetemplerscafe?mibextid=kFxxJD" class="facebook" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://www.instagram.com/thetemplers cafe?igsh=MXF1N3dxN3hhbXYw" class="instagram" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 10px; text-align: center;">
                <p>&copy; <?php echo date("Y"); ?> The Templers Café. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!--Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>

    <!-----------Chat_bot------->
    <div id="chatbot" class="chatbot">
        <div class="chatbot-header">
            <h4>Chat with Us!</h4>
            <button id="close-chat" onclick="toggleChat()">X</button>
        </div>
        <div class="chatbot-messages" id="chatbot-messages"></div>
        <input type="text" id="user-input" placeholder="Type your message..." onkeypress="handleKeyPress(event)">
    </div>
    <button id="open-chat" onclick="toggleChat()">ChatBot!</button>

    <script>
    function toggleChat() {
        const chatbot = document.getElementById('chatbot');
        chatbot.style.display = chatbot.style.display === 'none' || chatbot.style.display === '' ? 'flex' : 'none';
    }

    function handleKeyPress(event) {
        if (event.key === 'Enter') {
            const userInput = document.getElementById('user-input');
            const message = userInput.value;
            if (message.trim() !== '') {
                addMessage('You: ' + message);
                userInput.value = '';
                respondToMessage(message);
            }
        }
    }

    function addMessage(message) {
        const messagesContainer = document.getElementById('chatbot-messages');
        const messageElement = document.createElement('p');
        messageElement.textContent = message;
        messagesContainer.appendChild(messageElement);
        messagesContainer.scrollTop = messagesContainer.scrollHeight; // Scroll to the bottom
    }

    function respondToMessage(message) {
        let response = "I'm sorry, I didn't understand that.";
        
        // Simple AI-like responses
        const lowerMessage = message.toLowerCase();
        if (lowerMessage.includes('reservation')) {
            response = "You can make a reservation by filling out the form above.";
        } else if (lowerMessage.includes('menu')) {
            response = "You can view our menu on the 'Category' page.";
        } else if (lowerMessage.includes('hours')) {
            response = "We are open from 8 AM to 10 PM.";
        } else if (lowerMessage.includes('hello') || lowerMessage.includes('hi')) {
            response = "Hello! How can I assist you today?";
        } else if (lowerMessage.includes('thank you')) {
            response = "You're welcome! If you have any more questions, feel free to ask.";
        } else if (lowerMessage.includes('help')) {
            response = "Sure! What do you need help with?";
        }
        
        addMessage('Bot: ' + response);
    }
    </script>
</body>
</html>
<?php
// End output buffering
ob_end_flush();
?>