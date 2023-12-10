<?php 

include_once "../model/db_queries.php";
include_once "../model/sessions.php";

$db_error_path = "../index.php";


require_once "../dbh.php"; 


if($_SERVER["REQUEST_METHOD"] !== "POST")
{
    write_into_session_and_go_to("../index.php", 
        "error_message", "Please try again");
}

$username = $_POST["username"]; 
$pass = $_POST["pass"];

if(empty($username) || empty($pass))
{
    write_into_session_and_go_to("../index.php", "error_message", 
        "Please fill in all required fields");
}


$logined = get_values($pdo, "admins", ["username"], 
            ["username" => $username, "pass" => $pass]);

if($logined)
{
    write_into_session("admin", true);
    header("Location: ../admin_panel.php");
    exit();
}


$logined = get_values($pdo, "users", ["username"],
            ["username" => $username, "pass" => $pass]);

if($logined)
{
    write_into_session("user", $username);
    header("Location: ../main.php");
    exit();
}


write_into_session_and_go_to("../index.php", 
    "error_message", "Wrong login or password");
