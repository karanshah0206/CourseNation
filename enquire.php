<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="If you have any enquiries regarding CourseNation or its range of courses, ask them here and we'll get back to you shortly!" />
    <meta name="keyword" content="CourseNation Enquiry, CourseNation Enquiries, Short Training Course Questions, Professional Training Doubts" />
    <meta name="author" content="Karan Manoj Shah" />

    <title>Enquiry | CourseNation</title>
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
        <h1>Product Enquiry</h1>
        <!-- Enquiry Form -->
        <form id="enquiry_form" method="POST" action="payment.php" novalidate="novalidate">
            <p>
                <label for="user_first_name">First Name</label>
                <input type="text" id="user_first_name" name="user_first_name" />
            </p>
            <p>
                <label for="user_last_name">Last Name</label>
                <input type="text" id="user_last_name" name="user_last_name" />
            </p>
            <p>
                <label for="user_email">Email</label>
                <input type="text" id="user_email" name="user_email" />
            </p>
            <fieldset>
                <legend>Delivery Address</legend>
                <p>
                    <label for="user_street_address">Street</label>
                    <input type="text" id="user_street_address" name="user_street_address" />
                </p>
                <p>
                    <label for="user_suburb_address">Suburb/Town</label>
                    <input type="text" id="user_suburb_address" name="user_suburb_address" />
                </p>
                <p>
                    <label for="user_state_address">State</label>
                    <select id="user_state_address" name="user_state_address">
                        <option value="" selected="selected">Select State</option>
                        <option value="VIC">VIC</option>
                        <option value="NSW">NSW</option>
                        <option value="QLD">QLD</option>
                        <option value="NT">NT</option>
                        <option value="WA">WA</option>
                        <option value="SA">SA</option>
                        <option value="TAS">TAS</option>
                        <option value="ACT">ACT</option>
                    </select>
                </p>
                <p>
                    <label for="user_postcode_address">Postcode</label>
                    <input type="text" id="user_postcode_address" name="user_postcode_address" />
                </p>
            </fieldset>
            <p>
                <label><input type="checkbox" id="user_billing_address" name="user_billing_address" /> Billing Address Different From Delivery Address</label>
            </p>
            <fieldset id="billing_fieldset">
                <legend>Billing Address</legend>
                <p>
                    <label for="billing_street_address">Street</label>
                    <input type="text" id="billing_street_address" name="billing_street_address" />
                </p>
                <p>
                    <label for="billing_suburb_address">Suburb/Town</label>
                    <input type="text" id="billing_suburb_address" name="billing_suburb_address" />
                </p>
                <p>
                    <label for="billing_state_address">State</label>
                    <select id="billing_state_address" name="billing_state_address">
                        <option value="" selected="selected">Select State</option>
                        <option value="VIC">VIC</option>
                        <option value="NSW">NSW</option>
                        <option value="QLD">QLD</option>
                        <option value="NT">NT</option>
                        <option value="WA">WA</option>
                        <option value="SA">SA</option>
                        <option value="TAS">TAS</option>
                        <option value="ACT">ACT</option>
                    </select>
                </p>
                <p>
                    <label for="billing_postcode_address">Postcode</label>
                    <input type="text" id="billing_postcode_address" name="billing_postcode_address" />
                </p>
            </fieldset>
            <p>
                <label for="user_phone">Phone Number</label>
                <input type="text" id="user_phone" name="user_phone" placeholder="Maximum 10 Digits" />
            </p>
            <p id="user_preferred_contact">
                <label>Preferred Contact:</label><br />
                <label><input type="radio" name="user_preferred_contact" value="Email" checked="checked" required /> Email</label><br />
                <label><input type="radio" name="user_preferred_contact" value="Phone" required /> Phone</label><br />
                <label><input type="radio" name="user_preferred_contact" value="Post" required /> Post</label>
            </p>
            <p>
                <label for="user_product">Courses & Pricing</label>
                <select id="user_product" name="user_product">
                    <option value="" selected="selected">Select Course & Price</option>
                    <option value="UI/UX Design">UI/UX Design (A$1,500)</option>
                    <option value="Web Development">Web Development (A$1,600)</option>
                    <option value="Digital Marketing">Digital Marketing (A$1,400)</option>
                    <option value="Finance Management">Finance Management (A$1,500)</option>
                </select>
            </p>
            <p>
                <label>Quantity (Number of Sessions)</label>
                <input type="text" id="user_quantity" name="user_quantity" placeholder="Max. 5" />
            </p>
            <p>
                <label>Features & Prices (Optional):</label><br />
                <label><input type="checkbox" id="user_feature_cert" name="user_features[]" value="Certification" checked="checked" /> Certification (A$150)</label><br />
                <label><input type="checkbox" id="user_feature_flex" name="user_features[]" value="Flexible Scheduling" /> Flexible Scheduling (A$70)</label><br />
                <label><input type="checkbox" id="user_feature_ress" name="user_features[]" value="Resources & Services" /> Resources & Services (A$100)</label><br />
                <label><input type="checkbox" id="user_feature_indp" name="user_features[]" value="Industry Placement" /> Industry Placement (A$150)</label>
            </p>
            <p>
                <label for="user_comments">Comments:</label>
                <textarea id="user_comments" name="user_comments" placeholder="Any additional comments or particular aspects of your query?"></textarea>
            </p>
            <button type="submit">Pay Now</button>
            <button type="reset">Reset</button>
        </form>
    </article>
    <!-- Footer -->
    <?php include "includes/footer.inc" ?>
</body>
</html>
