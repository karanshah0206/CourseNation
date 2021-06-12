<?php
    session_start();
    // Check If Authenticated
    if (!isset($_SESSION["auth"]) || empty($_SESSION["auth"])) { die(header("location:manager_login.php")); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="CourseNation is the world's leading short training courses. Get professional-level training in a wide range of industries within just 3 months!" />
    <meta name="keyword" content="Short Training Courses, CourseNation, Professional Training, Web Dev Course, Digital Marketing Course" />
    <meta name="author" content="Karan Manoj Shah" />

    <title>Manager | CourseNation</title>
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
        <h1>Manager Page</h1>
        <p>Currently Logged In As <?php echo $_SESSION["auth"]; ?> | <a href="manager_actions.php?signout">Signout</a></p>
        <?php
            // Check If A Manager Action Is Performed, If So Show Confirmation
            if (isset($_SESSION["action_output"])) {
                if (!empty($_SESSION["action_output"])) { ?>
                    <section class="confirmation">
                        <h2>Action Confirmation</h2>
                        <p><?php echo $_SESSION["action_output"]; ?></p>
                    </section>
                <?php }
            }
            $_SESSION["action_output"] = ""; // Clear The Message
        ?>
        <br />
        <p><strong>Leave All Fields Blank And Search To Display All Orders</strong></p>
        <?php
            require_once "settings.php";

            // Remove slashes, HTML special characters, and leading/training whitespaces
            function sanitise($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            // Get Form Values (If They Exist)
            $first_name = "";
            if(isset($_POST["first_name"])) { $first_name = sanitise($_POST["first_name"]); }
            $last_name = "";
            if(isset($_POST["last_name"])) { $last_name = sanitise($_POST["last_name"]); }
            $product = "";
            if(isset($_POST["product"])) { $product = sanitise($_POST["product"]); }
            $filter_by_status = false;
            if(isset($_POST["filter_by_status"])) { $filter_by_status = true; }
            $filter_by_date = false;
            if(isset($_POST["filter_by_date"]) && isset($_POST["start_date"]) && $_POST["start_date"] != "" && isset($_POST["end_date"]) && $_POST["end_date"] != "") { $filter_by_date = true; }
            $order_by_cost = false;
            if(isset($_POST["order_by_cost"])) { $order_by_cost = true; }

            // Establish Connection With Datbase
            $connection = @mysqli_connect($host, $username, $password, $database) or die("<p>An error occured while connecting to the database.</p>");
            $table = "orders";

            // Prepare The SQL Query Based On User's Search Filters
            $get_orders_query = "SELECT order_id, order_time, product_name, product_price, product_quantity, product_optional_features, order_cost, f_name, l_name, order_status FROM $table";
            if ($first_name != "") {
                if (strpos($get_orders_query, "WHERE") !== false) { $get_orders_query .= " AND f_name LIKE '$first_name%'"; }
                else { $get_orders_query .= " WHERE f_name LIKE '$first_name%'"; }
            }
            if ($last_name != "") {
                if (strpos($get_orders_query, "WHERE") !== false) { $get_orders_query .= " AND l_name LIKE '$last_name%'"; }
                else { $get_orders_query .= " WHERE l_name LIKE '$last_name%'"; }
            }
            if ($product != "") {
                if (strpos($get_orders_query, "WHERE") !== false) { $get_orders_query .= " AND product_name LIKE '$product%'"; }
                else { $get_orders_query .= " WHERE product_name LIKE '$product%'"; }
            }
            if ($filter_by_status) {
                if (strpos($get_orders_query, "WHERE") !== false) { $get_orders_query .= " AND order_status='PENDING'"; }
                else { $get_orders_query .= " WHERE order_status='PENDING'"; }
            }
            if ($filter_by_date) {
                if ($_POST["start_date"] > $_POST["end_date"]) {
                    $filter_by_date = false;
                    echo "<p class=\"danger\">Error: Start Date Cannot Be Greater Than End Date!</p>";
                }
                if (strpos($get_orders_query, "WHERE") !== false) { $get_orders_query .= " AND order_time BETWEEN '" . $_POST["start_date"] . " 00:00:00' AND '" . $_POST["end_date"] . " 23:59:59'"; }
                else { $get_orders_query .= " WHERE order_time BETWEEN '" . $_POST["start_date"] . " 00:00:00' AND '" . $_POST["end_date"] . " 23:59:59'"; }
            }
            if ($order_by_cost) { $get_orders_query .= " ORDER BY order_cost ASC"; }
        ?>
        <!-- Filter Queries Form -->
        <form id="filter_form" action="manager.php" method="POST">
            <fieldset>
                <legend>Filter Queries</legend>
                <input type="text" name="first_name" value="<?php echo $first_name; ?>" placeholder="First Name" />
                <input type="text" name="last_name" value="<?php echo $last_name; ?>" placeholder="Last Name" />
                <select name="product">
                    <option value="" <?php if ($product == "") { echo "selected=\"selected\""; } ?>>All Products</option>
                    <option value="UI/UX Design" <?php if ($product == "UI/UX Design") { echo "selected=\"selected\""; } ?>>UI/UX Design</option>
                    <option value="Web Development" <?php if ($product == "Web Development") { echo "selected=\"selected\""; } ?>>Web Development</option>
                    <option value="Digital Marketing" <?php if ($product == "Digital Marketing") { echo "selected=\"selected\""; } ?>>Digital Marketing</option>
                    <option value="Finance Management" <?php if ($product == "Finance Management") { echo "selected=\"selected\""; } ?>>Finance Management</option>
                </select>
                <label><input type="checkbox" name="filter_by_status" <?php if ($filter_by_status) { echo "checked=\"checked\""; } ?> /> Show Only Pending</label>
                <label><input type="checkbox" name="order_by_cost" <?php if ($order_by_cost) { echo "checked=\"checked\""; } ?> /> Order By Cost</label>
                <br /><br />
                <label><input type="checkbox" id="filter_by_date" name="filter_by_date" <?php if($filter_by_date) { echo "checked=\"checked\""; } ?> /> Search By Date Range</label>
                <label id="start_date_label" for="start_date"> From:</label> <input type="date" id="start_date" name="start_date" <?php if($filter_by_date) { echo "value=\"" . $_POST["start_date"] . "\""; } ?> />
                <label id="end_date_label" for="end_date"> To: </label> <input type="date" id="end_date" name="end_date" <?php if($filter_by_date) { echo "value=\"" . $_POST["end_date"] . "\""; } ?> />
                <br /><br />
                <button type="submit">Dipslay Results</button>
            </fieldset>
        </form>
        <br />
        <!-- Tabulated Results -->
        <?php
            // Execute The SQL Query And Get Results
            $get_orders_result = mysqli_query($connection, $get_orders_query);
            if (!$get_orders_result) { echo "<p>An error occured while fetching orders details.</p>"; }
            else {
                if (mysqli_num_rows($get_orders_result) > 0) {
        ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date/Time</th>
                                <th>Product</th>
                                <th>Optional Features</th>
                                <th>Quantity</th>
                                <th>Cost</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_assoc($get_orders_result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row["order_id"] . "</td>";
                                    echo "<td>" . $row["order_time"] . "</td>";
                                    echo "<td>" . $row["product_name"] . " (A$" . $row["product_price"] . ")</td>";
                                    // Format Optional Features Before Displaying
                                    $optional = $row["product_optional_features"];
                                    $optional = str_replace(", ", "<br />", $optional);
                                    echo "<td>" . $optional . "</td>";
                                    echo "<td>" . $row["product_quantity"] . "</td>";
                                    echo "<td>A$" . $row["order_cost"] . "</td>";
                                    echo "<td>" . $row["f_name"] . " " . $row["l_name"] . "</td>";
                                    echo "<td>" . $row["order_status"] . "</td>";
                                    // Generating Actions String
                                    $actions = "";
                                    if ($row["order_status"] != "FULFILLED") {
                                        $actions .= "<a href='manager_actions.php?fulfilled_id=" . $row["order_id"] . "'>Fulfilled</a><br />";
                                    }
                                    if ($row["order_status"] != "PAID") {
                                        $actions .= "<a href='manager_actions.php?paid_id=" . $row["order_id"] . "'>Paid</a><br />";
                                    }
                                    if ($row["order_status"] != "ARCHIVED") {
                                        $actions .= "<a href='manager_actions.php?archive_id=" . $row["order_id"] . "'>Archive</a><br />";
                                    }
                                    if ($row["order_status"] != "PENDING") {
                                        $actions .= "<a href='manager_actions.php?pending_id=" . $row["order_id"] . "'>Pending</a><br />";
                                    } else {
                                        $actions .= "<a href='manager_actions.php?cancel_id=" . $row["order_id"] . "'>Cancel</a><br />";
                                    }
                                    echo "<td>" . $actions .  "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
        <?php
                    mysqli_free_result($get_orders_result);
                } else { echo "<p>No orders match your query!</p>"; }
            }
            mysqli_close($connection);
        ?>
    </article>
    <!-- Footer -->
    <?php include "includes/footer.inc" ?>
</body>
</html>
