/* Filename:        part2.js
 * Target PHP:      payment.php, enquire.php
 * Purpose:         Validate Payment & Enquiry Forms, Transmit Data Client-Side Across Pages
 * Author:          Karan Manoj Shah
 * Date Written:    23 April 2021 */

"use strict";

// Validates enqiry form on enquire.php
// Returns boolean result
function validateEnquiry() {
    var result = true;
    var errorMsg = "";
    var firstName = document.getElementById("user_first_name").value;
    var lastName = document.getElementById("user_last_name").value;
    var email = document.getElementById("user_email").value;
    var street = document.getElementById("user_street_address").value;
    var suburb = document.getElementById("user_suburb_address").value;
    var state = document.getElementById("user_state_address").value;
    var postcode = document.getElementById("user_postcode_address").value;
    var phone = document.getElementById("user_phone").value;
    var quantity = document.getElementById("user_quantity").value;
    var product = document.getElementById("user_product").value;
    // Billing Address
    var billing_cb = document.getElementById("user_billing_address");
    var billing_street = document.getElementById("billing_street_address").value;
    var billing_suburb = document.getElementById("billing_suburb_address").value;
    var billing_state = document.getElementById("billing_state_address").value;
    var billing_postcode = document.getElementById("billing_postcode_address").value;

    // Validating Name
    if (!firstName.match(/^[A-Za-z]{1,25}$/)) {
        result = false;
        if (firstName == "") { errorMsg += "First name cannot be empty.\n"; }
        else { errorMsg += "First name can only contain alphabets, max 25.\n"; }
    }
    if (!lastName.match(/^[A-Za-z]{1,25}$/)) {
        result = false;
        if (lastName == "") { errorMsg += "Last name cannot be empty.\n"; }
        else { errorMsg += "Last name can only contain alphabets, max 25.\n"; }
    }

    // Validating Email
    if (!email.match(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/)) {
        result = false;
        if (email == "") { errorMsg += "Email cannot be empty.\n"; }
        else { errorMsg += "Improperly formatted email.\n" }
    }

    // Validating Delivery Street
    if (!street.match(/^.{1,40}$/)) {
        result = false;
        if (street == "") { errorMsg += "Delivery Address street cannot be empty.\n"; }
        else { errorMsg += "Delivery Address street has maximum 40 characters.\n"; }
    }

    // Validating Delivery Suburb
    if (!suburb.match(/^.{1,20}$/)) {
        result = false;
        if (suburb == "") { errorMsg += "Delivery Address suburb cannot be empty.\n"; }
        else { errorMsg += "Delivery Address suburb has maximum 20 characters.\n"; }
    }

    // Validating Delivery State
    if (state == "") {
        result = false;
        errorMsg += "You must choose your Delivery Address state.\n";
    }

    // Validating Delivery Postcode
    if (!postcode.match(/^\d{4}$/)) {
        result = false;
        if (postcode == "") { errorMsg += "Delivery Address Postcode cannot be empty.\n"; }
        else { errorMsg += "Delivery Address Postcode can only be 4 digits.\n"; }
    }

    // Validating Delivery State-Postcode (only if state and postcode are individually valid)
    if(state != "" && postcode.match(/^\d{4}$/)) {
        switch (postcode[0]) { // First letter of postcode to compare with states
            // Victoria
            case "3":
            case "8":
                if (state != "VIC") {
                    result = false;
                    errorMsg += "Invalid Delivery Address postcode '" + postcode + "' for " + state + ".\n";
                }
                break;
            // New South Wales
            case "1":
            case "2":
                if (state != "NSW") {
                    result = false;
                    errorMsg += "Invalid Delivery Address postcode '" + postcode + "' for " + state + ".\n";
                }
                break;
            // Queensland
            case "4":
            case "9":
                if (state != "QLD") {
                    result = false;
                    errorMsg += "Invalid Delivery Address postcode '" + postcode + "' for " + state + ".\n";
                }
                break;
            // Northern Territory or Australian Capital Territory
            case "0":
                if ((state != "NT") && (state != "ACT")) {
                    result = false;
                    errorMsg += "Invalid Delivery Address postcode '" + postcode + "' for " + state + ".\n";
                }
                break;
            // Western Australia
            case "6":
                if (state != "WA") {
                    result = false;
                    errorMsg += "Invalid Delivery Address postcode '" + postcode + "' for " + state + ".\n";
                }
                break;
            // South Australia
            case "5":
                if (state != "SA") {
                    result = false;
                    errorMsg += "Invalid Delivery Address postcode '" + postcode + "' for " + state + ".\n";
                }
                break;
            // Tasmania
            case "7":
                if (state != "TAS") {
                    result = false;
                    errorMsg += "Invalid Delivery Address postcode '" + postcode + "' for " + state + ".\n";
                }
                break;
            default:
                result = false;
                errorMsg += "Invalid Delivery Address Postcode.\n";
                break;
        }
    }

    // Validating Phone
    if (!phone.match(/^\d{10}$/)) {
        result = false;
        if (phone == "") { errorMsg += "Phone number cannot be empty.\n"; }
        else { errorMsg += "Phone number can only be 10 digits.\n"; }
    }

    // Validating Product
    if (product == "") {
        result = false;
        errorMsg += "You must choose a course.\n"
    }

    // Validating Quantity
    if (quantity == "") { // If quantity is left blank
        result = false;
        errorMsg += "Quantity is a required field.\n"
    }
    else if (isNaN(quantity)) { // If quantity is not a numeric input
        result = false;
        errorMsg += "Quantity must only be numerical values.\n"
    }
    else if (quantity % 1 !== 0) { // If quantity is numeric but not an integer
        result = false;
        errorMsg += "Quantity can only be an integer value.\n"
    }
    else if ((quantity <= 0) || (quantity > 5)) { // If quantity is more than 5 or less than 1
        result = false;
        errorMsg += "Quantity must be between 1 and 5.\n"
    }

    // Validating Billing Address only if it is different to Delivery Address
    if (billing_cb.checked) {
        // Validating Billing Street
        if (!billing_street.match(/^.{1,40}$/)) {
            result = false;
            if (billing_street == "") { errorMsg += "Billing Address street cannot be empty.\n"; }
            else { errorMsg += "Billing Address street has maximum 40 characters.\n"; }
        }

        // Validating Billing Suburb
        if (!billing_suburb.match(/^.{1,20}$/)) {
            result = false;
            if (billing_suburb == "") { errorMsg += "Billing Address suburb cannot be empty.\n"; }
            else { errorMsg += "Billing Address suburb has maximum 20 characters.\n"; }
        }

        // Validating Billing State
        if (billing_state == "") {
            result = false;
            errorMsg += "You must choose your Billing Address state.\n";
        }

        // Validating Billing Postcode
        if (!billing_postcode.match(/^\d{4}$/)) {
            result = false;
            if (billing_postcode == "") { errorMsg += "Billing Address Postcode cannot be empty.\n"; }
            else { errorMsg += "Billing Address Postcode can only be 4 digits.\n"; }
        }

        // Validating Billing State-Postcode (only if state and postcode are individually valid)
        if(billing_state != "" && billing_postcode.match(/^\d{4}$/)) {
            switch (billing_postcode[0]) { // First letter of postcode to compare with states
                // Victoria
                case "3":
                case "8":
                    if (billing_state != "VIC") {
                        result = false;
                        errorMsg += "Invalid Billing Address postcode '" + billing_postcode + "' for " + billing_state + ".\n";
                    }
                    break;
                // New South Wales
                case "1":
                case "2":
                    if (billing_state != "NSW") {
                        result = false;
                        errorMsg += "Invalid Billing Address postcode '" + billing_postcode + "' for " + billing_state + ".\n";
                    }
                    break;
                // Queensland
                case "4":
                case "9":
                    if (billing_state != "QLD") {
                        result = false;
                        errorMsg += "Invalid Billing Address postcode '" + billing_postcode + "' for " + billing_state + ".\n";
                    }
                    break;
                // Northern Territory or Australian Capital Territory
                case "0":
                    if ((billing_state != "NT") && (billing_state != "ACT")) {
                        result = false;
                        errorMsg += "Invalid Billing Address postcode '" + billing_postcode + "' for " + billing_state + ".\n";
                    }
                    break;
                // Western Australia
                case "6":
                    if (billing_state != "WA") {
                        result = false;
                        errorMsg += "Invalid Billing Address postcode '" + billing_postcode + "' for " + billing_state + ".\n";
                    }
                    break;
                // South Australia
                case "5":
                    if (billing_state != "SA") {
                        result = false;
                        errorMsg += "Invalid Billing Address postcode '" + billing_postcode + "' for " + billing_state + ".\n";
                    }
                    break;
                // Tasmania
                case "7":
                    if (billing_state != "TAS") {
                        result = false;
                        errorMsg += "Invalid Billing Address postcode '" + billing_postcode + "' for " + billing_state + ".\n";
                    }
                    break;
                default:
                    result = false;
                    errorMsg += "Invalid Billing Address Postcode.\n";
                    break;
            }
        }
    }

    if ( errorMsg != "" ) { alert(errorMsg); } // If errors exist, alert user
    if (result) { storeEnquiryForm(); } // If no errors, save form data on client storage
    return result;
}

