<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$page = 'loculus';
echo __DIR__;

require_once '../../controller/controller.php';

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $pass = $_SESSION['password'];
    $dir = $_SESSION['dir_id'];
    $path = $_SESSION['dir_path'];
    $dir_name = $_SESSION['dir_name'];
}



// queries for directories and resources
if (isset($dir)){
    // echo $_GET["dir_id"];
    echo $dir;
    echo "DIRECTORY";
    // $permStmt = "SELECT * FROM user_directory a LEFT JOIN directories b on a.directory_id = b.directory_id WHERE a.directory_id = $dir";
    // $stmt0 = "SELECT * FROM user_directory a LEFT JOIN directories b on a.directory_id = b.directory_id WHERE b.directory_id = $dir and a.user_id = $id";
    $stmt = "SELECT * FROM resources a INNER JOIN directory_resource b ON a.resource_id = b.resource_id join directories c on c.directory_id = b.directory_id where c.directory_id = $dir";
}else if (isset($id)){
    // $permStmt = "SELECT * FROM user_directory a LEFT JOIN directories b on a.directory_id = b.directory_id WHERE b.directory_name = 'user_$id'";
    // $stmt0 = "SELECT * FROM user_directory a LEFT JOIN directories b on a.directory_id = b.directory_id WHERE b.directory_name = 'user_$id'";
    $stmt = "SELECT * FROM resources a inner join directory_resource b ON a.resource_id = b.resource_id join directories c on c.directory_id = b.directory_id where c.directory_name = 'user_$id'";
}


// $results0 = $user->manage_sql($stmt0);
// $row0 = $results0->fetch(PDO::FETCH_ASSOC);

// $_SESSION['dir_id'] = $row0['directory_id'];
// $_SESSION['dir_name'] = $row0['directory_name'];
// $_SESSION['dir_path'] = $row0['path'];
// $_SESSION['perm_id'] = $row0['permission_id'];

if(isset($_SESSION['perm_id'])){
    $perm_id = $_SESSION['perm_id'];

    
}


// echo "delete?";

// echo $_POST['toUpload'];

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // echo '<pre>';
//     // print_r($_POST);
//     // echo '</pre>';
//     var_dump($_POST);
//     var_dump($_FILES);
//     // echo $_FILES['toUpload'];
//     if (isset($_FILES['toUpload'])) {
//         // Do further processing with the file if needed
//         // ...

//         echo "File uploaded successfully!";
//     } else {
//         echo "Error uploading the file.";
//     }
// }

// if (!is_dir($target_dir)) {
//     mkdir($target_dir, 0775, true);
// }

echo "dir_id: ".$_SESSION['dir_id'];
echo "dir_path: ".$_SESSION['dir_path'];
echo $dir_name;
// echo $_SESSION['dir_path'];

// // upload new file
// if($_SERVER["REQUEST_METHOD"] === "POST"){
//     echo 'hi';
//     // var_dump($_FILES['toUpload']);
//     if(isset($_FILES["toUpload"])){
//         // $user = new user();

//         $file = $_FILES["toUpload"];
        
//         if(isset($_SESSION['dir_path'])){

//             echo "this is the dir";
//             $cleanFileName = preg_replace('/[^a-zA-Z0-9-_\.]/', '', $file['name']);
//             $target_dir = '.'.$_SESSION['dir_path'].'/';
//             echo $target_dir;

//             $perm=fileperms($target_dir);
//             $perm = substr(sprintf('%o', $perm), -4);
            
//             //create directory with enough permissions to upload file
//             if (!is_dir($target_dir)) {
//                 mkdir($target_dir, 0775, true);
//             }
//             echo $perm;

//         };
//         // $target_dir = "./Directories/";
//         $target_file = $target_dir.basename($cleanFileName);
//         echo $target_file;
//         // $uploadOk = 1;
//         $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        


