<?php 
    include_once "model/Products.php";
    include_once "model/sessions.php";


    require_once "dbh.php";

    check_session_parameter("index.php", "user");
    $products = Product::extract_table($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <script defer src="scripts/main.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="main">
        <div class="handler">
            <form>
                <input type="text" placeholder="Suma" id="sumaInput">
                <input type="text" placeholder="Rest" id="restInput" readonly>                      
            </form>
            <div class="icons">
                <a href="stats.php?time_period=0"><img class="icon_0" src="image/pay.png"></a>
                <img class="icon_1" onclick="toggleFullScreen()" src="image/fullscreen.png">
                <a href="index.php"><img class="icon_2" src="image/logout.png"></a>
            </div>
        </div>
        <div class="container">
            <div class="up">
                <!--js activity-->
            </div>
            <div class="down">
                <?php Product::displayProducts($pdo, $products); ?>
            </div>
        </div>
    </div>
</body>
</html>