// Saves data from enquiry form to client-side storage (session storage)
function storeEnquiryForm() {
    sessionStorage.first_name = document.getElementById("user_first_name").value;
    sessionStorage.last_name = document.getElementById("user_last_name").value;
    sessionStorage.email = document.getElementById("user_email").value;
    sessionStorage.street_address = document.getElementById("user_street_address").value;
    sessionStorage.suburb_address = document.getElementById("user_suburb_address").value;
    sessionStorage.state_address = document.getElementById("user_state_address").value;
    sessionStorage.postcode_address = document.getElementById("user_postcode_address").value;
    sessionStorage.phone = document.getElementById("user_phone").value;
    sessionStorage.preferred_contact = checkPreferredContact();
    sessionStorage.product = document.getElementById("user_product").value;
    sessionStorage.quantity = document.getElementById("user_quantity").value;
    sessionStorage.comments = document.getElementById("user_comments").value;
    // Billing
    if (document.getElementById("user_billing_address").checked) {
        sessionStorage.billing_address = document.getElementById("billing_street_address").value + ", " + document.getElementById("billing_suburb_address").value  + ", " + document.getElementById("billing_state_address").value + " (" + document.getElementById("billing_postcode_address").value +")";
    }
    else {
        sessionStorage.billing_address = "Same as delivery address";
    }
    // Optional Features
    sessionStorage.feature_cert = document.getElementById("user_feature_cert").checked;
    sessionStorage.feature_flex = document.getElementById("user_feature_flex").checked;
    sessionStorage.feature_ress = document.getElementById("user_feature_ress").checked;
    sessionStorage.feature_indp = document.getElementById("user_feature_indp").checked;
}

