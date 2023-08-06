<?php
$page = 'login';

require '../../controller/controller.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Log in</title>
</head>
<body>
    <div class="formcontainer">
        <h1>Loculus</h1>
        <!-- login form -->
        <form method="POST">
            <p class="err"> <?php if (isset($info)){echo $info;} ?></p>
            <input type="text" name="username_email" placeholder="Username or email">
            <input type="password" name="password" id="" placeholder="password">
            <input type="submit" name="login" value="login">
            <a href="signup.php" class="link">Sign up</a>
        </form>
    </div>
</body>
</html>