<?php
// Include the database connection file
include("../connection/connect.php");
// Disable error reporting
error_reporting(0);
// Start the session
session_start();

// Check if the user is logged in by verifying the session variable
if(strlen($_SESSION['user_id'])==0) { 
    header('location:../login.php'); // Redirect to login page if not logged in
} else {
    // Check if the update form is submitted
    if(isset($_POST['update'])) {
        // Get the form ID and other details from the POST request
        $form_id = $_GET['form_id']; // Get the form ID from the URL
        $status = $_POST['status']; // Get the status from the form
        $remark = $_POST['remark']; // Get the remark from the form
        
        // Insert the remark and status into the remark table
        $query = mysqli_query($db, "INSERT INTO remark(frm_id, status, remark) VALUES('$form_id', '$status', '$remark')");
        
        // Update the status of the order in the users_orders table
        $sql = mysqli_query($db, "UPDATE users_orders SET status='$status' WHERE o_id='$form_id'");

        // Show an alert message indicating successful update
        echo "<script>alert('Form Details Updated Successfully');</script>";
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
    <title>Order Update</title> <!-- Page title -->
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
     <tr>
      <td><b>Form Number</b></td> <!-- Label for form number -->
      <td><?php echo htmlentities($_GET['form_id']); ?></td> <!-- Display the form ID -->
    </tr>
	<tr>
      <td>&nbsp;</td> <!-- Empty row for spacing -->
      <td>&nbsp;</td> <!-- Empty row for spacing -->
    </tr>
   
    <tr>
      <td><b>Status</b></td> <!-- Label for status -->
      <td>
          <select name="status" required="required"> <!-- Dropdown for selecting status -->
              <option value="">Select Status</option> <!-- Default option -->
              <option value="in process">On the way</option> <!-- Option for 'On the way' -->
              <option value="closed">Delivered</option> <!-- Option for 'Delivered' -->
              <option value="rejected">Cancelled</option> <!-- Option for 'Cancelled' -->
          </select>
      </td>
    </tr>

    <tr>
      <td><b>Message</b></td> <!-- Label for message -->
      <td><textarea name="remark" cols="50" rows="10" required="required"></textarea></td> <!-- Textarea for remarks -->
    </tr>

    <tr>
      <td><b>Action</b></td> <!-- Label for action -->
      <td>
          <input type="submit" name="update" class="btn btn-primary" value="Submit"> <!-- Submit button -->
          <input name="Submit2" type="submit" class="btn btn-danger" value="Close this window" onClick="return f2();" style="cursor: pointer;" /> <!-- Close button -->
      </td>
    </tr>
</table>
 </form>
</div>

</body>
</html>

<?php } ?> <!-- End of the PHP script -->