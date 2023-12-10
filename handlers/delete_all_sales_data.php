<?php

include_once "../model/db_queries.php";
include_once "../model/sessions.php";

$db_error_path = "../index.php";


require_once "../dbh.php"; 

check_session_parameter("../index.php", "admin");

delete_all_data_from_table($pdo, "sales");

write_into_session_and_go_to("../admin_panel.php", "success_message", 
    "All sales data was deleted");