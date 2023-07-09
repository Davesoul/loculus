<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'authentication.php';

// if(isset($_SESSION['id'])){
//     $id = $_SESSION['id'];
//     $username = $_SESSION['username'];
//     $email = $_SESSION['email'];
//     $pass = $_SESSION['password'];
// }else{
//     header('location: index.php');
// }

$page = 'gui';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/766f30b49e.js" crossorigin="anonymous"></script>
    <script src="loculus.js"></script>
    <style>
        html{
            overflow: hidden;
        }
    </style>

</head>

<body>
    <header>
            <div id="menu" class="btn">
                <i class="fa-solid fa-bars"></i>
                    
                <div class="objects" id="aside" onclick=event.stopImmediatePropagation() onfocus="event.stopImmediatePropagation()">
                    <div class="objbar up" ></div>

                    <div class="popup-container">
                        <div class="menu-i btn" id="dir"   > <i class="fa-solid fa-sitemap"></i><span>directory</span>

                        
                        <div class="objects obj2" id="objects"  onclick=event.stopPropagation()>
                            <div class="objbar up"></div>
                            <div class="popup-container">

                            <?php
                            
                            // if (isset($ids)){

                            //   echo $id.' hi';  
                                
                                //select user_directory information
                                $statement = "select * from user_directory a inner join directories c on a.directory_id = c.directory_id where a.user_id = $id;";
                                $results = $user->manage_sql($statement);

                                if ($results->rowCount()== 0){
                                    echo "no folder";
                                }

                                ?>

                                <?php while($row = $results->fetch(PDO::FETCH_ASSOC)){ ?>
                                <li><a href="#loculus" onclick="loadPage('loculus', 'myloculus.php?dir_id=<?php echo $row['directory_id']; ?>')"> <?php echo $row['directory_name']; ?> </a></li>
                                <?php }  ?>
                                
                            </div>
                            <div class="objbar down"></div>

                            
                        </div>

                        
                    </div>
                    
                        <div class="menu-i btn" id="workshop" <?php if ($page=="myspace"){echo "style=background:#eee; href=\"#\"";}else{} ?> ><i class="fa-solid fa-clone"></i></i><span>workshop</span>
                                                
                            <div class="objects obj2" id="windowList" onclick=event.stopPropagation()>
                                <div class="objbar up"></div>
                                <div class="popup-container">
                                    <li><a href="#space">ohayou</a></li>
                                    <li><a href="#space">konichiwa</a></li>
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
                <i class="fa-solid fa-magnifying-glass"></i>
                <form action=""><input type="text" name="" id="bar" placeholder="search..." onclick=event.stopPropagation></form>
            </div>



            <div id="more-options" class="btn">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                <div id="options-menu" class="objects">
                    <div class="objbar up"></div>
                    <ul class="popup-container">
                        <li><a href="#" id="plus"><i class="fa-solid fa-plus"></i>Import</a></li>
                        <li><a href="#"><i class="fa-solid fa-folder-plus"></i>New loculus</a></li>
                        <!-- <li><a href="#"><i class="fa-solid fa-share-nodes"></i>share</a></li>
                        <li><a href="#"><i class="fa-solid fa-trash-can"></i>delete</a></li> -->
                        <li><a href="#"><i class="fa-solid fa-moon"></i>theme</a></li>
                        <!-- <li><a href="#"><i class="fa-solid fa-gear"></i>settings</a></li> -->
                    </ul>
                    <div class="objbar down"></div>
                </div>
            </div>

            <div id="user-img" class="btn">
                <img src="image/default.jpg" alt="">
                <div id="user-card" class="objects">
                    <div class="popup-container">
                    
                        <img src="image/default.jpg" alt="">
                        <div class="details">
                            <span> <?php echo $username; ?> </span>
                            <span> <?php echo $email; ?> </span>
                            
                        </div>
                        <div class="social-media">
                            <i class="fa-brands fa-github"></i>
                            <i class="fa-brands fa-twitter"></i>
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                        <div class="card-i">
                            <i class="fa-solid fa-edit"></i>
                            <a href="#"><i class="fa-solid fa-right-from-bracket"></i></a>
                        </div>

                    </div>
                </div>
            </div>


            <!-- file import -->
            <div id="backgrd">
                <h3>Add new item</h3>
                <div class="modal-popup">    
                    <form action="" method="POST" enctype="multipart/form-data">
                        select file to upload:
                        <input type="file" name=toUpload id="toUpload">
                        <input type="submit" value="Upload" name="submit">
                    </form>
                </div>
            </div>

            <!-- <div id="backgrd1">
                <h3>Add new item</h3>
                <div class="modal-popup">    
                    <form action="" method="POST" enctype="multipart/form-data">
                        select file to upload:
                        <input type="file" name=toUpload id="toUpload">
                        <input type="submit" value="Upload" name="submit">
                    </form>
                </div>
            </div>

            <div id="backgrd1">
                <h3>Add new item</h3>
                <div class="modal-popup">    
                    <form action="" method="POST" enctype="multipart/form-data">
                        select file to upload:
                        <input type="file" name=toUpload id="toUpload">
                        <input type="submit" value="Upload" name="submit">
                    </form>
                </div>
            </div>

            <div id="backgrd1">
                <h3>Add new item</h3>
                <div class="modal-popup">    
                    <form action="" method="POST" enctype="multipart/form-data">
                        select file to upload:
                        <input type="file" name=toUpload id="toUpload">
                        <input type="submit" value="Upload" name="submit">
                    </form>
                </div>
            </div> -->
    </header>


    <div class="template" id="loculus"></div>
    <div class="template" id="space"></div>


    
