<?php 
    include_once "model/sessions.php";
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
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2 class="header_form">Login</h2>
        <form class="sign_form" action="handlers/login.php" method="post" >
            <input class="input_field" type="text" name="username" placeholder="Username" required />
            <input class="input_field" type="password" name="pass" placeholder="Password" required />
            <button class="main_button btn_style" type="submit">Login</button>
        </form>

        <?php
            session_message("error_message", "error");
            clear_session();
        ?>
    </div>
</body>
</html>