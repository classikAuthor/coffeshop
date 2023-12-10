<?php
    include_once "model/sessions.php";
    check_session_parameter("index.php", "admin");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Panel</title>
</head>
<body>
    <div class="container">
        <h3 class="admin_panel_header">Get statistics for:</h3>

        <ul class="admin_items">
            <li><a href="stats.php?time_period=0">Today</a></li>
            <li><a href="stats.php?time_period=1">Yesterday</a></li>
            <li><a href="stats.php?time_period=7">Last 7 days</a></li>
            <li><a href="stats.php?time_period=30">Last 30 days</a></li>
            <li><a href="stats.php">All time</a></li>
        </ul>

        <div class="btn_block">
            <?php
                session_message("success_message", "success");
            ?>
            <a class="btn_style alt_button" href="signup.php">Signup new user</a>
            <a class="btn_style alt_button" href="delete_user.php">Delete user</a>
            <a class="btn_style alt_button" href="add_product.php">Add product</a>
            <a class="btn_style alt_button" href="del_product.php">Delete product</a>
            <a class="btn_style alt_button" href="handlers/delete_all_sales_data.php">Delete all sales data</a>
            <a class="btn_style logout_button" href="index.php">Log out</a>
        </div>
    </div>
</body>
</html>