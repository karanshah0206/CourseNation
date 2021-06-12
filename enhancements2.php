<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Check out all the cool enhancements that are made to CourseNation's stunning website!" />
    <meta name="keyword" content="CourseNation, Website Enhancements, Dynamic Website, Cool JS Mods" />
    <meta name="author" content="Karan Manoj Shah" />

    <title>Enhancements 2 | CourseNation</title>
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
        <h1>JS Enhancements to CourseNation Website</h1>
        <section class="enhancements">
            <h2>Dynamic Navigation Menu Styling</h2>
            <ul>
                <li>Dynamic nav menu styling is the JavaScript enhancement where I dynamically style the navigation on each page so that the nav link of the current page is automatically highlighted (for example, if you see the navigation bar above, the "Enhancements 2" item is highlighted in comparison to other nav menu items).</li>
                <li>To implement this feature, I used the <code>window.location.pathname</code> to find the pathname of the current page, then apply the <code>.search()</code> function, to which I pass the parameter as string of current page's filename, example <code>window.location.pathname.search("enhancements2.php")</code>. If this returns <code>-1</code>, that means that string is not a part of the filename, else the search query is true. In this way, once I determine which webpage I'm on, I load the navigation element in a variable: <code>var menu = document.getElementsByTagName("nav")[0]</code> and get the ul element within the nav element using <code>menu.childNode[1]</code>. Now, each of the nav links are applied as a list within this <code>ul</code>, so to access them I apply the <code>childnode</code> again which returns an array of all the li elements. I specifically access <code>li</code> which belongs to the current page and do <code>classList.add("active")</code> to dynamically add a CSS class that highlights the nav link.</li>
                <li>This enhancement can be seen on every page. If you're looking for a specific example, first go to <a href="index.php">Homepapge</a>, then go to <a href="product.php">Product page</a> and notice how the highlight in the navigation menu automatically adapts to the page you're on.</li>
                <li>I did not use any third-party source or take help from any external resource to implement this enhancement.</li>
            </ul>
        </section>
        <section class="enhancements">
            <h2>Different Billing & Delivery Address</h2>
            <ul>
                <li>This JavaScript enhancement gives the user option to choose a billing address that is different to their delivery address.</li>
                <li>To implement this feature, I added an event listener to the billing address checkbox that listens for changes and executes certain logic: <code>billing_checkbox.addEventListener("change", () => { //Logic here })</code>. If the billing address is checked, which I can determine using <code>billing_address.checked</code> (returns boolean), then I display the fieldset that contains the billing address details, if it is unchecked, the fieldset is hidden. To dynamically show or hide the billing fieldset, I use <code>billing_fieldset.style.display = "block".</code>, if it is to be hidden, display is set to "none". If the checkbox is checked, then the billing_address key in session storage stores the address data, otherwise is stores "Same as delivery address."</li>
                <li>This enhancement can be explored by checking the <a href="enquire.php#user_billing_address">checkbox on Enquiry Page</a>. <em>Notice that the validation on billing address fields is only applied if the checkbox is checked!</em></li>
                <li>I did not use any third-party source or take help from any external resource to implement this enhancement.</li>
            </ul>
        </section>
        <section class="enhancements">
            <h2>Countdown Timer</h2>
            <ul>
                <li>This enhancement sets a timer on the payments page so that the user only has 5 minutes to make the payment. Once the timer is up, the page automatically redirects to CourseNation homepage.</li>
                <li>To implement this enhancement, I used the <code>setInterval()</code> method which requires two parameters, one is the handler function where I place all the logic and second is after how many milliseconds should the program re-iretarte through the handler function specified. I iterate through the handler every 1 second: <code>setInterval(() => { //Handler Function }, 1000)</code>. Within the handler function, I set the <code>textContent</code> attribute of the minute and second span elements on the payments page with the current time. Then, I subtract the second counter by 1, which means after every 1 second, the second counter decreases by 1. If the second goes to 0, then I subtract the minute counter by 1 and reset seconds counter to 60. If both second and minute counter go to 0, then the page redirects to homepage using <code>location.href = "index.php"</code>. Another cool feature in this enhancement is that even if the seconds and minutes are one-digit numbers (such as 5 minutes and 2 seconds), on the page it shows them in two digit numbres (so 05:02) as traditional timers do. I achieve this by determining wither the variable is less than 10, and if so, add a "0" before it using the code: <code>(number &lt; 10 ? '0' : '') + number;</code>.</li>
                <li>This enhancement can be found on the <a href="payment.php#timer">timer section of Payments Page</a>.</li>
                <li>I did not use any third-party source for this enhancement. However, I did refer to <a href="https://electrictoolbox.com/pad-number-two-digits-javascript/" target="_blank">Electric Toolbox</a> to learn how to convert display 1 digit numbers (such as 5) in two digits (such as 05).</li>
            </ul>
        </section>
        <section class="enhancements">
            <h2>Automatically Append Credit Card Name</h2>
            <ul>
                <li>This enhancement modifies the credit card form on payments page so that once the enquiry form is filled & submitted, the input box for "Name on Credit Card" in the payments page is automatically filled with the name the user previously filled on the enquiry page.</li>
                <li>This enhancement is fairly simple to implement. On the payment page, simply get the input field for credit card name in a variable: <code>ccNameElement = document.getElementById("credit_card_name")</code> then set it's <code>value</code> attribute to the first name stored in session storage, add a space, and then last name stored in session storage. This shoud look something like: <code>ccNameElement.value = sessionStorage.first_name + " " + sesionStorage.last_name</code></li>
                <li>This enhancement can be found on the <a href="payment.php#credit_card_name">credit card form of Payments Page</a>.</li>
                <li>I did not use any third-party source or take help from any external resource to implement this enhancement.</li>
            </ul>
        </section>
    </article>
    <!-- Footer -->
    <?php include "includes/footer.inc" ?>
</body>
</html>
