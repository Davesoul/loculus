<?php
require 'authentication.php';



if(isset($_POST["submit"])){

    $user = new user();

    echo exec('whoami');
    $target_dir = "./";
    $target_file = $target_dir.basename($_FILES["toUpload"]["name"]);
    echo $target_file;
    // $uploadOk = 1;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    


    //check if file exist
    if (file_exists($target_file)){
        echo "sorry, file already exists.";
    //     $uploadOk = 0;
    }else{
        if(move_uploaded_file($_FILES["toUpload"]["tmp_name"], $target_file)){
            $uploadtodb = $user->db->prepare("insert into resources (filename, type, size) values (:a, :b, :c)");
            $uploadtodb->bindParam(":a", $_FILES["toUpload"]["name"]);
            $uploadtodb->bindParam(":b", $_FILES["toUpload"]["type"]);
            $uploadtodb->bindParam(":c", $_FILES["toUpload"]["size"]);

            $uploadtodb->execute();
            echo $_FILES["toUpload"]["tmp_name"]."has been uploaded";
        }
        else{
            echo "Sorry, there was an error uploading your file.";
        }
    }

}

$page = "myloculus";
?>
   
    <div class="gap"></div>

    <div class="big-container">

             
                <div class="loculuscontainer">

                   

                    <div class="container">
                        <div class="iconcontainer">
                            <i class="fa-solid fa-file-pdf"></i>
                        </div>
                        <div class="itemcontainer">                
                            <div class="smalldescription">
                                <h4><?php echo $row["resource_name"];?></h4>
                                <p><?php echo $row["type"];?></p>
                                <p><?php echo $row["size"];?></p>
                                <p><?php echo $row["created_at"];?></p>
                            </div>
                            <!-- <div class="fading-bg"></div> -->
                            <div class="options">
                                <i class="fa-solid fa-chevron-down hint"></i>
                                <a href="<?php $row["path"]. '/' .$row['resource_name']. ''.$row['type'];?>" target="_blank"><i class="fa-solid fa-play"></i></a>
                                <a href="<?php $row["path"]. '/' .$row['resource_name']. ''.$row['type'];?>" download><i class="fa-solid fa-download"></i></a>
                                <a href=""><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
        
    </div>
        

