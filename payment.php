<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Make mayment with CourseNation and get started with world-class online tutoring in no time!" />
    <meta name="keyword" content="CourseNation Payment, CourseNation, Short Training Courses" />
    <meta name="author" content="Karan Manoj Shah" />

    <title>Payment | CourseNation</title>
    <link rel="icon" href="images/icon.png" />

    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/responsive.css" />

    <script src="scripts/part2.js"></script>
    <script src="scripts/enhancements.js"></script>
</head>
<body>
    <!-- Header -->
    <?php include "includes/header.inc" ?>
    <!-- Navigation -->
    <?php include "includes/navigation.inc" ?>
    <!-- Article -->
    <article>
        <h1>Product Payment</h1>
        <!-- Product Payment Form -->
        <form id="payment_form" method="POST" action="process_order.php" novalidate="novalidate">
            <!-- Confirming Purchase Details -->
            <fieldset>
                <legend>Confirm Purchase</legend>
                <p>Your name: <span id="confirm_name"></span></p>
                <p>Your email: <span id="confirm_email"></span></p>
                <p>Delivery address: <span id="confirm_address"></span></p>
                <p>Billing address: <span id="confirm_billing"></span></p>
                <p>Your phone number: <span id="confirm_phone"></span></p>
                <p>Preferred contact: <span id="confirm_preferred_contact"></span></p>
                <p>Course Selection: <span id="confirm_course"></span></p>
                <p>Course Price: <span id="confirm_price"></span></p>
                <p>Quantity (No. of Sessions): <span id="confirm_quantity"></span></p>
                <p>Optional Features (if any): <span id="confirm_features"></span></p>
                <p>Additional Comments (if any): <span id="confirm_comments"></span></p>
            </fieldset>
            <p>Calculated total price: <span id="confirm_total"></span></p>
            <!-- Hidden Form Inputs -->
            <input type="hidden" id="user_first_name" name="user_first_name" />
            <input type="hidden" id="user_last_name" name="user_last_name" />
            <input type="hidden" id="user_email" name="user_email" />
            <input type="hidden" id="user_street_address" name="user_street_address" />
            <input type="hidden" id="user_suburb_address" name="user_suburb_address" />
            <input type="hidden" id="user_state_address" name="user_state_address" />
            <input type="hidden" id="user_postcode_address" name="user_postcode_address" />
            <input type="hidden" id="user_billing_address" name="user_billing_address" />
            <input type="hidden" id="user_phone" name="user_phone" />
            <input type="hidden" id="user_preferred_contact" name="user_preferred_contact" />
            <input type="hidden" id="user_comments" name="user_comments" />
            <input type="hidden" id="user_product" name="product_name" />
            <input type="hidden" id="user_product_price" name="product_price" />
            <input type="hidden" id="user_quantity" name="product_quantity" />
            <input type="hidden" id="user_features" name="optional_features" />
            <input type="hidden" id="total_bill" name="total_bill" />
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
            <button type="submit">Check Out</button>
            <button type="reset">Cancel</button>
        </form>
        <section id="timer">
            <h2>Payment Timer</h2>
            <p>You have 5 minutes to make the payment.</p>
            <p>Time remaining: <span id="timer_min"></span>:<span id="timer_sec"></span></p>
        </section>
    </article>
    <!-- Footer -->
    <?php include "includes/footer.inc" ?>
</body>
</html>