// Checks which radio button in preferred contacts has been checked on enquiry form
// Returns string with value of checked preferred contact
function checkPreferredContact() {
    var preferred_contact = "Email"; // Default contact preference if no other matches found
    var contact_array = document.getElementById("user_preferred_contact").getElementsByTagName("input"); // Reference to each radio object
    for (let i=0; i<contact_array.length; i++) {
        if (contact_array[i].checked) { preferred_contact = contact_array[i].value; } // If radio checked, set preferred_contact value
    }
    return preferred_contact;
}

// Validates payment form on payment.php
// Returns boolean result
function validatePayment() {
    var result = true;
    var errorMsg = "";
    var cardType = document.getElementById("credit_card_type").value;
    var cardName = document.getElementById("credit_card_name").value;
    var cardNumber = document.getElementById("credit_card_number").value;
    var cardExpiry = document.getElementById("credit_card_expiry").value;
    var cardCvv = document.getElementById("credit_card_cvv").value;
    var cNumberRegex = /^\d+$/;
    var cNameRegex = /^[A-Za-z ]{1,40}$/;
    var cExpiryRegex = /^\d\d-\d\d$/;
    var cCvv = /^\d{3}$/;

    // Card Number-Card Type Check
    switch (cardType) {
        case "Visa":
            if (cardNumber.length != 16) {
                result = false;
                errorMsg += "Visa cards have 16 digits.\n";
            }
            if (cardNumber[0] != "4") {
                result = false;
                errorMsg += "Visa cards start with the digit 4.\n";
            }
            break;
        case "Mastercard":
            if (cardNumber.length != 16) {
                result = false;
                errorMsg += "Mastercard cards have 16 digits.\n";
            }
            if ((cardNumber[0] != "5") || (cardNumber[1] != "1" && cardNumber[1] != "2" && cardNumber[1] != "3" && cardNumber[1] != "4" && cardNumber[1] != "5")) {
                result = false;
                errorMsg += "Mastercard cards start with digits 51 through 55.\n";
            }
            break;
        case "American Express":
            if (cardNumber.length != 15) {
                result = false;
                errorMsg += "American Express cards have 15 digits.\n";
            }
            if ((cardNumber[0] != "3") || (cardNumber[1] != "7" && cardNumber[1] != "4")) {
                result = false;
                errorMsg += "American Express cards start with 34 or 37.\n";
            }
            break;
        default:
            result = false;
            errorMsg += "Select Your Credit Card Type.\n";
            break;
    }

    // Card Number Check
    if (!cardNumber.match(cNumberRegex)) {
        result = false;
        if (cardNumber == "") { errorMsg += "Card Number cannot be empty.\n"; }
        else { errorMsg += "Card number can only consist of digits.\n"; }
    }

    // Card Name Check
    if (!cardName.match(cNameRegex)) {
        result = false;
        if (cardName == "") { errorMsg += "Card Name cannot be empty.\n"; }
        else { errorMsg += "Card name must have 1 to 40 alphabets and/or spaces only.\n"; }
    }

    // Card Expiry Check
    if (!cardExpiry.match(cExpiryRegex)) {
        result = false;
        if (cardExpiry == "") { errorMsg += "Card expiry cannot be emppty.\n"; }
        else { errorMsg += "Card expiry format invalid (add 0 with single-digit month/year).\n"; }
    }

    // Card CVV Check
    if (!cardCvv.match(cCvv)) {
        result = false;
        if (cardCvv == "") { errorMsg += "Card CVV cannot be empty.\n"; }
        else { errorMsg += "Card CVV must only contain 3 digits."; }
    }

    if (errorMsg != "") { alert(errorMsg); } // If errors exist, alert user
    return result;
}

