<?php 
    include_once "model/db_queries.php";
    include_once "model/sessions.php";
    include_once "view/product.php";

    
    require_once "dbh.php"; 

    check_session_parameter("index.php", "admin");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['select_category'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $category_id = $_POST['select_category'];
            insert($pdo, "products", ["name" => $name, "price" => $price,
                "products_categories_id" => $category_id]);
            write_into_session_and_go_to("add_product.php", 
                "success_message", "Product successfully added");
        }
    }
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
    <title>Add new product</title>
</head>
<body>
    <div class="container">
        <h2 class="header_form">Add product</h2>
        
        <form class="sign_form" method="post">
            <?php show_category_option($pdo, "products_categories"); ?>

            <input class="input_field" type="text" name="name" placeholder="Name" required />
            <input class="input_field" type="number" min="0" name="price" placeholder="Price" required />
            <button class="main_button btn_style" type="submit">Add product</button>
        </form>

        <a class="alt_button btn_style" href="admin_panel.php">Go to panel</a>
        <?php 
            session_message("error_message", "error"); 
            session_message("success_message", "success"); 
        ?>
    </div>
</body>
</html>