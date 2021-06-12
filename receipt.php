<?php
    require_once "settings.php";

    // Redirect Page If Order ID Not Set Or Invalid
    session_start();
    if (!isset($_SESSION["order_id"])) { die(header("location:enquire.php")); }
    else {
        $order_id = $_SESSION["order_id"];
        if (!is_numeric($order_id) || empty($order_id) || $order_id <= 0) { header("location:enquire.php"); }
    }
    // Destroy Session As Not Needed Anymore
    $_SESSION = array();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="CourseNation is the world's leading short training courses. Get professional-level training in a wide range of industries within just 3 months!" />
    <meta name="keyword" content="CourseNation Receipt, Professional Training, Web Dev Course, Digital Marketing Course" />
    <meta name="author" content="Karan Manoj Shah" />

    <title>Receipt | CourseNation</title>
    <link rel="icon" href="images/icon.png" />

    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/responsive.css" />

    <script src="scripts/enhancements.js"></script>
</head>
<body>
    <!-- Header -->
    <?php include "includes/header.inc" ?>
    <!-- Navigation -->
    <?php include "includes/navigation.inc" ?>
    <!-- Article -->
    <article>
        <h1>Receipt</h1>
        <?php
            // Establish Connection With Database
            $connection = @mysqli_connect($host, $username, $password, $database) or die("<p>An error occured while connecting to the database.</p>");
            // Get Record With Specified Order ID
            $table = "orders";
            $get_order_query = "SELECT * FROM $table WHERE order_id = $order_id";
            $get_order_result = mysqli_query($connection, $get_order_query);
            // Check If Query Successful
            if (!$get_order_result) {
                echo  "<p>An error occured while fetching order details.</p>";
            } else {
                // Set Order Variables
                $order = mysqli_fetch_assoc($get_order_result);
                $id = $order["order_id"];
                $product = $order["product_name"] . " (A$" . $order["product_price"] . ")";
                $quantity = $order["product_quantity"];
                $optional = $order["product_optional_features"];
                // Convert Optional Features From String To Unordered List
                $optional = "<ul><li>" . $optional;
                $optional = str_replace(",", "</li><li>", $optional);
                $optional .= "</li></ul>";
                $cost = "A$" . $order["order_cost"];
                $comments = $order["comments"];
                // If No Comments, Show "None"
                if ($comments == "") { $comments = "None"; }
                $time = $order["order_time"];
                $status = $order["order_status"];
                $name = $order["f_name"] . " " . $order["l_name"];
                $email = $order["email"];
                $phone = $order["phone_no"];
                $delivery = $order["delivery_street"] . ", " . $order["delivery_suburb"] . ", " . $order["delivery_state"] . " (" . $order["delivery_postcode"] . ")";
                $billing = $order["billing_address"];
                $preferred_contact = $order["preferred_contact"];
                $cc_type = $order["cc_type"];
                $cc_number = $order["cc_number"][0] . $order["cc_number"][1];
                if ($cc_type == "Mastercard" || $cc_type == "Mastercard") {
                    $cc_number .= "************" . $order["cc_number"][14] . $order["cc_number"][15];
                } else {
                    $cc_number .= "***********" . $order["cc_number"][13] . $order["cc_number"][14];
                }
                $cc_name = $order["cc_name"];
                $cc_expiry = $order["cc_expiry"];
                $cc_cvv = "***";
                // Draw Tables If Order Exists
                if ($order) { ?>
                    <table>
                        <caption>Order Summary</caption>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Optional Features</th>
                                <th>Qty</th>
                                <th>Cost</th>
                                <th>Comments</th>
                                <th>Order Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo "$id"; ?></td>
                                <td><?php echo "$product"; ?></td>
                                <td><?php echo "$optional"; ?></td>
                                <td><?php echo "$quantity"; ?></td>
                                <td><?php echo "$cost"; ?></td>
                                <td><?php echo "$comments"; ?></td>
                                <td><?php echo "$time"; ?></td>
                                <td><?php echo "$status"; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                    <table>
                        <caption>Personal Details</caption>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Delivery Address</th>
                                <th>Billing Address</th>
                                <th>Preferred Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo "$name"; ?></td>
                                <td><?php echo "$email"; ?></td>
                                <td><?php echo "$phone"; ?></td>
                                <td><?php echo "$delivery"; ?></td>
                                <td><?php echo "$billing"; ?></td>
                                <td><?php echo "$preferred_contact"; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                    <table>
                        <caption>Credit Card Details</caption>
                        <thead>
                            <tr>
                                <th>Card Type</th>
                                <th>Card Number</th>
                                <th>Name On Card</th>
                                <th>Card Expiry</th>
                                <th>CVV</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo "$cc_type"; ?></td>
                                <td><?php echo "$cc_number"; ?></td>
                                <td><?php echo "$cc_name"; ?></td>
                                <td><?php echo "$cc_expiry"; ?></td>
                                <td><?php echo "$cc_cvv"; ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php } else {
                    echo "<p>No order with this ID found.</p>";
                }
            }
            // Close Connection
            mysqli_close($connection);
        ?>
    </article>
    <!-- Footer -->
    <?php include "includes/footer.inc" ?>
</body>
</html>
