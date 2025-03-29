<?php
// Check if the "action" parameter is not empty in the URL
if(!empty($_GET["action"])) 
{
    // Get the product ID from the URL and sanitize it
    $productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
    // Get the quantity from the POST request and sanitize it
    $quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';

    // Switch case to handle different actions based on the "action" parameter
    switch($_GET["action"])
    {
        // Case for adding a product to the cart
        case "add":
            // Check if the quantity is not empty
            if(!empty($quantity)) {
                // Prepare a statement to select the product details from the database
                $stmt = $db->prepare("SELECT * FROM dishes where d_id= ?");
                $stmt->bind_param('i', $productId); // Bind the product ID parameter
                $stmt->execute(); // Execute the query
                $productDetails = $stmt->get_result()->fetch_object(); // Fetch the product details as an object
                
                // Create an array for the item to be added to the cart
                $itemArray = array($productDetails->d_id => array('title' => $productDetails->title, 'd_id' => $productDetails->d_id, 'quantity' => $quantity, 'price' => $productDetails->price));
                
                // Check if the cart already has items
                if(!empty($_SESSION["cart_item"])) 
                {
                    // Check if the product is already in the cart
                    if(in_array($productDetails->d_id, array_keys($_SESSION["cart_item"]))) 
                    {
                        // Loop through the cart items
                        foreach($_SESSION["cart_item"] as $k => $v) 
                        {
                            // If the product ID matches, update the quantity
                            if($productDetails->d_id == $k) 
                            {
                                // If quantity is empty, initialize it to 0
                                if(empty($_SESSION["cart_item"][$k]["quantity"])) 
                                {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                // Increment the quantity of the product in the cart
                                $_SESSION["cart_item"][$k]["quantity"] += $quantity;
                            }
                        }
                    }
                    // If the product is not in the cart, add it
                    else 
                    {
                        $_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
                    }
                } 
                // If the cart is empty, initialize it with the new item
                else 
                {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
            
        // Case for removing a product from the cart
        case "remove":
            // Check if there are items in the cart
            if(!empty($_SESSION["cart_item"]))
            {
                // Loop through the cart items
                foreach($_SESSION["cart_item"] as $k => $v) 
                {
                    // If the product ID matches, remove it from the cart
                    if($productId == $v['d_id'])
                        unset($_SESSION["cart_item"][$k]);
                }
            }
            break;
            
        // Case for emptying the cart
        case "empty":
            unset($_SESSION["cart_item"]); // Remove all items from the cart
            break;
            
        // Case for checking out
        case "check":
            header("location:checkout.php"); // Redirect to the checkout page
            break;
    }
}