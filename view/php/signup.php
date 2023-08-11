<?php
$page = 'signup';

require '../../controller/controller.php';

// $user = new user();


$nameErr="";
$emailErr="";
$passwordErr="";



if (isset($_POST["signup"])){
    if(empty($_POST["username"])){
        $nameErr = "username required";
    }
    else{
        if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["username"])) {
            $nameErr = "Only letters and numbers allowed";
          }
    }

    if(empty($_POST["password"])){
        $passwordErr = "password required";
    }

    if(empty($_POST["email"])){
        $emailErr = "email required";
    }else{
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "invalid email format";
          }
    }
    if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"])){
        $user->signup($_POST);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Sign up</title>
</head>
<body>
    <div class="formcontainer">
        <h1>Loculus</h1>
        <!-- sign up form -->
        <form method="POST">
            <input type="text" name="username" placeholder="Username">
            <?php if ($nameErr != "") {?>
                <span class="err"><?php echo $nameErr ?></span>    
            <?php } ?>
            
            <input type="email" name="email" id="" placeholder="Email">
            <?php if ($emailErr != "") {?>
                <span class="err"><?php echo $emailErr ?></span> 
            <?php } ?>

            
            <input type="password" name="password" id="" placeholder="Password">
            <?php if ($passwordErr != "") {?>
                <span class="err"><?php echo $passwordErr ?></span>
            <?php } ?>
            
            <input type="submit" name="signup" value="Signup">
            <a href="login.php" class="info">Log in</a>
        </form>
    </div>
</body>
</html>