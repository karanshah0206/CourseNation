<?php
    /* Filename:        manager_actions.php
       Purpose:         Change Order Status, Cancel Orders, Manager Login, Sign Up, Logout
       Author:          Karan Manoj Shah
       Date Written:    22 May 2021 */

    require_once "settings.php";

    // Remove slashes, HTML special characters, and leading/training whitespaces
    function sanitise($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $connection = @mysqli_connect($host, $username, $password, $database) or die("<p>An error occured while connecting to the database.</p>");
    $orders_table = "orders";
    $auth_table = "accounts";

    // Fulfilled Order
    if (isset($_GET["fulfilled_id"])) {
        if (is_numeric($_GET["fulfilled_id"]) && !empty($_GET["fulfilled_id"])) {
            $order_id = $_GET["fulfilled_id"];
            $acion_query = "UPDATE $orders_table SET order_status='FULFILLED' WHERE order_id=$order_id";
            // Execute Query
            $action_result = mysqli_query($connection, $acion_query);
            // Return Query Results To Manager Page
            session_start();
            if (!$action_result) { $_SESSION["action_output"] = "An error occured while setting status of order ID $order_id to FULFILLED"; }
            else { $_SESSION["action_output"] = "Status Of Order ID $order_id changed to FULFILLED"; }
        } else { die(header("location:manager.php")); }

    // Paid Order
    } else if (isset($_GET["paid_id"])) {
        if (is_numeric($_GET["paid_id"]) && !empty($_GET["paid_id"])) {
            $order_id = $_GET["paid_id"];
            $acion_query = "UPDATE $orders_table SET order_status='PAID' WHERE order_id=$order_id";
            // Execute Query
            $action_result = mysqli_query($connection, $acion_query);
            // Return Query Results To Manager Page
            session_start();
            if (!$action_result) { $_SESSION["action_output"] = "An error occured while setting status of order ID $order_id to PAID"; }
            else { $_SESSION["action_output"] = "Status Of Order ID $order_id changed to PAID"; }
        } else { die(header("location:manager.php")); }

    // Archive Order
    } else if (isset($_GET["archive_id"])) {
        if (is_numeric($_GET["archive_id"]) && !empty($_GET["archive_id"])) {
            $order_id = $_GET["archive_id"];
            $acion_query = "UPDATE $orders_table SET order_status='ARCHIVED' WHERE order_id=$order_id";
            // Execute Query
            $action_result = mysqli_query($connection, $acion_query);
            // Return Query Results To Manager Page
            session_start();
            if (!$action_result) { $_SESSION["action_output"] = "An error occured while setting status of order ID $order_id to ARCHIVED"; }
            else { $_SESSION["action_output"] = "Status Of Order ID $order_id changed to ARCHIVED"; }
        } else { die(header("location:manager.php")); }

    // Pending Order
    } else if (isset($_GET["pending_id"])) {
        if (is_numeric($_GET["pending_id"]) && !empty($_GET["pending_id"])) {
            $order_id = $_GET["pending_id"];
            $acion_query = "UPDATE $orders_table SET order_status='PENDING' WHERE order_id=$order_id";
            // Execute Query
            $action_result = mysqli_query($connection, $acion_query);
            // Return Query Results To Manager Page
            session_start();
            if (!$action_result) { $_SESSION["action_output"] = "An error occured while setting status of order ID $order_id to PENDING"; }
            else { $_SESSION["action_output"] = "Status Of Order ID $order_id changed to PENDING"; }
        } else { die(header("location:manager.php")); }

    // Cancel Order
    } else if (isset($_GET["cancel_id"])) {
        if (is_numeric($_GET["cancel_id"]) && !empty($_GET["cancel_id"])) {
            $order_id = $_GET["cancel_id"];
            $acion_query = "DELETE FROM $orders_table WHERE order_id=$order_id";
            // Execute Query
            $action_result = mysqli_query($connection, $acion_query);
            // Return Query Results To Manager Page
            session_start();
            if (!$action_result) { $_SESSION["action_output"] = "An error occured while cancelling order ID $order_id"; }
            else { $_SESSION["action_output"] = "Order ID $order_id cancelled successfully"; }
        } else { die(header("location:manager.php")); }

    // Login
    } else if (isset($_POST["signin_username"]) && isset($_POST["signin_password"])) {
        $username = sanitise($_POST["signin_username"]);
        $password = sanitise($_POST["signin_password"]);
        if (!empty($username) && !empty($password)) {
            // Create Accounts Table If It Doesn't Exist
            $create_table_query = "CREATE TABLE IF NOT EXISTS $auth_table (username VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL)";
            $create_table_result = mysqli_query($connection, $create_table_query);
            if ($create_table_result) {
                // Login
                $login_query = "SELECT username FROM $auth_table WHERE username='$username' AND password='$password'";
                $login_result = mysqli_query($connection, $login_query);
                if (!$login_result || mysqli_num_rows($login_result) <= 0) {
                    // Failed Login
                    session_start();
                    $_SESSION["auth_error"] = "Username or Password is incorrect.";
                    die(header("location:manager_login.php"));
                } else {
                    // Login Successful
                    session_start();
                    $_SESSION["auth"] = $username;
                    header("location:manager.php");
                }
            }
        } else {
            session_start();
            $_SESSION["auth_error"] = "Username And Password Cannot Be Left Blank";
            die(header("location:manager_login.php"));
        }
    // Sign Up
    } else if (isset($_POST["signup_username"]) && isset($_POST["signup_password"])) {
        $username = sanitise($_POST["signup_username"]);
        $password = sanitise($_POST["signup_password"]);
        if (!empty($username) && !empty($password)) {
            // Create Accounts Table If It Doesn't Exist
            $create_table_query = "CREATE TABLE IF NOT EXISTS $auth_table (username VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL)";
            $create_table_result = mysqli_query($connection, $create_table_query);
            if ($create_table_result) {
                // Check If Username Is Taken
                $check_exists_query = "SELECT username FROM $auth_table WHERE username='$username'";
                $check_exists_result = mysqli_query($connection, $check_exists_query);
                if (!$check_exists_result || mysqli_num_rows($check_exists_result) <= 0) {
                    // Add Account
                    $add_account_query = "INSERT INTO $auth_table (username, password) VALUES ('$username', '$password')";
                    $add_account_result = mysqli_query($connection, $add_account_query);
                    if ($add_account_result) {
                        session_start();
                        $_SESSION["auth"] = $username;
                    } else {
                        session_start();
                        $_SESSION["auth_error"] = "Error while creating new user.";
                        die(header("location:manager_signup.php"));
                    }
                } else {
                    session_start();
                    $_SESSION["auth_error"] = "This user already exists!";
                    die(header("location:manager_signup.php"));
                }
            } else {
                session_start();
                $_SESSION["auth_error"] = "Error while creating new accounts table.";
                die(header("location:manager_signup.php"));
            }
        } else {
            session_start();
            $_SESSION["auth_error"] = "Username And Password Cannot Be Left Blank";
            die(header("location:manager_signup.php"));
        }
    // Signout
    } else if (isset($_GET["signout"])) {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("location:manager_login.php");
    }
    else {
        die(header("location:manager.php"));
    }
    // Redirect To Mangaer Page After Performing All Actions
    header("location:manager.php");
?>
