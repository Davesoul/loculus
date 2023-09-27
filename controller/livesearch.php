<?php
require_once("controller.php");

// var_dump($_SESSION);
// if (isset($_SESSION["lTarget"])){
    if (isset($_GET["receiver_name"])){

        $user_search = $_GET["receiver_name"];

        if ($user_search == ''){$user_search = ' ';}
        // echo $user_search;
        
        //select user_directory information
        $statement = "SELECT * FROM users WHERE username LIKE '%$user_search%' AND username <> '".$_SESSION['username']."';";
        // echo $statement;
        $results = $user->manage_sql($statement);

        if ($results->rowCount()== 0){
            // echo "no user";
        } else {
            while($row = $results->fetch(PDO::FETCH_ASSOC)){
                ?>
                <li onclick="fillsearch('<?php echo $row['username']; ?>', <?php echo $row['user_id']; ?>)"> <img id='pp' src="image/default.jpg" alt="profile picuture"> <p><?php echo $row['username']; ?></p></li>
                <?php
            }
        }

        


    }
// }

?>

