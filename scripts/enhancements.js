/* Filename:        enhancements.js
 * Target PHP:      index.php, product.php, enquire.php, about.php, enhancements.php, enhancements2.php, payment.php
 * Purpose:         Dynamically Style Menu on All Pages | Separate Billing Address & Delivery Address | Countdown Timer on Payment Page | Auto-append Credit Card Name on Payment Page
 * Author:          Karan Manoj Shah
 * Date Written:    25 April 2021 */

"use strict";

// Dynamically sets menu styling for each webpage
function dynamicMenu() {
    var pageName = window.location.pathname; // Get URL of webpage
    var menu = document.getElementsByTagName("nav")[0].childNodes[1]; // Get nav element's second child node (nav list ul element)

    if (pageName.search("index.php") != -1) { // Homepage
        // Get the 2nd child node of nav ul element (li for homepage) and add class "active" for special styling
        menu.childNodes[1].classList.add("active");
    }
    else if (pageName.search("product.php") != -1) { // Product page
        // Get the 4th child node of nav ul element (li for product page) and add class "active" for special styling
        menu.childNodes[3].classList.add("active");
    }
    else if (pageName.search("enquire.php") != -1) { // Enquire page
        // Get the 6th child node of nav ul element (li for enquire page) and add class "active" for special styling
        menu.childNodes[5].classList.add("active");
    }
    else if (pageName.search("about.php") != -1) { // About page
        // Get the 8th child node of nav ul element (li for about page) and add class "active" for special styling
        menu.childNodes[7].classList.add("active");
    }
    else if (pageName.search("manager.php") != -1 || pageName.search("manager_login.php") != -1 || pageName.search("manager_signup.php") != -1) { // Manager page
        // Get the 10th child node of nav ul element (li for manager page) and add class "active" for special styling
        menu.childNodes[9].classList.add("active");
    }
    else if (pageName.search("enhancements.php") != -1) { // Enhancement page
        // Get the 12th child node of nav ul element (li for enhancements page) and add class "active" for special styling
        menu.childNodes[11].classList.add("active");
    }
    else if (pageName.search("enhancements2.php") != -1) { // Enhancements 2 page
        // Get the 14th child node of nav ul element (li for enhancements2 page) and add class "active" for special styling
        menu.childNodes[13].classList.add("active");
    }
    else if (pageName.search("enhancements3.php") != -1) { // Enhancements 3 page
        // Get the 16th child node of nav ul element (li for enhancements3 page) and add class "active" for special styling
        menu.childNodes[15].classList.add("active");
    }
}

// Handles billing address different to delivery address
function billingAddress() {
    var billing_fs = document.getElementById("billing_fieldset");
    var billing_cb = document.getElementById("user_billing_address");

    billing_fs.style.display = "none"; // Hide billing address fieldset by default
    billing_cb.checked = false; // Keep billing address checkbox unchecked by default

    billing_cb.addEventListener("change", () => { // If checkbox is checked/unchecked
        if (billing_cb.checked) {
            billing_fs.style.display = "block";
        }
        else {
            billing_fs.style.display = "none";
        }
    });

    // Billing address is only validated if it is checked.
    // Validation of Billing Address taken care of in part2.js
}

// Returns a number formatted in 2 digits
function numTwoDigits(number) {
    return (number < 10 ? '0' : '') + number;
}

// Set timer on payments page, if time up redirect to homepage
function countdown() {
    var timer_min_span = document.getElementById("timer_min");
    var timer_sec_span = document.getElementById("timer_sec");
    var min_count = 5, sec_count = 0; // 5 Minute Timer

    setInterval(() => { // Executes the following every 1000 milliseconds (1 second)
        // Print timer values on payment page
        timer_min_span.textContent = numTwoDigits(min_count);
        timer_sec_span.textContent = numTwoDigits(sec_count);

        // If second goes to 0, reduce minute by 1 and reset second to 60
        if (sec_count == 0) {
            min_count--;
            sec_count = 60;
        }

        // Reduce 1 second at each iteration of setInterval
        sec_count--;

        // Timer over
        if (min_count == 0 && sec_count == 0) {
            location.href = "index.php";
        }
    }, 1000);
}

// Automatically appends name on credit card on payment page
function cardNameAppend() {
    ccNameElement = document.getElementById("credit_card_name");
    firstName = sessionStorage.first_name; // Get first name from client-side storage
    lastName = sessionStorage.last_name; // Get last name from client-side storage

    ccNameElement.value = firstName + " " + lastName; // Append name to the input box
}

// Called when the webpage loads
function init() {
    // Dynamically Styled Menu
    dynamicMenu();

    if (window.location.pathname.search("enquire.php") != -1) {
        // Enquire page billing address different to delivery address feature
        billingAddress();
    }

    if (window.location.pathname.search("payment.php") != -1) {
        // Payments page Countdown Timer
        countdown();
        // Payments page credit card name automatic append
        cardNameAppend();
    }
}

window.addEventListener("load", init); // Call init when webpage has loaded
