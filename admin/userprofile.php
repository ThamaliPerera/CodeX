<!DOCTYPE html>
<html lang="en">
<?php
// Start the session
session_start();
// Disable error reporting
error_reporting(0);
// Include the database connection file
include("../connection/connect.php");

// Check if the user is logged in by verifying the session variable
if (strlen($_SESSION['user_id']) == 0) { 
    header('location:../login.php'); // Redirect to login page if not logged in
} else {
    // Handle form submission
    if (isset($_POST['update'])) {
        // Get form ID and other details from the POST request
        $form_id = $_GET['form_id'];
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        
        // Insert remark into the database
        $query = mysqli_query($db, "INSERT INTO remark(frm_id, status, remark) VALUES('$form_id', '$status', '$remark')");
        // Update the status of the order in the users_orders table
        $sql = mysqli_query($db, "UPDATE users_orders SET status='$status' WHERE o_id='$form_id'");

        // Show an alert message indicating successful update
        echo "<script>alert('form details updated successfully');</script>";
    }
?>
<script language="javascript" type="text/javascript">
// Function to close the current window
function f2() {
    window.close();
}
// Function to print the current window
function f3() {
    window.print(); 
}
</script>

<head>
    <meta charset="utf-8"> <!-- Set character encoding -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Set compatibility for Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive design -->
    <meta name="description" content=""> <!-- Page description -->
    <meta name="author" content=""> <!-- Author of the page -->
    <title>User Profile</title> <!-- Page title -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="css/helper.css" rel="stylesheet"> <!-- Helper CSS -->
    <link href="css/style.css" rel="stylesheet"> <!-- Custom style CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- jQuery library -->
    
<style type="text/css" rel="stylesheet">
/* Custom styles for the form and layout */
.indent-small {
  margin-left: 5px; /* Small indentation */
}
.form-group.internal {
  margin-bottom: 0; /* No margin at the bottom */
}
.dialog-panel {
  margin: 10px; /* Margin for dialog panel */
}
.datepicker-dropdown {
  z-index: 200 !important; /* Ensure datepicker dropdown is above other elements */
}
.panel-body {
  background: #e5e5e5; /* Background color */
  background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%); /* Gradient background */
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff)); /* Gradient background */
  background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%); /* Gradient background */
  background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%); /* Gradient background */
  background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%); /* Gradient background */
  background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%); /* Gradient background */
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1); /* IE gradient */
  font: 600 15px "Open Sans", Arial, sans-serif; /* Font style */
}
label.control-label {
  font-weight: 600; /* Bold font weight */
  color: #777; /* Text color */
}

/* Table styles */
table { 
	width: 650px; /* Table width */
	border-collapse: collapse; /* Collapse borders */
	margin: auto; /* Center the table */
	margin-top: 50px; /* Margin at the top */
}

tr:nth-of-type(odd) { 
	background: #eee; /* Background color for odd rows */
}

th { 
	background: #004684; /* Header background color */
	color: white; /* Header text color */
	font-weight: bold; /* Bold header text */
}

td, th { 
	padding: 10px; /* Padding for table cells */
	border: 1px solid #ccc; /* Border for table cells */
	text-align: left; /* Left align text */
	font-size: 14px; /* Font size */
}
</style>
</head>

<body>

<div style="margin-left:50px;"> <!-- Container for the form -->
 <form name="updateticket" id="updatecomplaint" method="post"> <!-- Form for updating order details -->
 
<table border="0" cellspacing="0" cellpadding="0"> <!-- Table for form layout -->
    
<?php 
// Query to fetch order details based on the form ID
$ret1 = mysqli_query($db, "SELECT * FROM users_orders WHERE o_id='" . $_GET['newform_id'] . "'");
$ro = mysqli_fetch_array($ret1); // Fetch the result as an associative array
$ret2 = mysqli_query($db, "SELECT * FROM users WHERE u_id='" . $ro['u_id'] . "'"); // Query to fetch user details

while ($row = mysqli_fetch_array($ret2)) { // Loop through each user record
?>
  
    <tr>
      <td colspan="2"><b><?php echo $row['f_name']; ?>'s profile</b></td> <!-- Display user's first name -->
    </tr>
    
    <tr>
      <td>&nbsp;</td> <!-- Empty row for spacing -->
      <td>&nbsp;</td> <!-- Empty row for spacing -->
    </tr>
    <tr height="50">
      <td><b>Reg Date:</b></td> <!-- Label for registration date -->
      <td><?php echo htmlentities($row['date']); ?></td> <!-- Display registration date -->
    </tr>
	
	<tr height="50">
      <td><b>First Name:</b></td> <!-- Label for first name -->
      <td><?php echo htmlentities($row['f_name']); ?></td> <!-- Display first name -->
    </tr>
	<tr height="50">
      <td><b>Last Name:</b></td> <!-- Label for last name -->
      <td><?php echo htmlentities($row['l_name']); ?></td> <!-- Display last name -->
    </tr>
	
    <tr height="50">
      <td><b>User Email:</b></td> <!-- Label for user email -->
      <td><?php echo htmlentities($row['email']); ?></td> <!-- Display user email -->
    </tr>

<tr height="50">
      <td><b>User Phone:</b></td> <!-- Label for user phone -->
      <td><?php echo htmlentities($row['phone']); ?></td> <!-- Display user phone -->
    </tr>
     
    <tr height="50">
      <td><b>Status:</b></td> <!-- Label for status -->
      <td><?php if ($row['status'] == 1) { echo "<div class='btn btn-primary'>Active</div>"; } else { echo "<div class='btn btn-danger'>Block</div>"; } ?></td> <!-- Display status as Active or Block -->
    </tr>
    
    <tr>
      <td colspan="2">   
      <input name="Submit2" type="submit" class="btn btn-danger" value="Close this window" onClick="return f2();" style="cursor: pointer;"  /></td> <!-- Button to close the window -->
    </tr>
   
    <?php } // End of while loop ?>
 
</table>
 </form>
</div>

</body>
</html>

<?php } // End of else statement ?>