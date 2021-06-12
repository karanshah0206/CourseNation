<?php
    session_start();
    if (!isset($_SESSION["errorMsg"])) {
        $_SESSION = array();
        session_destroy();
        header("location:enquire.php");
    } else {
        $errorMsg = $_SESSION["errorMsg"];
    }
    if (!isset($_SESSION["form_data"])) {
        $_SESSION = array();
        session_destroy();
        die(header("location:enquire.php"));
    } else {
        $form_data = $_SESSION["form_data"];
    }
    // Clear Session Once Values Retrieved
    $_SESSION = array();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="CourseNation is the world's leading short training courses. Get professional-level training in a wide range of industries within just 3 months!" />
    <meta name="keyword" content="CourseNation Fix Order, Professional Training, Web Dev Course, Digital Marketing Course" />
    <meta name="author" content="Karan Manoj Shah" />

    <title>Fix Order | CourseNation</title>
    <link rel="icon" href="images/icon.png" />

    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/responsive.css" />

    <script src="scripts/part2.js"></script>
</head>
<body>
    <!-- Header -->
    <?php include "includes/header.inc" ?>
    <!-- Navigation -->
    <?php include "includes/navigation.inc" ?>
    <!-- Article -->
    <article>
        <h1>Fix Order</h1>
        <br />
        <p><strong>The following errors were found in your form:</strong></p>
        <?php echo $errorMsg; ?>
        <br />
        <form id="fix_form" method="POST" action="process_order.php" novalidate="novalidate">
            <p>
                <label for="user_first_name">First Name</label>
                <input type="text" id="user_first_name" name="user_first_name" value="<?php echo $form_data['user_first_name'] ?>" />
            </p>
            <p>
                <label for="user_last_name">Last Name</label>
                <input type="text" id="user_last_name" name="user_last_name" value="<?php echo $form_data['user_last_name'] ?>" />
            </p>
            <p>
                <label for="user_email">Email</label>
                <input type="text" id="user_email" name="user_email" value="<?php echo $form_data['user_email'] ?>" />
            </p>
            <fieldset>
                <legend>Delivery Address</legend>
                <p>
                    <label for="user_street_address">Street</label>
                    <input type="text" id="user_street_address" name="user_street_address" value="<?php echo $form_data['user_street_address'] ?>" />
                </p>
                <p>
                    <label for="user_suburb_address">Suburb/Town</label>
                    <input type="text" id="user_suburb_address" name="user_suburb_address" value="<?php echo $form_data['user_suburb_address'] ?>" />
                </p>
                <p>
                    <label for="user_state_address">State</label>
                    <select id="user_state_address" name="user_state_address">
                        <option value="">Select State</option>
                        <option value="VIC" <?php if ($form_data["user_state_address"] == "VIC") { echo "selected=\"selected\""; } ?>>VIC</option>
                        <option value="NSW" <?php if ($form_data["user_state_address"] == "NSW") { echo "selected=\"selected\""; } ?>>NSW</option>
                        <option value="QLD" <?php if ($form_data["user_state_address"] == "QLD") { echo "selected=\"selected\""; } ?>>QLD</option>
                        <option value="NT" <?php if ($form_data["user_state_address"] == "NT") { echo "selected=\"selected\""; } ?>>NT</option>
                        <option value="WA" <?php if ($form_data["user_state_address"] == "WA") { echo "selected=\"selected\""; } ?>>WA</option>
                        <option value="SA" <?php if ($form_data["user_state_address"] == "SA") { echo "selected=\"selected\""; } ?>>SA</option>
                        <option value="TAS" <?php if ($form_data["user_state_address"] == "TAS") { echo "selected=\"selected\""; } ?>>TAS</option>
                        <option value="ACT" <?php if ($form_data["user_state_address"] == "ACT") { echo "selected=\"selected\""; } ?>>ACT</option>
                    </select>
                </p>
                <p>
                    <label for="user_postcode_address">Postcode</label>
                    <input type="text" id="user_postcode_address" name="user_postcode_address" value="<?php echo $form_data['user_postcode_address'] ?>" />
                </p>
            </fieldset>
            <input type="hidden" id="user_billing_address" name="user_billing_address" value="<?php echo $form_data['user_billing_address'] ?>" />
            <p>
                <label for="user_phone">Phone Number</label>
                <input type="text" id="user_phone" name="user_phone" placeholder="Maximum 10 Digits" value="<?php echo $form_data['user_phone'] ?>" />
            </p>
            <p id="user_preferred_contact">
                <label>Preferred Contact:</label><br />
                <label><input type="radio" name="user_preferred_contact" value="Email" <?php if ($form_data["user_preferred_contact"] == "Email") { echo "checked=\"checked\""; } ?> required /> Email</label><br />
                <label><input type="radio" name="user_preferred_contact" value="Phone" <?php if ($form_data["user_preferred_contact"] == "Phone") { echo "checked=\"checked\""; } ?> required /> Phone</label><br />
                <label><input type="radio" name="user_preferred_contact" value="Post" <?php if ($form_data["user_preferred_contact"] == "Post") { echo "checked=\"checked\""; } ?> required /> Post</label>
            </p>
            <p>
                <label for="product_name">Courses & Pricing</label>
                <select id="product_name" name="product_name">
                    <option value="">Select Course & Price</option>
                    <option value="UI/UX Design" <?php if ($form_data["product_name"] == "UI/UX Design") { echo "selected=\"selected\""; } ?>>UI/UX Design (A$1,500)</option>
                    <option value="Web Development" <?php if ($form_data["product_name"] == "Web Development") { echo "selected=\"selected\""; } ?>>Web Development (A$1,600)</option>
                    <option value="Digital Marketing" <?php if ($form_data["product_name"] == "Digital Marketing") { echo "selected=\"selected\""; } ?>>Digital Marketing (A$1,400)</option>
                    <option value="Finance Management" <?php if ($form_data["product_name"] == "Finance Management") { echo "selected=\"selected\""; } ?>>Finance Management (A$1,500)</option>
                </select>
            </p>
            <input type="hidden" id="product_price" name="product_price" value="<?php echo $form_data["product_price"]; ?>" />
            <p>
                <label for="product_quantity">Quantity (Number of Sessions)</label>
                <input type="text" id="product_quantity" name="product_quantity" placeholder="Max. 5" value="<?php echo $form_data['product_quantity'] ?>" />
            </p>
            <p>
                <label>Features & Prices (Optional):</label><br />
                <label><input type="checkbox" id="user_feature_cert" name="user_features[]" value="Certification" <?php if (strpos($form_data["optional_features"], "Certification") !== false) { echo "checked=\"checked\""; } ?> /> Certification (A$150)</label><br />
                <label><input type="checkbox" id="user_feature_flex" name="user_features[]" value="Flexible Scheduling" <?php if (strpos($form_data["optional_features"], "Flexible") !== false) { echo "checked=\"checked\""; } ?> /> Flexible Scheduling (A$70)</label><br />
                <label><input type="checkbox" id="user_feature_ress" name="user_features[]" value="Resources & Services" <?php if (strpos($form_data["optional_features"], "Resources") !== false) { echo "checked=\"checked\""; } ?> /> Resources & Services (A$100)</label><br />
                <label><input type="checkbox" id="user_feature_indp" name="user_features[]" value="Industry Placement" <?php if (strpos($form_data["optional_features"], "Industry") !== false) { echo "checked=\"checked\""; } ?> /> Industry Placement (A$150)</label>
            </p>
            <input type="hidden" id="optional_features" name="optional_features" value="<?php echo $form_data["optional_features"]; ?>">
            <p>
                <label for="user_comments">Comments:</label>
                <textarea id="user_comments" name="user_comments" placeholder="Any additional comments or particular aspects of your query?"><?php echo $form_data['user_comments'] ?></textarea>
            </p>
            <!-- Credit Card Details -->
            <p>
                <label for="credit_card_type">Credit Card Type:</label>
                <select id="credit_card_type" name="credit_card_type" required>
                    <option value="" selected="selected">Please Select Your Card Type</option>
                    <option value="Visa">Visa</option>
                    <option value="Mastercard">Mastercard</option>
                    <option value="American Express">American Express</option>
                </select>
            </p>
            <p>
                <label for="credit_card_number">Credit Card Number:</label>
                <input type="text" id="credit_card_number" name="credit_card_number" placeholder="15/16 digits only" pattern="\d{15,16}" required />
            </p>
            <p>
                <label for="credit_card_name">Name on Credit Card:</label>
                <input type="text" id="credit_card_name" name="credit_card_name" placeholder="Alphabets/Spaces (Max 40)" pattern="[A-Za-z ]{1,40}" required />
            </p>
            <p>
                <label for="credit_card_expiry">Credit Card Expiry:</label>
                <input type="text" id="credit_card_expiry" name="credit_card_expiry" placeholder="MM-YY (e.g: 02-21)" pattern="\d\d-\d\d" required />
            </p>
            <p>
                <label for="credit_card_cvv">Card Verification Value (CVV):</label>
                <input type="text" id="credit_card_cvv" name="credit_card_cvv" placeholder="3 digits only" pattern="\d{3}" required />
            </p>
            <button type="submit">Pay Now</button>
        </form>
    </article>
    <!-- Footer -->
    <?php include "includes/footer.inc" ?>
</body>
</html>
