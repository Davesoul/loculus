<?php

require_once("controller.php");

echo $_SESSION['dir_id'];
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
    $stmt0 = "SELECT * FROM user_directory a LEFT JOIN directories b on a.directory_id = b.directory_id WHERE b.directory_id = $dir and a.user_id = $id";
}else if (isset($_SESSION["id"])){
    // $permStmt = "SELECT * FROM user_directory a LEFT JOIN directories b on a.directory_id = b.directory_id WHERE b.directory_name = 'user_$id'";
    $stmt0 = "SELECT * FROM user_directory a LEFT JOIN directories b on a.directory_id = b.directory_id WHERE b.directory_name = 'user_$id'";
}


$results0 = $user->manage_sql($stmt0);
$row0 = $results0->fetch(PDO::FETCH_ASSOC);

$_SESSION['dir_id'] = $row0['directory_id'];
$_SESSION['dir_name'] = $row0['directory_name'];
$_SESSION['dir_path'] = $row0['path'];
$_SESSION['perm_id'] = $row0['permission_id'];


// var_dump($_SESSION);


// echo $_SESSION['dir_path'];

if (isset($_SESSION["dir_id"])){
    $dir_id = $_SESSION["dir_id"];
    $permResults = $user->checkPermission($id, $dir_id);
    $dir_perm = $permResults->fetch(PDO::FETCH_ASSOC);

    if ($dir_perm['permission_id'] == 1){
        // echo "admin";
        ?>
            <div id="more-options" class="btn">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                <div id="options-menu" class="objects">
                    <div class="objbar up"></div>
                    <ul class="popup-container">
                        <li><a href="#" id="plus" onclick="modal_popup('plus')"><i class="fa-solid fa-plus"></i>Import</a></li>
                        <li><a href="#" id="newL" onclick="modal_popup('newL')"><i class="fa-solid fa-folder-plus"></i>New loculus</a></li>
                        <li><a href="#" id = 'share' onclick="modal_popup('share')"><i class="fa-solid fa-share-nodes"></i>Share loculus</a></li>
                        <li><a href="#" id = 'del' onclick="modal_popup('del')"><i class="fa-solid fa-trash-can"></i>Delete loculus</a></li>
                        <li><a href="#" id="chTheme" onclick="modal_popup('chTheme')"><i class="fa-solid fa-moon"></i>theme</a></li>
                    </ul>
                    <div class="objbar down"></div>
                </div>
            </div>


            <?php
     } else {
        // echo "other";
    }
}



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
    $path = '.'.$_SESSION['dir_path'].'/'.$_POST['loculusName'];
    
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



?>


