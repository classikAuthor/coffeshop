<?php 

include_once "../model/db_queries.php";
include_once "../model/sessions.php";

$db_error_path = "../index.php";

require_once "../dbh.php"; 


if($_SERVER["REQUEST_METHOD"] !== "POST")
{
    write_into_session_and_go_to("../delete_user.php", 
        "errors_delete_user", "Please try again");
}

$username = $_POST["username"];

if(empty($username))
{
    write_into_session_and_go_to("../delete_user.php", "error_message", 
        "Please fill in all required fields");
}


$user_exist = get_value($pdo, "users", "username", 
                "username", $username);


if(empty($user_exist))
{
    write_into_session_and_go_to("../delete_user.php", "error_message", 
        "User \"{$username}\" does not exist. Please try again");
}

delete($pdo, "users", ["username" => $username]);


write_into_session_and_go_to("../delete_user.php", 
    "success_message", "User successfully deleted");