//         //check if file exist
//         if (file_exists($target_file)){
//             echo exec('pwd');
//             echo "sorry, file already exists.";
//         //     $uploadOk = 0;
//         }else{
//             if(move_uploaded_file($file["tmp_name"], $target_file)){
//                 //insert into resources
//                 $uploadtodb = $user->db->prepare("insert into resources (resource_name, type, size) values (:a, :b, :c)");
//                 $uploadtodb->bindParam(":a", $cleanFileName);
//                 $uploadtodb->bindParam(":b", $file["type"]);
//                 $uploadtodb->bindParam(":c", $file["size"]);

//                 $uploadtodb->execute();

//                 //insert into directory_resource
//                 $lastID = $user->db->prepare('select last_insert_id()');
//                 $lastID->execute();
//                 $row = $lastID->fetch(PDO::FETCH_ASSOC);

//                 $uploadtodb = $user->db->prepare("insert into directory_resource (directory_id, resource_id) values (:a, :b)");
//                 $uploadtodb->bindParam(":a", $_SESSION['dir_id']);
//                 $uploadtodb->bindParam(":b", $row['last_insert_id()']);
                

//                 $uploadtodb->execute();
//                 echo exec('pwd');
//                 echo $file["tmp_name"]."has been uploaded";
//             }
//             else{
//                 echo "Sorry, there was an error uploading your file.";
//             }
//         }

//     }
    
// }

// // create new loculus(folder)
// if(isset($_POST['Newloculus'])){
//     $path = '.'.$_SESSION['dir_path'].'/'.$_POST['loculusName'];
    
//     if(mkdir($path, 0755, true)){
//         //insert into directories
//         $uploadtodb = $user->db->prepare("insert into directories (directory_name, path) values (:a, :b)");
//         $uploadtodb->bindParam(":a", $_POST['loculusName']);
//         $uploadtodb->bindParam(":b", $path);
//         $uploadtodb->execute();

//         $lastID = $user->db->prepare('select last_insert_id()');

//         $lastID->execute();

//         $row = $lastID->fetch(PDO::FETCH_ASSOC);

//         //insert into user_directory
//         $pid = 1;
//         $uploadtodb = $user->db->prepare("insert into user_directory (user_id, directory_id, permission_id) values (:a, :b, :c)");
//         $uploadtodb->bindParam(":a", $id);
//         $uploadtodb->bindParam(":b", $row['last_insert_id()']);
//         $uploadtodb->bindParam(":c", $pid);
//         $uploadtodb->execute();

//     } else if (mkdir($path, 0755, false)){
//         echo "folder already created";
//     } else {
//         echo "failed to create folder";
//     }

    
// }

// // transfer file
// if(isset($_POST['share'])){}

// // set theme
// if(isset($_POST['theme'])){}


// if(isset($_GET['del'])){
//     $resource_id = $_GET['del'];
//     $delstmt = "DELETE FROM resources where resource_id = '$resource_id' ";
//     $user->manage_sql($delstmt);
// }

// if(isset($_GET['delLoculus'])){
//     $directory_id = $_GET['del'];
//     $delstmt = "DELETE FROM directories where directory_id = '$directory_id' ";
//     $user->manage_sql($delstmt);
// }

// echo "hello";

// $page = "myloculus";
// echo $page;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My loculus</title>

    
    <!-- <script src="https://kit.fontawesome.com/766f30b49e.js" crossorigin="anonymous"></> -->
</head>


