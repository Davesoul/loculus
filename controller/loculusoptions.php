<?php
require_once("controller.php");

// var_dump($_SESSION);
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $pass = $_SESSION['password'];
    $dir = $_SESSION['dir_id'];
    $path = $_SESSION['dir_path'];
    $dir_name = $_SESSION['dir_name'];
}

// echo $dir;
// echo $path;



// upload new file
if($_SERVER["REQUEST_METHOD"] === "POST"){
    echo 'hi';
    var_dump($_POST);
    // var_dump($_FILES['toUpload']);
    if(isset($_FILES["toUpload"])){

        // $user = new user();
        $maxfsize = ini_get('upload_max_filesize');
        $postmsize = ini_get('post_max_size');

        echo $maxfsize. '&' .$postmsize;

                
        $file = $_FILES["toUpload"];

        
        if(isset($_SESSION['dir_path'])){

            echo "this is the dir";
            $cleanFileName = preg_replace('/[^a-zA-Z0-9-_\.]/', '', $file['name']);
            $target_dir = '../' .$_SESSION['dir_path'];
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
        $target_file = $target_dir.'/'.basename($cleanFileName);
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

                //create and save thumbnail
                
                if (strpos($file['type'], 'text') !== FALSE){
                    $textContent = file_get_contents($target_file);
                    $image = imagecreatetruecolor(100, 70);
                    $background = imagecolorallocate($image, 255, 255, 255);
                    $textColor = imagecolorallocate($image, 0, 0, 0);
                    imagefilledrectangle($image, 0, 0, 200, 200, $background);
                    imagestring($image, 5, 10, 10, $textContent, $textColor);
    
                    $thumbnail_path =  $target_dir.'/thumbnail_'.basename($cleanFileName);

                    // Add text content to the image
                    
                    
                    // Save the generated thumbnail image as PNG
                    imagepng($image, $thumbnail_path);

                    imagedestroy($image);
                    

                }else if(strpos($file['type'], 'pdf') !== FALSE){
                    $image = new Imagick();
                    $image->setResolution(72, 72);
                    $image->readImage($target_file . '[0]'); // Render the first page
                    $image->thumbnailImage(200, 200, true);
                    $thumbnail_path =  $target_dir.'/thumbnail_'.basename($cleanFileName);
                    $image->writeImage($thumbnail_path);
                    $image->destroy();
                }else if(strpos($file['type'], 'image') !== FALSE){
                    echo 'creating thumbnail';
                    // Load the original image
                    if (strpos($file['type'], 'png') !== FALSE){
                        $originalImage = imagecreatefrompng($target_file);
                    } else if(strpos($file['type'], 'jpeg') !== FALSE){
                        $originalImage = imagecreatefromjpeg($target_file);
                    }                    
                    

                    // Create a thumbnail with a specific width and height
                    $thumbnail = imagecreatetruecolor(100, 100);

                    // Resize and copy the original image to the thumbnail
                    imagecopyresized($thumbnail, $originalImage, 0, 0, 0, 0, 100, 100, imagesx($originalImage), imagesy($originalImage));

                    // Output the thumbnail
                    header('Content-Type: image/jpeg');
                    $thumbnail_path =  $target_dir.'/thumbnail_'.basename($cleanFileName);
                    imagejpeg($thumbnail, $thumbnail_path, 90);

                    // Clean up
                    imagedestroy($originalImage);
                    imagedestroy($thumbnail);

                }else if(strpos($file['type'], 'video') !== FALSE){
                    # Generate a video thumbnail using FFmpeg
                    $thumbnail_path =  $target_dir.'/thumbnail_'.basename($cleanFileName);

                    $cmd = "ffmpeg -i ".$target_file." -ss 00:00:05 -t 5 -c:v copy -c:a copy ".$thumbnail_path;

                    shell_exec($cmd);

                }else{echo 'else...'; echo $file['type'];}


                //insert into resources
                $uploadtodb = $user->db->prepare("insert into resources (resource_name, resource_thumbnail, type, size) values (:a, :b, :c, :d)");
                $uploadtodb->bindParam(":a", $cleanFileName);
                $uploadtodb->bindParam(":b", $thumbnail_path);
                $uploadtodb->bindParam(":c", $file["type"]);
                $uploadtodb->bindParam(":d", $file["size"]);

                $uploadtodb->execute();

                //insert into directory_resource
                $lastID = $user->db->prepare('select last_insert_id()');
                $lastID->execute();
                $row = $lastID->fetch(PDO::FETCH_ASSOC);

                $uploadtodb = $user->db->prepare("insert into directory_resource (directory_id, resource_id) values (:a, :b)");
                $uploadtodb->bindParam(":a", $_SESSION['dir_id']);
                $uploadtodb->bindParam(":b", $row['last_insert_id()']);

                $uploadtodb->execute();


                // insert into history
                $action = "upload file";
                $uploadtodb = $user->db->prepare("insert into history (user_id, action) values (:a, :b)");
                $uploadtodb->bindParam(":a", $id);
                $uploadtodb->bindParam(":b", $action);

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
        $path = '../' .$_SESSION['dir_path'].'/'.$_POST['loculusName'];
        echo $path;

        if(mkdir($path, 0755, true)){
            //insert into directories
            $uploadtodb = $user->db->prepare("insert into directories (directory_name, path) values (:a, :b)");
            $uploadtodb->bindParam(":a", $_POST['loculusName']);
            $uploadtodb->bindParam(":b", $path);
            $uploadtodb->execute();

            //get the created directory id
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


            // insert into history
            $action = "create loculus ";
            $uploadtodb = $user->db->prepare("insert into history (user_id, action) values (:a, :b)");
            $uploadtodb->bindParam(":a", $id);
            $uploadtodb->bindParam(":b", $action);

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


    // share loculus
    if(isset($_POST['searchedUser']) && isset($_POST['userRole'])){
        $searchedUser = $_POST['searchedUser'];
        $searchedUserId = $_POST['searchedUserId'];

        echo $searchedUser;
        echo $searchedUserId;

        if ($_POST['userRole'] == "admin") {
            $userRole = 1;
        }else if ($_POST['userRole'] == "standard") {
            $userRole = 2;
        } else {
            $userRole = 3;
        }
        echo $userRole;

        //select user_directory information
        $statement = "SELECT * FROM user_directory WHERE user_id = $searchedUserId AND directory_id = $dir";
        echo $statement;
        $results = $user->manage_sql($statement);

        if ($results->rowCount()== 0){
            echo 'not existing';
            //insert into user_directory if permissions not set
            $uploadtodb = $user->db->prepare("insert into user_directory (user_id, directory_id, permission_id) values (:a, :b, :c)");
            $uploadtodb->bindParam(":a", $searchedUserId);
            $uploadtodb->bindParam(":b", $dir);
            $uploadtodb->bindParam(":c", $userRole);
            $uploadtodb->execute();

            
        } else {
            echo 'existing';
            //update user_directory if permissions already set
            $uploadtodb = $user->db->prepare("UPDATE user_directory SET permission_id = $userRole WHERE user_id = $searchedUserId AND directory_id = ".$_SESSION['dir_id']."");
            $uploadtodb->execute();
        }

        // insert into history
        $action = "granted access";
        $uploadtodb = $user->db->prepare("insert into history (user_id, action) values (:a, :b)");
        $uploadtodb->bindParam(":a", $id);
        $uploadtodb->bindParam(":b", $action);

        $uploadtodb->execute();

        
    }


    // share file
    if(isset($_POST['fileID']) && isset($_POST['searchedUserId'])){
        $searchedUser = $_POST['searchedUser'];
        $searchedUserId = $_POST['searchedUserId'];
        $fileID = $_POST['fileID'];

        //select resource information
        $statement = "SELECT * FROM resources a left JOIN directory_resource b on a.resource_id = b.resource_id 
        RIGHT JOIN directories c ON b.directory_id = c.directory_id WHERE a.resource_id = '$fileID'";
        // echo $statement;
        $results = $user->manage_sql($statement);
        $row = $results->fetch(PDO::FETCH_ASSOC);



        //insert into transfers
        $uploadtodb = $user->db->prepare("insert into transfers (user_id, transfered_resource, destination_user_id) values (:a, :b, :c)");
        $uploadtodb->bindParam(":a", $id);
        $uploadtodb->bindParam(":b", $fileID);
        $uploadtodb->bindParam(":c", $searchedUserId);
        $uploadtodb->execute();

        $lastID = $user->db->prepare('select last_insert_id()');

        $lastID->execute();

        $ID = $lastID->fetch(PDO::FETCH_ASSOC); 

        //copy to temporary location
        
        $sourceFile = '../'.$row['path'].'/'.$row['resource_name'];
        $destinationFile = '../../Directories/TMP/'.$row['resource_name'].'_'.$ID['last_insert_id()'];

        if (!is_dir('../../Directories/TMP/')) {
            mkdir('../../Directories/TMP/', 0755, true);
        }

        if (copy($sourceFile, $destinationFile)) {



            // insert into history
            $action = "share file";
            $uploadtodb = $user->db->prepare("insert into history (user_id, action) values (:a, :b)");
            $uploadtodb->bindParam(":a", $id);
            $uploadtodb->bindParam(":b", $action);

            $uploadtodb->execute();
            
            $row = $lastID->fetch(PDO::FETCH_ASSOC);

            echo "File sent successfully.";
        } else {
            echo "Failed to send the file.";
        }


        
    }
}

// shared file accepted
if (isset($_POST['transferID']) && isset($_POST['acceptance'])){
    $transferID = $_POST['transferID'];
    $acceptance = $_POST['acceptance'];


    // update transfer table
    $statement = "Update transfers SET acceptance = $acceptance WHERE transfer_id = $transferID";
    $user->manage_sql($statement);
    

    //select transfer information
    $statement = "SELECT * FROM transfers WHERE transfer_id = $transferID";
    // echo $statement;
    $results = $user->manage_sql($statement);
    $row = $results->fetch(PDO::FETCH_ASSOC);
    

    //move to final location
    $resource_name = str_replace('_'.$transferID, "", $row['transfered_resource']);

    $sourceFile = '../../Directories/TMP/'.$row['transfered_resource'];
    $destinationFile = '../../Directories/user_'.$row['destination_user_id'].'/'.$resource_name;

    if(move($sourceFile, $destinationFile)){
        //insert into resources

        $fileName = basename($destinationFile);
        $size = filesize($destinationFile);
        $fileSize = $size / 1024;
        $fileType = mime_content_type($destinationFile);
        $fileInfo = pathinfo($filePath);

        $uploadtodb = $user->db->prepare("insert into resources (resource_name, type, size) values (:a, :b, :c)");
        $uploadtodb->bindParam(":a", $fileName);
        $uploadtodb->bindParam(":b", $fileType);
        $uploadtodb->bindParam(":c", $fileSize);

        $uploadtodb->execute();
    }
    

    // insert into history
    $action = "accepted file";
    $uploadtodb = $user->db->prepare("insert into history (user_id, action) values (:a, :b)");
    $uploadtodb->bindParam(":a", $id);
    $uploadtodb->bindParam(":b", $action);

    $uploadtodb->execute();
    

}

// Read file
if(isset($_GET['filePath'])){
    // echo 'reading file';
    $filePath = $_GET['filePath'];
    // echo '<pre>';
    readfile($filePath);
    // echo '<pre>';
}

// Delete Loculus
if(isset($_GET['delLoculus'])){
    // $directory_id = $_GET['delLoculus'];
    $delstmt = "DELETE FROM directories WHERE directory_id = ".$_SESSION['dir_id'].";";
    $user->manage_sql($delstmt);
    rmdir('../' .$_SESSION['dir_path']);

    // insert into history
    $action = "delete loculus";
    $uploadtodb = $user->db->prepare("insert into history (user_id, action) values (:a, :b)");
    $uploadtodb->bindParam(":a", $id);
    $uploadtodb->bindParam(":b", $action);

    $uploadtodb->execute();
}


// delete file and thumbnail
if(isset($_GET['deletion'])){
    $resource_id = $_GET['deletion'];

    $stmt = "select * FROM resources a JOIN directory_resource b ON a.resource_id = b.resource_id JOIN directories c ON b.directory_id = c.directory_id WHERE a.resource_id = $resource_id";
    $results = $user->manage_sql($stmt);
    $row = $results->fetch(PDO::FETCH_ASSOC);

    $fileToDel = '../'.$row['path'].'/'.$row['resource_name'];
    $thumbnailToDel = '../'.$row['path'].'/thumbnail_'.$row['resource_name'];
    
    if (unlink($fileToDel) && unlink($thumbnailToDel)){
        $delstmt = "DELETE FROM resources where resource_id = '$resource_id' ";
        $user->manage_sql($delstmt);
        echo $row['resource_name'].' deleted';
    }
}

