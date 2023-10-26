<?php
require_once("../../controller/controller.php");

// echo "this is ".$_SESSION['dir_id'];

// var_dump($_SESSION);

// if(isset($_SESSION['id'])){
//     $id = $_SESSION['id'];
//     $username = $_SESSION['username'];
//     $email = $_SESSION['email'];.
//     $pass = $_SESSION['password'];
// }else{
//     header('location: login.php');
// }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loculus</title>
    <script src="https://kit.fontawesome.com/766f30b49e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    

    <!-- <script src=header.js></script> -->
    <style>
        html{
            overflow: hidden;
        }
    </style>
</head>
<body>


    <header>
        <div id="checkperm">
            <?php include("../../controller/checkPermission.php"); ?>
        </div>
            <div id="menu" class="btn">
                <i class="fa-solid fa-bars"></i>
                    
                <div class="objects" id="aside" >
                    <div class="objbar up" ></div>

                    <div class="popup-container">
                        <div class="menu-i btn" id="dir"   > <i class="fa-solid fa-sitemap"></i><span>directory</span>

                        
                            <div class="objects obj2" id="objects"  onclick=event.stopPropagation()>
                                <div class="objbar up"></div>
                                <div class="popup-container">

                                    <?php
                                    
                                    if (isset($id)){

                                    //   echo $id.' hi';  
                                        
                                        //select user_directory information
                                        $statement = "select * from user_directory a inner join directories c on a.directory_id = c.directory_id where a.user_id = $id;";
                                        $results = $user->manage_sql($statement);

                                        if ($results->rowCount()== 0){
                                            echo "no folder";
                                            header("location: interface.php");
                                        }

                                        

                                        while($row = $results->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <li><a href="#loculusTop" onclick="
                                        setTimeout(function(){
                                                                            
                                        loadContent('../../controller/checkPermission.php', 'dir_id', <?php echo $row['directory_id']; ?>, 'checkperm', 'GET');
                                        loadContent('../../controller/options.php', 'dir_id', <?php echo $row['directory_id']; ?>, 'loculusoptions', 'GET');

                                        loadContent('myloculus.php', 'dir_id', <?php echo $row['directory_id']; ?>, 'loculus', 'GET');
                                    
                                    
                                        }, 100);
                                        "> 
                                        <?php if("user_$id"==$row['directory_name']){echo "Home";}else{echo $row['directory_name'];} ?> 
                                        </a></li>
                                        <?php }  ?>
                                    <?php }  ?>
                                    
                                </div>
                                <div class="objbar down"></div>
                            </div>

                            
                        </div>

                        
                    
                        <div class="menu-i btn" id="workshop" ><i class="fa-solid fa-clone"></i></i><span>workshop</span>
                                                
                            <div class="objects obj2" id="windowList" onclick=event.stopPropagation()>
                                <div class="objbar up"></div>
                                <div class="popup-container">
                                    
                                </div>
                                <div class="objbar down"></div>
                            </div>
                    
                        </div>
                    </div>

                    <div class="objbar down"></div>
                </div>
        
            </div>

            

            <h1>Loculus</h1>


            <div class="searchcontainer" id="searchcontainer">
                <div id="searchbtn"><i class="fa-solid fa-magnifying-glass"></i></div>
                <form action="" id="sForm"><input type="text" name="" id="bar" placeholder="search..." onclick=event.stopPropagation></form>
            </div>


            <?php if (isset($_SESSION["perm_id"])){ ?> <?php } ?>
            <div id="loculusoptions">
                <?php include("../../controller/options.php"); ?>
            </div>

            
            <!-- </div> -->

            <div id="user-img" class="btn">
                <img id='pp' src="../<?php echo $_SESSION['pp']; ?>" alt="profile picuture">
                <div id="user-card" class="objects">
                    <div class="popup-container">
                    
                        <img src="../<?php echo $_SESSION['pp']; ?>" alt="">
                        <div class="details">
                            <?php if (isset($username)){ ?>
                                <span> <?php echo $username; ?> </span>
                                <span> <?php echo $email; ?> </span>
                            <?php } ?>
                            
                        </div>
                        <div class="social-media">
                            <i class="fa-brands fa-github"></i>
                            <i class="fa-brands fa-twitter"></i>
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                        <div class="card-i">
                            <i class="fa-solid fa-edit"></i>
                            <i class="fa-solid fa-gift" onclick="showTransfers()" id="transferIcon"></i>
                            <a href="view.php?logout=logout"><i class="fa-solid fa-right-from-bracket"></i></a>
                        </div>

                    </div>
                </div>
            </div>



<!--  -->

            <!-- file import -->
            <div class="background" id="backgrd">
                <div id="modal-popup">    
                    <form action="" method="POST" enctype="multipart/form-data">
                        select file to upload:
                        <input type="file" name="toUpload" id="toUpload">
                        <input type="submit" value="Upload" name="Upload">
                    </form>
                </div>
            </div>


            
    </header>


                            </body>
                            </html>




                            <script>
    
    

    // livesearch

    function livesearch(){
        var loculusTarget = document.getElementById('loculusTarget');
        console.log(loculusTarget);
        loculusTarget.addEventListener('input', (e)=>{
            console.log("input");
            loadContent('livesearch.php', '', '', 'list', 'GET');
        })
    }

</script>