// Displays data stored in session storage and adds it to hidden form items
function getSessionData() {
    // Name
    document.getElementById("confirm_name").textContent = sessionStorage.first_name + " " + sessionStorage.last_name; // Display read-only
    document.getElementById("user_first_name").value = sessionStorage.first_name; // Add to hidden form item
    document.getElementById("user_last_name").value = sessionStorage.last_name;
    // Email
    document.getElementById("confirm_email").textContent = sessionStorage.email;
    document.getElementById("user_email").value = sessionStorage.email;
    // Delivery Address
    document.getElementById("confirm_address").textContent = sessionStorage.street_address + ", " + sessionStorage.suburb_address + ", " + sessionStorage.state_address + " (" + sessionStorage.postcode_address + ")"
    document.getElementById("user_street_address").value = sessionStorage.street_address;
    document.getElementById("user_suburb_address").value = sessionStorage.suburb_address;
    document.getElementById("user_state_address").value = sessionStorage.state_address;
    document.getElementById("user_postcode_address").value = sessionStorage.postcode_address;
    // Billing Address
    document.getElementById("confirm_billing").textContent = sessionStorage.billing_address;
    document.getElementById("user_billing_address").value = sessionStorage.billing_address;
    // Phone
    document.getElementById("confirm_phone").textContent = sessionStorage.phone;
    document.getElementById("user_phone").value = sessionStorage.phone;
    // Preferred Contact
    document.getElementById("confirm_preferred_contact").textContent = sessionStorage.preferred_contact;
    document.getElementById("user_preferred_contact").value = sessionStorage.preferred_contact;
    // Course (Product)
    document.getElementById("confirm_course").textContent = sessionStorage.product;
    document.getElementById("user_product").value = sessionStorage.product;
    // Quantity
    document.getElementById("confirm_quantity").textContent = sessionStorage.quantity;
    document.getElementById("user_quantity").value = sessionStorage.quantity;
    // Comments
    document.getElementById("confirm_comments").textContent = sessionStorage.comments;
    document.getElementById("user_comments").value = sessionStorage.comments;
    // Display Course Price
    if (sessionStorage.product == "UI/UX Design") {
        document.getElementById("confirm_price").textContent = "A$1500";
        document.getElementById("user_product_price").value = "1500";
    }
    else if (sessionStorage.product == "Web Development") {
        document.getElementById("confirm_price").textContent = "A$1600";
        document.getElementById("user_product_price").value = "1600";
    }
    else if (sessionStorage.product == "Digital Marketing") {
        document.getElementById("confirm_price").textContent = "A$1400";
        document.getElementById("user_product_price").value = "1400";
    }
    else if (sessionStorage.product == "Finance Management") {
        document.getElementById("confirm_price").textContent = "A$1500";
        document.getElementById("user_product_price").value = "1500";
    }
    // Display Optional Features
    if (sessionStorage.feature_cert != "false") {
        document.getElementById("confirm_features").textContent = "Certification (A$150)";
        document.getElementById("user_features").value = "Certification (A$150)";
    }
    if (sessionStorage.feature_flex != "false") {
        // Add a comma if a previous feature was also added
        if (document.getElementById("confirm_features").textContent != "") {
            document.getElementById("confirm_features").textContent += ", ";
            document.getElementById("user_features").value += ", ";
        }
        document.getElementById("confirm_features").textContent += "Flexible Scheduling (A$70)";
        document.getElementById("user_features").value += "Flexible Scheduling (A$70)";
    }
    if (sessionStorage.feature_ress != "false") {
        if (document.getElementById("confirm_features").textContent != "") {
            document.getElementById("confirm_features").textContent += ", ";
            document.getElementById("user_features").value += ", ";
        }
        document.getElementById("confirm_features").textContent += "Resources & Services (A$100)";
        document.getElementById("user_features").value += "Resources & Services (A$100)";
    }
    if (sessionStorage.feature_indp != "false") {
        if (document.getElementById("confirm_features").textContent != "") {
            document.getElementById("confirm_features").textContent += ", ";
            document.getElementById("user_features").value += ", ";
        }
        document.getElementById("confirm_features").textContent += "Industry Placement (A$150)";
        document.getElementById("user_features").value += "Industry Placement (A$150)";
    }
    // Display Total Cost
    document.getElementById("confirm_total").textContent = "A$" + calculateTotal();
    document.getElementById("total_bill").value = "A$" + calculateTotal();
}

