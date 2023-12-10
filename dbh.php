<?php

include_once "model/sessions.php";

$host = "localhost";
$dbname = "coursework";
$dbusername = "root";
$dbpassword = "";


$dsn = "mysql:host={$host};dbname={$dbname}";


try
{
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $exception)
{
    if(isset($db_error_path))
    {
        write_into_session_and_go_to($db_error_path, "error_message", 
        "CONNECTION ERROR: " . $exception->getMessage());
    }
    write_into_session_and_go_to("index.php", "error_message", 
        "CONNECTION ERROR: " . $exception->getMessage());
}

