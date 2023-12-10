<?php

include_once "model/sessions.php";
include_once "model/db_queries.php";
include_once "view/stats.php";


require_once "dbh.php";

//check_session_parameter("index.php", "admin");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Statistics</title>
</head>
<body>
<div class="container">
    <?php
        show_stats($pdo, $_GET["time_period"]);
    ?>  

    <a class="alt_button btn_style" href="admin_panel.php">Go back</a>
</div>
</body>
</html>