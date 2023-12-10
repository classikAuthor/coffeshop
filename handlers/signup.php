<?php 

include_once "../model/db_queries.php";
include_once "../model/sessions.php";

$db_error_path = "../index.php";


require_once "../dbh.php"; 


if($_SERVER["REQUEST_METHOD"] !== "POST")
{
    write_into_session_and_go_to("../signup.php", 
        "error_message", "Please try again");
}

$username = $_POST["username"];
$pass = $_POST["pass"];
$email = $_POST["email"];

if(empty($username) || empty($pass) || empty($email))
{
    write_into_session_and_go_to("../signup.php", "error_message", 
    "Please fill in all required fields");
}


$user_exist = get_value($pdo, "users", "username", 
                "username", $username);

if($user_exist)
{
    write_into_session_and_go_to("../signup.php", "error_message", 
        "User already exist. Please change login");
}

insert($pdo, "users", ["username" => $username, "email" => $email, "pass" => $pass]);


write_into_session_and_go_to("../signup.php", 
    "success_message", "User successfully registered");
