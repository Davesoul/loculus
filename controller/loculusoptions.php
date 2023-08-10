<?php
require_once("controller.php");

var_dump($_SESSION);

// upload new file
if($_SERVER["REQUEST_METHOD"] === "POST"){
    echo 'hi';
    var_dump($_POST);
    // var_dump($_FILES['toUpload']);
    if(isset($_FILES["toUpload"])){
        // $user = new user();

        $file = $_FILES["toUpload"];
        
        if(isset($_SESSION['dir_path'])){

            echo "this is the dir";
            $cleanFileName = preg_replace('/[^a-zA-Z0-9-_\.]/', '', $file['name']);
            $target_dir = $_SESSION['dir_path'].'/';
            echo $target_dir;

            $perm=fileperms($target_dir);
            $perm = substr(sprintf('%o', $perm), -4);
            
            //create directory with enough permissions to upload file
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
            echo $perm;

        };
        // $target_dir = "./Directories/";
        $target_file = $target_dir.basename($cleanFileName);
        echo $target_file;
        // $uploadOk = 1;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        


        //check if file exist
        if (file_exists($target_file)){
            echo exec('pwd');
            echo "sorry, file already exists.";
        //     $uploadOk = 0;
        }else{
            if(move_uploaded_file($file["tmp_name"], $target_file)){
                //insert into resources
                $uploadtodb = $user->db->prepare("insert into resources (resource_name, type, size) values (:a, :b, :c)");
                $uploadtodb->bindParam(":a", $cleanFileName);
                $uploadtodb->bindParam(":b", $file["type"]);
                $uploadtodb->bindParam(":c", $file["size"]);

                $uploadtodb->execute();

                //insert into directory_resource
                $lastID = $user->db->prepare('select last_insert_id()');
                $lastID->execute();
                $row = $lastID->fetch(PDO::FETCH_ASSOC);

                $uploadtodb = $user->db->prepare("insert into directory_resource (directory_id, resource_id) values (:a, :b)");
                $uploadtodb->bindParam(":a", $_SESSION['dir_id']);
                $uploadtodb->bindParam(":b", $row['last_insert_id()']);
                

                $uploadtodb->execute();
                echo exec('pwd');
                echo $file["tmp_name"]."has been uploaded";
            }
            else{
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }

    
    // create new loculus(folder)
    if(isset($_POST['loculusName'])){
        echo "create new loculus";
        $path = '..'.$_SESSION['dir_path'].'/'.$_POST['loculusName'];
        echo $path;

        if(mkdir($path, 0755, true)){
            //insert into directories
            $uploadtodb = $user->db->prepare("insert into directories (directory_name, path) values (:a, :b)");
            $uploadtodb->bindParam(":a", $_POST['loculusName']);
            $uploadtodb->bindParam(":b", $path);
            $uploadtodb->execute();

            $lastID = $user->db->prepare('select last_insert_id()');

            $lastID->execute();

            $row = $lastID->fetch(PDO::FETCH_ASSOC);

            //insert into user_directory
            $pid = 1;
            $uploadtodb = $user->db->prepare("insert into user_directory (user_id, directory_id, permission_id) values (:a, :b, :c)");
            $uploadtodb->bindParam(":a", $id);
            $uploadtodb->bindParam(":b", $row['last_insert_id()']);
            $uploadtodb->bindParam(":c", $pid);
            $uploadtodb->execute();

        } else if (mkdir($path, 0755, false)){
            echo "folder already created";
        } else {
            echo "failed to create folder";
        }

        
    }

    // set theme
    if(isset($_POST['theme'])){
        $_SESSION["c1"] = $_POST['c1'];
        $_SESSION["c2"] = $_POST['c2'];
        $_SESSION["c3"] = $_POST['c3'];
    }


    // transfer file
    if(isset($_POST['share'])){
        $searchedUser = $_POST['searchedUser'];
        $searchedUserId = $_POST['searched_user_id'];

        if ($_POST['userRole'] == "Admin") {
            $userRole = 1;
        }if ($_POST['userRole'] == "Standard") {
            $userRole = 2;
        } else {
            $userRole = 3;
        }

        //select user_directory information
        $statement = "SELECT * FROM user_directory WHERE user_id = $searchedUserId AND directory_id = $directory_id";
        // echo $statement;
        $results = $user->manage_sql($statement);

        if ($results->rowCount()== 0){
            
            //insert into user_directory
            $uploadtodb = $user->db->prepare("insert into user_directory (user_id, directory_id, permission_id) values (:a, :b, :c)");
            $uploadtodb->bindParam(":a", $searchedUser);
            $uploadtodb->bindParam(":b", $_SESSION["dir_id"]);
            $uploadtodb->bindParam(":c", $userRole);
            $uploadtodb->execute();

        } else {

        }
        //find id
        $uploadtodb = $user->db->prepare("UPDATE user_directory SET permission_id = $userRole WHERE user_id = $searchedUserId AND directory_id = $directory_id");
        $uploadtodb->execute();



        //insert into transfers
        $uploadtodb = $user->db->prepare("insert into transfers (user_id, resource_id, destination_user_id) values (:a, :b, :c)");
        $uploadtodb->bindParam(":a", $_POST['loculusName']);
        $uploadtodb->bindParam(":b", $path);
        $uploadtodb->execute();

        $lastID = $user->db->prepare('seletransfersct last_insert_id()');

        $lastID->execute();

        $row = $lastID->fetch(PDO::FETCH_ASSOC);
        
    }


}





// Delete Loculus
if(isset($_GET['delLoculus'])){
    // $directory_id = $_GET['delLoculus'];
    $delstmt = "DELETE FROM directories WHERE directory_id = ".$_SESSION['dir_id'].";";
    $user->manage_sql($delstmt);
}


if(isset($_GET['deletion'])){
    $resource_id = $_GET['deletion'];
    $delstmt = "DELETE FROM resources where resource_id = '$resource_id' ";
    $user->manage_sql($delstmt);
}