</body>


<script>
    function loadPage(id, file){
        let xhttp;
        let el = document.getElementById(id);
        console.log(el);
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function (){
            if (this.readyState == 4){
                if (this.status == 200){
                    el.innerHTML = this.responseText;
                    console.log(el.innerHTML);
                }
                if (this.status == 404){
                    console.log(this.status);
                    el.innerHTML = '<h1>Page Not Found<h1>';
                }
            }
        }
        xhttp.open('GET', file, true);
        xhttp.send();
        return;
    }

    document.onload = loadPage('loculus', 'myloculus.php');
    document.onload = loadPage('space', 'myspace.php');
</script>

<!-- 
<script>

var btn = document.querySelectorAll('.btn');

console.log(btn);
btn.forEach(b => {
    b.addEventListener('click', (e)=>{
        e.stopPropagation();
        console.log(b);
        var menu = b.querySelector('.objects');
        var container = b.querySelector('.objects > .popup-container');
        console.log(container);

        btn.forEach(c => {
            console.log(c);
            console.log(c.contains(b));
            if(c != b && c.contains(b) == false){
                c.classList.remove('active');
                prevMenu = c.querySelector('.objects');
                prevContainer = c.querySelector('.objects > .popup-container');
                prevMenu.classList.remove('active');
                prevContainer.classList.remove('active');
            }
        });

        
        console.log(menu.getBoundingClientRect());
        console.log(window.innerHeight);

        var menuRect = menu.getBoundingClientRect();
        var viewport = window.innerWidth;

        //reposition the menu div whenever it exceeds the viewport width
        if(menuRect.x + menuRect.right >= viewport){
            menu.style.right = "10px";
            console.log(menuRect.x);

            var menuRect = menu.getBoundingClientRect();

            if(menuRect.x < 0){
                
                menu.style.left = "10px";
                console.log(menuRect.x);
        }
        }

        b.classList.toggle('active');
        menu.classList.toggle('active');
        container.classList.toggle('active');

        

    });
});

</script>





<script>
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
    
</script>

<script>
    //open searchbar on screen<765
    btn = document.querySelectorAll('.btn');
    sc = document.getElementById('searchcontainer');
    sc.onclick = function(){
        console.log(sc);
        sc.classList.toggle('on');
        btn.forEach(b => {b.classList.toggle('off')});
        

    }
</script> -->

</html>