<body>
   
    <div class="gap"></div>

    <div class="big-container">

        <?php
        
        
            // // echo $page;
            // if (isset($_GET['dir_id'])){
            //     $dir = $_GET['dir_id'];
            //     $stmt0 = "select * from directories where directory_id = $dir";
            //     $stmt = "select * from resources a inner join directory_resource b on a.resource_id = b.resource_id join directories c on c.directory_id = b.directory_id where c.directory_id = $dir";
            // }else if (isset($_SESSION["id"])){
            //     $stmt0 = "select * from directories where directory_name = '$username'";
            //     $stmt = "select * from resources a inner join directory_resource b on a.resource_id = b.resource_id join directories c on c.directory_id = b.directory_id where c.directory_name = '{$username}'";
            // }
            
            // if (isset($stmt0) && isset($stmt)){
            //     $results0 = $user->manage_sql($stmt0);
            //     $row0 = $results0->fetch(PDO::FETCH_ASSOC);
                
            //     $_SESSION['dir_id'] = $row0['directory_id'];
            //     $_SESSION['dir_name'] = $row0['directory_name'];
            //     $_SESSION['dir_path'] = $row0['path'];


                $results = $user->manage_sql($stmt);
    

                ?>

                <div class="gap"></div>
                <h1><?php if($_SESSION['dir_name'] == "user_$id"){
                    echo "Home";
                } else {echo $_SESSION['dir_name'];} ?></h1>
                <div class="gap"></div>

                <?php
                if ($results->rowCount()== 0){
                    echo "Empty folder";
                }
            
                
             ?>
             
                <div class="loculuscontainer">

                    <?php while($row = $results->fetch(PDO::FETCH_ASSOC)){ ?>

                    <div class="container">
                        <div class="iconcontainer">
                            <?php if (stripos($row["type"], "pdf") !== false){ ?>
                                <i class="fa-solid fa-file-pdf"></i>

                            <?php } elseif (stripos($row["type"], "image") !== false){ ?>
                                <!-- <i class="fa-solid fa-file-image"></i> -->
                                <img src="<?php echo '../'.$row['resource_thumbnail']; ?>" alt="">

                            <?php } elseif (stripos($row["type"], "audio") !== false){ ?>
                                <i class="fa-solid fa-file-audio"></i>

                            <?php } elseif (stripos($row["type"], "video") !== false){ ?>
                                <!-- <i class="fa-solid fa-file-video"></i> -->
                                <video src="<?php echo '../'.$row['resource_thumbnail']; ?>" autoplay muted loop>

                            <?php } elseif (stripos($row["type"], "text") !== false || stripos($row["type"], "application") !== false){ ?>
                                <!-- <i class="fa-solid fa-file-lines"></i> -->
                                <img src="<?php echo '../'.$row['resource_thumbnail']; ?>" alt="">
                            <?php } ?>
                        </div>
                        <div class="itemcontainer">                
                            <div class="smalldescription">
                                <h4><?php echo $row["resource_name"];?></h4>
                                <p><?php echo $row["type"];?></p>
                                <p><?php echo $row["size"]." kB"; ?></p>
                                <p><?php echo $row["created_at"];?></p>
                                <div class="gap"></div>
                                <div class="gap"></div>
                            </div>
                            <!-- <div class="fading-bg"></div> -->
                            <div class="options">
                                <i class="fa-solid fa-chevron-down hint"></i>
                                <?php 
                                    if ($_SESSION['perm_id']==1){ ?>
                                        <a href="#space" onclick="openFile('<?php echo '../'.$row['path']; ?>', '<?php echo $row['resource_name']; ?>', '<?php echo $row['type']; ?>')"><i class="fa-solid fa-play"></i></a>
                                        <a href="<?php echo '../../'.$row['path'] . '/' . $row['resource_name']; ?>" download><i class="fa-solid fa-download"></i></a>
                                        <a href="#loculus" id='shareF' onclick="shareFile('<?php echo $row['resource_name']; ?>', <?php echo $row['resource_id']; ?>)"><i class="fa-solid fa-share"></i></a>
                                        <a href="#loculus" id='delete' onclick="deleteFile('<?php echo $row['resource_name']; ?>', <?php echo $row['resource_id']; ?>)"><i class="fa-solid fa-trash-can"></i></a>
                                        
                                <?php } else if ($_SESSION['perm_id']==2){ ?>
                                        <a href="#space" onclick="openFile('<?php echo '../'.$row['path']; ?>', '<?php echo $row['resource_name']; ?>', '<?php echo $row['type']; ?>')"><i class="fa-solid fa-play"></i></a>
                                        <a href="<?php echo '../../'.$row['path'] . '/' . $row['resource_name']; ?>" download><i class="fa-solid fa-download"></i></a>
                                        <a href="#"><i class="fa-solid fa-share"></i></a>
                                <?php } else if ($_SESSION['perm_id']==3){ ?>
                                        <a href="#space" onclick="openFile('<?php echo '../'.$row['path']; ?>', '<?php echo $row['resource_name']; ?>', '<?php echo $row['type']; ?>')"><i class="fa-solid fa-play"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                            <?php   }  ?>
                </div>
        
    </div>
        

</body>

<script >
    //search on page
    var item = document.getElementsByClassName("container");
    var info = document.getElementsByClassName("smalldescription");
    var bar = document.getElementById("bar");

    // bar.addEventListener('keyup', (e)=>{
    //     const data = e.target.value.toLowerCase();
    //     console.log(data);
        
    //     for(i=0; i<item.length; i++){
    //         if(info[i].textContent.toLowerCase().includes(data)){

    //             item[i].style.display = "flex"
    //         }
    //         else{
    //             item[i].style.display = "none"
    //         }
    //     }
    // })
</script>

<script>

    //set global prev_id to store the previous id used
    var prev_id = "";



    //show menu

    // var btn = document.querySelectorAll('.btn');

    // console.log(btn);
    // btn.forEach(b => {
    //     b.addEventListener('click', (e)=>{
    //         e.stopPropagation();
    //         console.log(b);
    //         var menu = b.querySelector('.objects');
    //         var container = b.querySelector('.objects > .popup-container');
    //         console.log(container);

    //         btn.forEach(c => {
    //             console.log(c.contains(b));
    //             if(c != b && c.contains(b) == false){
    //                 c.classList.remove('active');
    //                 prevMenu = c.querySelector('.objects');
    //                 prevContainer = c.querySelector('.objects > .popup-container');
    //                 prevMenu.classList.remove('active');
    //                 prevContainer.classList.remove('active');
    //             }
    //         });

            
    //         console.log(menu.getBoundingClientRect());
    //         console.log(window.innerHeight);

    //         var menuRect = menu.getBoundingClientRect();
    //         var viewport = window.innerWidth;

    //         //reposition the menu div whenever it exceeds the viewport width
    //         if(menuRect.x + menuRect.right >= viewport){
    //             menu.style.right = "2px";
    //         }

    //         b.classList.toggle('active');
    //         menu.classList.toggle('active');
    //         container.classList.toggle('active');

            

    //     });
    // });



    function sp(id){
        var popup = document.getElementById(id);
        console.log(id);
        popup.classList.toggle("active");
    }

    //show a popup according to its id
    function showpopup(id, notouch_id=""){

        //previous popup hidden if set and different from the current popup
        if(id != prev_id && prev_id != "" && prev_id !=notouch_id){
            console.log("gooooo");
            hidePrevPopup(prev_id);
        }

        console.log(id);
        var popup = document.getElementById(id);
        var container = document.getElementById("popup-container");

        if (popup.style.maxHeight != "500px"){
            popup.style.maxHeight = "500px";

            container.style.maxHeight = "500px";
            
            console.log(popup.style.maxHeight);
            console.log(container.style.maxHeight);
        }
        else{
            console.log("nope");
            popup.style.maxHeight = "0";
            container.style.maxHeight = "0";
            console.log(popup.style.maxHeight);
        }
        prev_id = id;
        console.log(prev_id);
    }

    //hide the previous popup
    function hidePrevPopup(prev_id){
        
        var popup = document.getElementById(prev_id);

        popup.style.maxHeight = "0";
    }





    
</script>

<!-- <script>
    //modal popup for file uploading
    var modal = document.getElementById("backgrd");
    var plus = document.getElementById("plus");

    plus.onclick = function (){
        modal.style.display = "block";
    }

    window.onclick = function (event){
        if(event.target == modal){
            modal.style.display = "none";
        }
    }
    
</script> -->


<script>
    // var loculus = document.getElementById('loculus');
    // var optionBtn = document.getElementById('more-options');
    // optionBtn.addEventListener('click', ()=>{
        
    //     var options = document.querySelector('#more-options ul');
    //     console.log('load options');
    
       
    //     console.log(pid);
    //     if (pid == 1){
    //         console.log(optionBtn);
    //         options.innerHTML = `                        <li><a href='#' id='plus'><i class='fa-solid fa-plus'></i>Import</a></li>
    //     <li><a href='#' id='newL'><i class='fa-solid fa-folder-plus'></i>New loculus</a></li>
    //     <li><a href='#' id = 'share'><i class='fa-solid fa-share-nodes'></i>Share loculus</a></li>
    //     <li><a href='#' id = 'del'><i class='fa-solid fa-trash-can'></i>Delete loculus</a></li>
    //     <li><a href='#' id='chTheme'><i class='fa-solid fa-moon'></i>theme</a></li>`;
    //     } else{
    //         console.log('not admin');
    //         options.innerHTML = '';
    //         optionBtn.style.display = 'none';
    //     };

        
    // });
        
    
    // expand card
 
    
    var loculus = document.querySelector('#loculus');
    var itemcontainer = loculus.querySelectorAll(".itemcontainer");
    
    loculus.onclick = function (event){
        var clickedEl = event.target;
        var itemCard = clickedEl.closest('.itemcontainer');
        if (itemCard){
            itemcontainer.forEach(c => {
                console.log('retract');
                // c.style.maxHeight = '150px';
                if (c != itemCard) {
                    c.classList.remove('active');
                }
            })
            console.log('expand');
            // i.style.maxHeight = '500px';
            itemCard.classList.toggle('active');
        }
    }


    // loculus.querySelectorAll(".itemcontainer").forEach(i=>{
    //     i.addEventListener("click", (e)=>{
    //         itemcontainer.forEach(c => {
    //             console.log('retract');
    //             // c.style.maxHeight = '150px';
    //             if (c != i) {
    //                 c.classList.remove('active');
    //             }
    //         })
    //         console.log('expand');
    //         // i.style.maxHeight = '500px';
    //         i.classList.toggle('active');

    //     })
    // }) 


    // delete file
    var deleteBtn = document.getElementById('delete');
    var modal = document.getElementById("backgrd");
    var modalP = document.querySelector("#modal-popup");

    function deleteFile(filename, fileID){
        console.log('delete');
        modal.style.display = "block";
        modalP.innerHTML = `                  
            <form action="" method="POST">
                <i class="fa-solid fa-trash-can"></i>
                <p>You are going to delete the file ${filename}</p>
                <input id="deletion" type="submit" value="deletion" name="deletion">
            </form>`;

        var deleteBtn2 = document.getElementById('deletion');
        deleteBtn2.onclick = function(){
            event.preventDefault(); // Prevent the default form submission
            // loadContent('myloculus.php', session='del', fileID, 'loculus', 'GET');
            loadContent('../../controller/loculusoptions.php', 'deletion', fileID, 'modal-popup', 'GET');
            loadContent('myloculus.php', 'dir_id', '<?php echo $dir ?>', 'loculus', 'GET');
            // modal.style.display = "none";
        };
    }

    var shareBtn = document.getElementById('shareF');

    function shareFile(filename, fileID){
        console.log('share');
        modal.style.display = "block";
        modalP.innerHTML = `                  
        <form id="Form" action="">
            share ${filename} with:
            <input type="text" name="searchedUser" id="searchedUser">
            <input type="hidden" id="searchedUserId" name="searchedUserId">
            <input type="hidden" id="fileID" name="fileID">
            <div id="livesearchcontainer">
                
                <ul id="list"></ul>
            </div>
            <input id="shareF" type="submit" value="Send" name="shareFile">
        </form>`;


        var fID = document.getElementById('fileID');
        fID.value = fileID;

        //allow to look up for users
        livesearch();

        var shareBtn2 = document.getElementById('shareF');
        shareBtn2.onclick = function(){
            event.preventDefault(); // Prevent the default form submission
            // loadContent('myloculus.php', session='del', fileID, 'loculus', 'GET');
            loadContent('../../controller/loculusoptions.php', '', '', 'modal-popup', 'POST', "Form");
            loadContent('myloculus.php', 'dir_id', '<?php echo $dir ?>', 'loculus', 'GET');
            // modal.style.display = "none";
        };
    }


    // change theme
    function chTheme(c1, c2, c3){
        const root = document.documentElement;

        root.style.setProperty('--primarycolor', c1);
        root.style.setProperty('--secondarycolor', c2);
        root.style.setProperty('--accentcolor', c3);
    }

</script>

<script>
    
</script>
<!-- <script src="header.js"></script> -->

</html>