// Calculates cost based on product, quantity, and optional features
// Returns integer totalCost
function calculateTotal() {
    var totalCost = 0
    // Product
    if (sessionStorage.product == "UI/UX Design") { totalCost = 1500; }
    else if (sessionStorage.product == "Web Development") { totalCost = 1600; }
    else if (sessionStorage.product == "Digital Marketing") { totalCost = 1400; }
    else if (sessionStorage.product == "Finance Management") { totalCost = 1500; }
    // Optional Features
    if (sessionStorage.feature_cert != "false") { totalCost += 150; }
    if (sessionStorage.feature_flex != "false") { totalCost += 70; }
    if (sessionStorage.feature_ress != "false") { totalCost += 100; }
    if (sessionStorage.feature_indp != "false") { totalCost += 150; }
    // Quantity
    totalCost *= sessionStorage.quantity;
    return totalCost;
}

// Clears session storage, redirects to index.php
function cancelBooking() {
    sessionStorage.clear(); // Clear session storage
    location.href = "index.php"; // Redirect to homepage
}

// Modifies Hidden Form Elements Based On Selected Data in fix_order.php
function modify_hidden_elements() {
    // Optional Features
    document.getElementById("optional_features").value = "";
    if (document.getElementById("user_feature_cert").checked) {
        document.getElementById("optional_features").value += "Certification (A$150)";
    }
    if (document.getElementById("user_feature_flex").checked) {
        if (document.getElementById("optional_features").value != "") {
            document.getElementById("optional_features").value += ", ";
        }
        document.getElementById("optional_features").value += "Flexible Scheduling (A$70)";
    }
    if (document.getElementById("user_feature_ress").checked) {
        if (document.getElementById("optional_features").value != "") {
            document.getElementById("optional_features").value += ", ";
        }
        document.getElementById("optional_features").value += "Resources & Services (A$100)";
    }
    if (document.getElementById("user_feature_indp").checked) {
        if (document.getElementById("optional_features").value != "") {
            document.getElementById("optional_features").value += ", ";
        }
        document.getElementById("optional_features").value += "Industry Placement (A$150)";
    }
    // Pricing
    if (document.getElementById("product_name").value == "UI/UX Design") {
        document.getElementById("product_price").value = "1500";
    }
    if (document.getElementById("product_name").value == "Web Development") {
        document.getElementById("product_price").value = "1600";
    }
    if (document.getElementById("product_name").value == "Digital Marketing") {
        document.getElementById("product_price").value = "1400";
    }
    if (document.getElementById("product_name").value == "Finance Management") {
        document.getElementById("product_price").value = "1500";
    }
    return true;
}

