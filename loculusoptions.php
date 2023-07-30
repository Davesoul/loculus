<?php
require_once("authentication.php");

var_dump($_SESSION);

// upload new file
if($_SERVER["REQUEST_METHOD"] === "POST"){
    echo 'hi';
    // var_dump($_FILES['toUpload']);
    if(isset($_FILES["toUpload"])){
        // $user = new user();

        $file = $_FILES["toUpload"];
        
        if(isset($_SESSION['dir_path'])){

            echo "this is the dir";
            $cleanFileName = preg_replace('/[^a-zA-Z0-9-_\.]/', '', $file['name']);
            $target_dir = '.'.$_SESSION['dir_path'].'/';
            echo $target_dir;

            $perm=fileperms($target_dir);
            $perm = substr(sprintf('%o', $perm), -4);
            
            //create directory with enough permissions to upload file
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0775, true);
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
    
}

// create new loculus(folder)
if(isset($_POST['Newloculus'])){
    echo "create new loculus";
    $path = '.'.$_SESSION['dir_path'].'/'.$_POST['loculusName'];
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

// transfer file
if(isset($_POST['share'])){}

// set theme
if(isset($_POST['theme'])){}


if(isset($_GET['del'])){
    $resource_id = $_GET['del'];
    $delstmt = "DELETE FROM resources where resource_id = '$resource_id' ";
    $user->manage_sql($delstmt);
}

if(isset($_GET['delLoculus'])){
    $directory_id = $_GET['del'];
    $delstmt = "DELETE FROM directories where directory_id = '$directory_id' ";
    $user->manage_sql($delstmt);
}