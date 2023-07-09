<?php

require 'authentication.php';

$user = new user();

if(isset($_SESSION['lock'])){
    if(time()-$_SESSION['lock']>=10){
        unset($_SESSION['log_attempt']);
        unset($_SESSION['lock']);
    }

}



if (isset($_POST["login"])){
    $info = $user->login($_POST);
   }


$page = 'login';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Log in</title>
</head>
<body>
    <div class="formcontainer">
        <h1>Loculus</h1>
        <!-- login form -->
        <form method="POST">
            <span class="err"> <?php if (isset($info)){echo $info;} ?></span>
            <input type="text" name="username_email" placeholder="Username or email">
            <input type="password" name="password" id="" placeholder="password">
            <input type="submit" name="login" value="login">
            <a href="signup.php" class="info">Sign up</a>
        </form>
    </div>
</body>
</html>