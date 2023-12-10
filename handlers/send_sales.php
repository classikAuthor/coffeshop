<?php
    require_once "../dbh.php"; 

    
    include_once "../model/db_queries.php";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $username = $_SESSION['user'];
        $user = get_values($pdo, "users", ["id"], ["username" => $username]);
        session_write_close();
        $product_names = $_POST['name'];

        foreach($product_names as &$product) {
            $product_id = get_values($pdo, "products", ["id"], ["name" => $product]);
            insert($pdo, "sales", ["user_id" => $user['id'], "product_id" => $product_id['id']]);
        }
    }
    header("Location: ../main.php");
    exit();
?>