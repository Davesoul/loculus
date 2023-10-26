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
if (isset($_GET["dir_id"])){
    // echo $_GET["dir_id"];
    echo $dir;
    echo "DIRECTORY";
    $stmt = "SELECT * FROM resources a join directories c on c.directory_id = a.directory_id where c.directory_id = $dir";
}else if (isset($id)){
    $stmt = "SELECT * FROM resources a join directories c on c.directory_id = a.directory_id where c.directory_name = 'user_$id'";
}



if(isset($_SESSION['perm_id'])){
    $perm_id = $_SESSION['perm_id'];

    
}


// echo "dir_id: ".$_SESSION['dir_id'];
// echo "dir_path: ".$_SESSION['dir_path'];
// echo $dir_name;
// echo $_SESSION['dir_path'];


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
   
    <div class="gap" id="loculusTop"></div>

    <div class="big-container">

        <?php
        
        
                $results = $user->manage_sql($stmt);
    

                ?>

                <div class="gap"></div>
                <h1><?php if($_SESSION['dir_name'] == "user_$id"){
                    echo "Home";
                } else {echo $_SESSION['dir_name'];} ?></h1>
                <div class="gap"></div>

                <?php
                if ($results->rowCount()== 0){
                    
                    ?>
                    <!-- <center>Empty folder</center>  -->
                    <center><i class="fa-solid fa-folder-open"></i></center>
                    <?php
                }
            
                
             ?>
             
                <div class="loculuscontainer">

                    <?php while($row = $results->fetch(PDO::FETCH_ASSOC)){ ?>

                    <div class="container">
                        <div class="iconcontainer">
                            <?php if (stripos($row["type"], "pdf") !== false){ ?>
                                <i class="fa-solid fa-file-pdf"></i>

                            <?php } elseif (stripos($row["type"], "image") !== false){ 
                                
                                if ($row['resource_thumbnail'] != NULL) {?>
                                    <img src="<?php echo '../'.$row['resource_thumbnail']; ?>" alt="">
                                <?php }else{ ?>

                                    <i class="fa-solid fa-file-image"></i>

                                <?php } ?>

                            <?php } elseif (stripos($row["type"], "audio") !== false){ ?>
                                <i class="fa-solid fa-file-audio"></i>

                            <?php } elseif (stripos($row["type"], "video") !== false){

                                if ($row['resource_thumbnail'] != NULL) {?>
                                    <video src="<?php echo '../'.$row['resource_thumbnail']; ?>" autoplay muted loop>

                                <?php }else{ ?>

                                    <i class="fa-solid fa-file-video"></i>

                                <?php } ?>

                            <?php } elseif (stripos($row["type"], "text") !== false || stripos($row["type"], "application") !== false){

                                if ($row['resource_thumbnail'] != NULL) {?>
                                    <img src="<?php echo '../'.$row['resource_thumbnail']; ?>" alt="">

                                <?php }else{ ?>

                                    <i class="fa-solid fa-file-lines"></i>

                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="itemcontainer">                
                            <div class="smalldescription">
                                <h4><?php echo $row["resource_name"];?></h4>
                                <p><?php echo $row["type"];?></p>
                                <p><?php echo $row["size"]." MB"; ?></p>
                                <p><?php echo $row["resource_creation_date"];?></p>
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



<script>
 
    
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


</script>

<script>
    
</script>
<!-- <script src="header.js"></script> -->

</html>