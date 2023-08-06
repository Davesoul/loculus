<?php
require_once("authentication.php");

// if (isset($_SESSION["lTarget"])){
    if (isset($_SESSION["id"])){

            $id = $_SESSION["id"];
            
            //select user_directory information
            $statement = "SELECT * FROM user_directory a inner join directories c on a.directory_id = c.directory_id where a.user_id = $id AND a.permission_id = 1;";
            $results = $user->manage_sql($statement);

            echo $statement;
            if ($results->rowCount()== 0){
                echo "no folder";
                header("location: interface.php");
            }

            

            while($row = $results->fetch(PDO::FETCH_ASSOC)){
                ?>
                <li><?php echo $row['path']; ?></li>
                <?php
            }
        }
// }

?>

