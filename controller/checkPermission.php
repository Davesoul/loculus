<?php

require_once("controller.php");

// echo $_SESSION['dir_id'];
// echo "the directory id is ".$_SESSION["dir_id"];


// if(isset($_SESSION['id'])){
//     $id = $_SESSION['id'];
//     $username = $_SESSION['username'];
//     $email = $_SESSION['email'];
//     $pass = $_SESSION['password'];
// }else{
//     header('location: login.php');
// }



// queries for directories and resources
if (isset($_GET['dir_id'])){
    // echo $_GET["dir_id"];
    $dir = $_GET['dir_id'];
    // $permStmt = "SELECT * FROM user_directory a LEFT JOIN directories b on a.directory_id = b.directory_id WHERE a.directory_id = $dir";
    $stmt0 = "SELECT * FROM user_directory a LEFT JOIN directories b on a.directory_id = b.directory_id JOIN user_preferences c ON a.user_id = c.user_id WHERE b.directory_id = $dir AND a.user_id = $id";
    
}else if (isset($_SESSION["id"])){
    // $permStmt = "SELECT * FROM user_directory a LEFT JOIN directories b on a.directory_id = b.directory_id WHERE b.directory_name = 'user_$id'";
    $stmt0 = "SELECT * FROM user_directory a LEFT JOIN directories b on a.directory_id = b.directory_id JOIN user_preferences c ON a.user_id = c.user_id WHERE b.directory_name = 'user_$id'  AND a.user_id = $id";
}


$results0 = $user->manage_sql($stmt0);
$row0 = $results0->fetch(PDO::FETCH_ASSOC);

$_SESSION['dir_id'] = $row0['directory_id'];
$_SESSION['dir_name'] = $row0['directory_name'];
$_SESSION['dir_path'] = $row0['path'];
$_SESSION['perm_id'] = $row0['permission_id'];
$_SESSION['pp'] = $row0['profile_picture'];
$_SESSION['c1'] = $row0['color1'];
$_SESSION['c2'] = $row0['color2'];
$_SESSION['c3'] = $row0['color3'];



?>


