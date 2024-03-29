<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // require 'modelconnection.php';

    if (isset($page)){
        require_once "../../model/model.php";
    } else {
        require_once "../model/model.php";
    }

    ob_start();
    session_start();

    $user = new user();


    //Lock login form
    if(isset($_SESSION['lock'])){
        if(time()-$_SESSION['lock']>=120){
            unset($_SESSION['log_attempt']);
            unset($_SESSION['lock']);
        }
        
        $info = "Too many login attempts. Wait for 3 min";
    
    } else {
    
        if (isset($_POST["login"])){
            $info = $user->login($_POST);
        }
    }


    //Logout
    if(isset($_GET['logout'])){
        $user->logout();
    }
    



    if(isset($_SESSION['id'])){
        
        $id = $_SESSION['id'];
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $pass = $_SESSION['password'];

        if (isset($page)){
            if ($page == 'login'){
                header('location: view.php');
            }
        }

    } else {

        if (isset($page)){
            if ($page == 'view'){
                header('location: login.php');
            }
        }

    }
?>