function filter_date_filter_form() {
    var checkbox = document.getElementById("filter_by_date");
    var start_date = document.getElementById("start_date");
    var end_date = document.getElementById("end_date");
    var start_date_label = document.getElementById("start_date_label");
    var end_date_label = document.getElementById("end_date_label");
    if (checkbox.checked) {
        start_date.style.display = "inline-block";
        end_date.style.display = "inline-block";
        start_date_label.style.display = "inline-block";
        end_date_label.style.display = "inline-block";
    } else {
        start_date.style.display = "none";
        end_date.style.display = "none";
        start_date_label.style.display = "none";
        end_date_label.style.display = "none";
    }
    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            start_date.style.display = "inline-block";
            end_date.style.display = "inline-block";
            start_date_label.style.display = "inline-block";
            end_date_label.style.display = "inline-block";
        } else {
            start_date.style.display = "none";
            end_date.style.display = "none";
            start_date_label.style.display = "none";
            end_date_label.style.display = "none";
        }
    });
}

// Called when the webpage loads
function init() {
    var debug = true; // Set to false in production (disables HTML/JS Validation)
    if (window.location.pathname.search("enquire.php") != -1) { // If webpage URL contains enquire.php, enquire page requesting validation
        var enquiryForm = document.getElementById("enquiry_form");
        if (debug) { enquiryForm.onsubmit = storeEnquiryForm; }
        else { enquiryForm.onsubmit = validateEnquiry; }
    }
    if (window.location.pathname.search("payment.php") != -1) { // If webpage URL contains payment.php, payment page requesting validation
        var paymentForm = document.getElementById("payment_form");
        getSessionData(); // Display data from enquiry form
        if (debug) {
            document.getElementById("confirm_total").textContent = "A$" + calculateTotal();
            document.getElementById("total_bill").value = "A$" + calculateTotal();
        }
        else { paymentForm.onsubmit = validatePayment; }
        paymentForm.onreset = cancelBooking; // Cancel booking when cancle button clicked
    }
    if (window.location.pathname.search("fix_order.php") != -1) { // If webage URL contains fix_order.php, modify optional features form element
        var fixForm = document.getElementById("fix_form");
        fixForm.onsubmit = modify_hidden_elements;
    }
    if (window.location.pathname.search("manager.php") != -1) { // If webpage URL contains manager.php, show/hide date options
        filter_date_filter_form();
    }
}

window.onload = init; // Call init when webpage has loaded
