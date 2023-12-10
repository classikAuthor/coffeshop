<?php 
    include_once "model/sessions.php";
    include_once "model/sessions.php";

    check_session_parameter("index.php", "admin");
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
    <title>Sign up</title>
</head>
<body>
    <div class="container">
        <h2 class="header_form">Sign up</h2>
        
        <form class="sign_form" action="handlers/signup.php" method="post">
            <input class="input_field" type="text" name="username" placeholder="Username" required />
            <input class="input_field" type="email" name="email" placeholder="E-mail" required />
            <input class="input_field" type="password" name="pass" placeholder="Password" required />
            <button class="main_button btn_style" type="submit">Sign up new user</button>
        </form>

        <a class="alt_button btn_style" href="admin_panel.php">Go to panel</a>
        <?php 
            session_message("error_message", "error"); 
            session_message("success_message", "success"); 
        ?>
    </div>
</body>
</html>