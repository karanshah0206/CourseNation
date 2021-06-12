<?php
    // Redirect if user already logged in
    session_start();
    if (isset($_SESSION["auth"]) && !empty($_SESSION["auth"])) { die(header("location:manager.php")); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="CourseNation is the world's leading short training courses. Get professional-level training in a wide range of industries within just 3 months!" />
    <meta name="keyword" content="Short Training Courses, CourseNation, Professional Training, Web Dev Course, Digital Marketing Course" />
    <meta name="author" content="Karan Manoj Shah" />

    <title>Manager Login | CourseNation</title>
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
        <h1>Manager Login</h1>
        <br />
        <form method="POST" action="manager_actions.php">
            <fieldset>
                <legend>Login</legend>
                <p><input type="text" name="signin_username" placeholder="Username" /></p>
                <p><input type="password" name="signin_password" placeholder="Password" /></p>
                <p><button type="submit">Login</button></p>
                <?php if (isset($_SESSION["auth_error"]) && !empty($_SESSION["auth_error"])) { echo $_SESSION["auth_error"]; $_SESSION["auth_error"] = ""; } ?>
            </fieldset>
        </form>
        <br />
        <a href="manager_signup.php">Create New Manager Account</a>
    </article>
    <!-- Footer -->
    <?php include "includes/footer.inc" ?>
</body>
</html>
