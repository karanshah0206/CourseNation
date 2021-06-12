<?php
    /* Filename:        process_order.php
       Purpose:         Validate Order Data & Update To Database
       Author:          Karan Manoj Shah
       Date Written:    18 May 2021 */

    require_once "settings.php";

    // Remove slashes, HTML special characters, and leading/training whitespaces
    function sanitise($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Calculates total cost of the order
    function calculate_total_cost($product_price, $product_quantity, $optional_features) {
        $optional_costs = calculate_optional_costs($optional_features);
        $total_cost = ($product_price + $optional_costs) * $product_quantity;
        return $total_cost;
    }

    // Calculates the cost of optional features added with product
    function calculate_optional_costs($optional_features) {
        $optional_costs = 0;
        // Checking if Certification is a selected optional feature
        if (strpos($optional_features, "Certification") !== false) {
            $optional_costs += 150;
        }
        // Checking if Flexible Scheduling is a selected optional feature
        if (strpos($optional_features, "Flexible") !== false) {
            $optional_costs += 70;
        }
        // Checking if Resources & Services is a selected optional feature
        if (strpos($optional_features, "Resources") !== false) {
            $optional_costs += 100;
        }
        // Checking if Industry Placement is a selected optional feature
        if (strpos($optional_features, "Industry") !== false) {
            $optional_costs += 150;
        }
        return $optional_costs;
    }

    // Validate Order Data
    $errorMsg = "";
    // First Name
    if (!isset($_POST["user_first_name"])) { die(header("location:enquire.php")); }
    else {
        $f_name = sanitise($_POST["user_first_name"]);
        if (!preg_match("/^[A-Za-z]{1,25}$/",$f_name)) {
            $errorMsg .= "<p>First Name is required and can only contain alphabets, max 25.</p>";
        }
    }
    // Last Name
    if (!isset($_POST["user_last_name"])) { die(header("location:enquire.php")); }
    else {
        $l_name = sanitise($_POST["user_last_name"]);
        if (!preg_match("/^[A-Za-z]{1,25}$/",$f_name)) {
            $errorMsg .= "<p>Last name is required and can only contain alphabets, max 25.</p>";
        }
    }
    // Email
    if (!isset($_POST["user_email"])) { die(header("location:enquire.php")); }
    else {
        $email = sanitise($_POST["user_email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "<p>Provide A Valid Email.</p>";
        }
    }
    // Delivery Street
    if (!isset($_POST["user_street_address"])) { die(header("location:enquire.php")); }
    else {
        $street = sanitise($_POST["user_street_address"]);
        if (!preg_match("/^.{1,40}$/", $street)) {
            $errorMsg .= "<p>Delivery address street is required and has maximum 40 characters.</p>";
        }
    }
    // Delivery Suburb
    if (!isset($_POST["user_suburb_address"])) { die(header("location:enquire.php")); }
    else {
        $suburb = sanitise($_POST["user_suburb_address"]);
        if (!preg_match("/^.{1,20}$/", $suburb)) {
            $errorMsg .= "<p>Delivery address suburb is required and has maximum 20 characters.</p>";
        }
    }
    // Delivery State
    if (!isset($_POST["user_state_address"])) { die(header("location:enquire.php")); }
    else {
        $state = sanitise($_POST["user_state_address"]);
        if (empty($state) || $state == "null") {
            $errorMsg .= "<p>Selecting delivery address state is required.</p>";
        }
    }
    // Delivery Postcode
    if (!isset($_POST["user_postcode_address"])) { die(header("location:enquire.php")); }
    else {
        $postcode = sanitise($_POST["user_postcode_address"]);
        if (!preg_match("/^\d{4}$/", $postcode)) {
            $errorMsg .= "<p>Delivery address postcode is required and can only be 4 digits.</p>";
        }
    }
    // State vs Postcode (validate only if both state and postcode are valid)
    if (!empty($state) && $state != "null" && preg_match("/^\d{4}$/", $postcode)) {
        switch ($postcode[0]) {
            case "3":
            case "8":
                if ($state != "VIC") { $errorMsg.= "<p>Invalid Delivery Address postcode '" . $postcode . "' for " . $state .".</p>"; }
                break;
            case "1":
            case "2":
                if ($state != "NSW") { $errorMsg.= "<p>Invalid Delivery Address postcode '" . $postcode . "' for " . $state .".</p>"; }
                break;
            case "4":
            case "9":
                if ($state != "QLD") { $errorMsg.= "<p>Invalid Delivery Address postcode '" . $postcode . "' for " . $state .".</p>"; }
                break;
            case "0":
                if ($state != "ACT" && $state != "NT") { $errorMsg.= "<p>Invalid Delivery Address postcode '" . $postcode . "' for " . $state .".</p>"; }
                break;
            case "6":
                if ($state != "WA") { $errorMsg.= "<p>Invalid Delivery Address postcode '" . $postcode . "' for " . $state .".</p>"; }
                break;
            case "5":
                if ($state != "SA") { $errorMsg.= "<p>Invalid Delivery Address postcode '" . $postcode . "' for " . $state .".</p>"; }
                break;
            case "7":
                if ($state != "TAS") { $errorMsg.= "<p>Invalid Delivery Address postcode '" . $postcode . "' for " . $state .".</p>"; }
                break;
            default:
                $errorMsg.= "<p>Invalid Delivery Address Postcode.</p>";
                break;
        }
    }
    // Billing Address
    if (!isset($_POST["user_billing_address"])) { die(header("location:enquire.php")); }
    else {
        $billing = sanitise($_POST["user_billing_address"]);
        if (empty($billing) || $billing == "null" || $billing == ", , ()") {
            $errorMsg .= "<p>Invalid Billing Address.</p>";
        }
    }
    // Phone
    if (!isset($_POST["user_phone"])) { die(header("location:enquire.php")); }
    else {
        $phone = sanitise($_POST["user_phone"]);
        if (!preg_match("/^\d{10}$/", $phone)) {
            $errorMsg .= "<p>Phone number is required and can only be 10 digits.</p>";
        }
    }
    // Preferred Contact
    if (!isset($_POST["user_preferred_contact"])) { die(header("location:enquire.php")); }
    else {
        $preferred_contact = sanitise($_POST["user_preferred_contact"]);
        if (empty($preferred_contact) || $preferred_contact == "null") {
            $errorMsg .= "<p>Selecting a preferred contact is required.</p>";
        }
    }
    // Comments
    $comments = sanitise($_POST["user_comments"]); // Not a required field, hence no isset.
    $comments = str_replace("'", "`", $comments); // Remove Any Chance of SQL Injection
    // Product Name
    if (!isset($_POST["product_name"])) { die(header("location:enquire.php")); }
    else {
        $product_name = sanitise($_POST["product_name"]);
        if (empty($product_name) || $product_name == "null") {
            $errorMsg .= "<p>Choosing a course is required.</p>";
        }
    }
    // Product Price
    if (!isset($_POST["product_price"])) { die(header("location:enquire.php")); }
    else {
        $product_price = sanitise($_POST["product_price"]);
        if (empty($product_price) || $product_price == "null") { $errorMsg .= "<p>Product price cannot be empty! Select a course to set price.</p>"; }
        else if (!is_numeric($product_price)) { $errorMsg .= "<p>Product price must be a number.</p>"; }
        else if ($product_price < 0) { $errorMsg .= "<p>Product price cannot be negative.</p>"; }
    }
    // Product Quantity
    if (!isset($_POST["product_quantity"])) { die(header("location:enquire.php")); }
    else {
        $product_quantity = sanitise($_POST["product_quantity"]);
        if (!is_numeric($product_quantity)) {
            $errorMsg .= "<p>Product quantity is required and must be a number.</p>";
        } else if ($product_quantity < 0 || $product_quantity > 5) {
            $errorMsg .= "<p>Product quantity must be between 1 and 5.</p>";
        }
    }
    // Optional Features
    if (!isset($_POST["optional_features"])) { die(header("location:enquire.php")); }
    else {
        $optional_features = sanitise($_POST["optional_features"]);
        if (empty($optional_features) || $optional_features == "null") {
            $errorMsg .= "<p>At least 1 optional feature must be selected.</p>";
        }
    }
    // Card Name
    if (!isset($_POST["credit_card_type"])) { die(header("location:enquire.php")); }
    else {
        $cc_type = sanitise($_POST["credit_card_type"]);
        if ($cc_type != "Visa" && $cc_type != "Mastercard" && $cc_type != "American Express") {
            $errorMsg .= "<p>You must choose your credit card type.</p>";
        }
    }
    // Card Number
    if (!isset($_POST["credit_card_number"])) { die(header("location:enquire.php")); }
    else {
        $cc_number = sanitise($_POST["credit_card_number"]);
        if (!preg_match("/^\d{15,16}$/", $cc_number)) {
            $errorMsg .= "<p>Credit Card Number is required and must be 15 to 16 digits only.</p>";
        }
    }
    // Card Type vs Card Number (validate only if card type and number are valid)
    if (preg_match("/^\d{15,16}$/", $cc_number) && !empty($cc_type)) {
        switch ($cc_type) {
            case "Visa":
                if (strlen($cc_number) != 16) { $errorMsg .= "<p>Visa cards have 16 digits.</p>"; }
                if ($cc_number[0] != "4") { $errorMsg .= "<p>Visa cards start with the digit 4.</p>"; }
                break;
            case "Mastercard":
                if (strlen($cc_number) != 16) { $errorMsg .= "<p>Mastercard cards have 16 digits.</p>"; }
                if (($cc_number[0] != "5") || ($cc_number[1] != "1" && $cc_number[1] != "2" && $cc_number[1] != "3" && $cc_number[1] != "4" && $cc_number[1] != "5")) { $errorMsg .= "<p>Mastercard cards start with digits 51 through 55.</p>"; }
                break;
            case "American Express":
                if (strlen($cc_number) != 15) { $errorMsg .= "<p>American Express cards have 15 digits.</p>"; }
                if (($cc_number[0] != "3") || ($cc_number[1] != "7" && $cc_number[1] != "4")) { $errorMsg .= "<p>American Express cards start with 34 or 37.</p>"; }
                break;
            default:
                $errorMsg .= "</p>Select a valid credit card type.</p>";
                break;
        }
    }
    // Card Name
    if (!isset($_POST["credit_card_name"])) { die(header("location:enquire.php")); }
    else {
        $cc_name = sanitise($_POST["credit_card_name"]);
        if (!preg_match("/^[A-Za-z ]{1,40}$/", $cc_name)) {
            $errorMsg .= "<p>Card name must have 1 to 40 alphabets and/or spaces only.</p>";
        }
    }
    // Card Expiry
    if (!isset($_POST["credit_card_expiry"])) { die(header("location:enquire.php")); }
    else {
        $cc_expiry = sanitise($_POST["credit_card_expiry"]);
        if (!preg_match("/^\d\d-\d\d$/", $cc_expiry)) {
            $errorMsg .= "<p>Credit card expiry is required and the correct format is mm-yy (digits only).</p>";
        }
    }
    // Card CVV
    if (!isset($_POST["credit_card_cvv"])) { die(header("location:enquire.php")); }
    else {
        $cc_cvv = sanitise($_POST["credit_card_cvv"]);
        if (!preg_match("/^\d{3}$/", $cc_cvv)) {
            $errorMsg .= "<p>CVV is required and must be 3 digits only.</p>";
        }
    }

    if ($errorMsg == "") {
        // Get Total Cost
        $total_cost = calculate_total_cost($product_price, $product_quantity, $optional_features);
        // Establish Connection With Database
        $connection = @mysqli_connect($host, $username, $password, $database) or die("<p>An error occured while connecting to the database.</p>");
        // Check If Table Exists
        $table = "orders";
        $test_table_exists_query = "SHOW TABLES LIKE '$table'";
        $table_test_result = @mysqli_query($connection, $test_table_exists_query);
        if (mysqli_num_rows($table_test_result) == 0) { // Table Does Not Exist
            // Create Table
            $create_table_query =   "CREATE TABLE $table (order_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, f_name VARCHAR(25), l_name VARCHAR(25), email VARCHAR(80), delivery_street VARCHAR(40), delivery_suburb VARCHAR(20), delivery_state VARCHAR(3), delivery_postcode VARCHAR(4), billing_address VARCHAR(80), phone_no VARCHAR(10), preferred_contact VARCHAR(10), comments VARCHAR(500), product_name VARCHAR(50), " .
                                    " product_price INT, product_quantity TINYINT, product_optional_features VARCHAR(150), order_cost INT, cc_type VARCHAR(20), cc_number VARCHAR(16), cc_name VARCHAR(100), cc_expiry VARCHAR(5), cc_cvv VARCHAR(3), order_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, order_status VARCHAR(10))";
            $create_table_result = @mysqli_query($connection, $create_table_query);
            if ($create_table_result === false) { // Error In Creating Table
                echo "<p>An error occured while creating orders table.</p>";
                mysqli_close($connection);
                die(); // Do Not Execute Further
            }
        }
        $default_order_status = "PENDING";
        $add_order_query =  "INSERT INTO $table (f_name, l_name, email, delivery_street, delivery_suburb, delivery_state, delivery_postcode, billing_address, phone_no, preferred_contact, comments, product_name, product_price, product_quantity, product_optional_features, order_cost, cc_type, cc_number, cc_name, cc_expiry, cc_cvv, order_status)" .
                            " VALUES ('$f_name', '$l_name', '$email', '$street', '$suburb', '$state', '$postcode', '$billing', '$phone', '$preferred_contact', '$comments', '$product_name', $product_price, $product_quantity, '$optional_features', $total_cost, '$cc_type', '$cc_number', '$cc_name', '$cc_expiry', '$cc_cvv', '$default_order_status')";
        $add_order_result = mysqli_query($connection, $add_order_query);
        if (!$add_order_result) {
            echo "<p>An error occured while saving order details.</p>";
        } else {
            // Get Latest Order ID and Pass Using SESSION To Receipt Page
            $order_id_query = "SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1";
            $order_id_result = mysqli_query($connection, $order_id_query);
            $order_id = mysqli_fetch_assoc($order_id_result)["order_id"];
            session_start();
            $_SESSION["order_id"] = $order_id;
            header("location:receipt.php");
        }
        // Close Connection
        mysqli_close($connection);
    } else {
        session_start();
        $_SESSION["errorMsg"] = $errorMsg; // Pass Error Message as string to SESSION
        $_SESSION["form_data"] = $_POST; // Pass All POST Data as array to SESSION
        header("location:fix_order.php"); // Redirect to fix_order.php
        // echo $errorMsg;
    }
?>
