<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Check out all the cool enhancements that are made to CourseNation's stunning website!" />
    <meta name="keyword" content="CourseNation, Dynamic Website, Cool PHP Stuff, MYSQL Enhancements" />
    <meta name="author" content="Karan Manoj Shah" />

    <title>Enhancements 3 | CourseNation</title>
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
        <h1>PHP Enhancements to CourseNation Website</h1>
        <section class="enhancements">
            <h2>Manager Login</h2>
            <ul>
                <li>With this feture, managers are able to create new accounts and/or login with their accounts in order to access the manager page. If a user is unauthenticated, they cannot access the manager.php page. TWo users cannot have the same username. Once logged in, managers have the option to logout. If the accounts table doesn't exist by default, it's created dynamically.</li>
                <li>To check if a user already exists, I used the SQL query <code>SELECT username FROM $auth_table WHERE username='$username' AND password='$password'</code>, then checked if the result has more than 0 rows. If so, the username is taken, otherwise signup is allowed. To check for signin, I use the same command, and if the result is true, then the username and password are legal, so login allowed. To sign the user up, I use the SQL command <code>INSERT INTO $auth_table (username, password) VALUES ('$username', '$password')</code> which creates a new entry in the databse and therefore stores the user. I use PHP Sessions for authentication. If theh user is authenticated, I create a new session variable <code>$_SESSION["auth"]</code> and store the username in this. Manger Login and Signup page ensure that this token doesn't exist, while the manger.php page ensures that this token does exist. If there is no accounts table, the program dynamically creates a new SQL table within the database using the query <code>CREATE TABLE IF NOT EXISTS $auth_table (username VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL)</code>.</li>
                <li>This enhancement can be explored by visiting <a href="manager_login.php">Manager Login</a>, <a href="manager_signup.php">Manager Signup</a>, or the <a href="manager.php">Manager</a> page (notice if you've logged in before and not logged out, you'll automatically be redirected to the manager page. Similarly, if you're not logged in, accessing the manager.php page will automatically redirect you to login).</li>
                <li>I did not use any third-party source or take help from any external resource to implement this enhancement.</li>
            </ul>
        </section>
        <section class="enhancements">
            <h2>Filter Manager Query By Dates</h2>
            <ul>
                <li>With this feture, managers can query the search results based on the start and end dates when the products where ordered. This can be compounded with the other queries such as search by name, product, etc. to show highly specific queries to the manager.</li>
                <li>To implement this feature, I used the HTML input of <code>type="date"</code> to get the start and end times. The user must click on a checkbox if they want to enable search by date, else the values are input boxes are hidden. The SQL query used to search by date is <code>SELECT * FROM (all the values) WHERE order_time BETWEEN '$start_time' AND '$end_time'</code>, where the <code>$start_time</code> and <code>$end_time</code> variables store the date/time values selected.</li>
                <li>This enhancement can be explored by visiting the <a href="manager.php">Manager Page</a>. Note: if you haven't logged in as a manager, you'll be asked to do so. You can also create your account using the sign up feature shown.</li>
                <li>I learnt how to query SQL based on dates form the <a href="https://popsql.com/learn-sql/sql-server/how-to-query-date-and-time-in-sql-server" target="_blank">PopSQL Website</a>.</li>
            </ul>
        </section>
    </article>
    <!-- Footer -->
    <?php include "includes/footer.inc" ?>
</body>
</html>
