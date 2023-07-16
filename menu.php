<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'authentication.php';

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $pass = $_SESSION['password'];
}else{
    header('location: index.php');
}



$page = 'menu';



if(isset($_POST["submit"])){

    $user = new user();

    // echo exec('whoami');
    $target_dir = "./Directories/";
    $target_file = $target_dir.basename($_FILES["toUpload"]["name"]);
    echo $target_file;
    // $uploadOk = 1;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    


    //check if file exist
    if (file_exists($target_file)){
        echo exec('pwd');
        echo "sorry, file already exists.";
    //     $uploadOk = 0;
    }else{
        if(move_uploaded_file($_FILES["toUpload"]["tmp_name"], $target_file)){
            $uploadtodb = $user->db->prepare("insert into resources (resource_name, type, size) values (:a, :b, :c)");
            $uploadtodb->bindParam(":a", $_FILES["toUpload"]["name"]);
            $uploadtodb->bindParam(":b", $_FILES["toUpload"]["type"]);
            $uploadtodb->bindParam(":c", $_FILES["toUpload"]["size"]);

            $uploadtodb->execute();
            echo exec('pwd');
            echo $_FILES["toUpload"]["tmp_name"]."has been uploaded";
        }
        else{
            echo "Sorry, there was an error uploading your file.";
        }
    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loculus</title>
    <script src="https://kit.fontawesome.com/766f30b49e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    

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
                            
                            if (isset($id)){

                            //   echo $id.' hi';  
                                
                                //select user_directory information
                                $statement = "select * from user_directory a inner join directories c on a.directory_id = c.directory_id where a.user_id = $id;";
                                $results = $user->manage_sql($statement);

                                if ($results->rowCount()== 0){
                                    echo "no folder";
                                }

                                

                                while($row = $results->fetch(PDO::FETCH_ASSOC)){ ?>
                                <li><a href="#loculus" onclick="reloadIframe('myloculus.php'<?php $_SESSION['dir_id']=$row['directory_id']; ?>)"> <?php echo $row['directory_name']; ?> </a></li>
                                <?php }  ?>
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
                        <li><a href="#" id="newL"><i class="fa-solid fa-folder-plus"></i>New loculus</a></li>
                        <!-- <li><a href="#"><i class="fa-solid fa-share-nodes"></i>share</a></li>
                        <li><a href="#"><i class="fa-solid fa-trash-can"></i>delete</a></li> -->
                        <li><a href="#" id="chTheme"><i class="fa-solid fa-moon"></i>theme</a></li>
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
                            <a href="menu.php?logout=logout"><i class="fa-solid fa-right-from-bracket"></i></a>
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

            <!-- new loculus -->
            <div id="backgrd1">
                <h3>New Loculus</h3>
                <div class="modal-popup">    
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="input" name='loculusName' id="loculusName" placeholder="folder name...">
                        <input type="submit" value="New Loculus" name="submit">
                    </form>
                </div>
            </div>

            <div id="backgrd2">
                <h3>Theme</h3>
                <div class="modal-popup">    
                    <form action="" method="POST" enctype="multipart/form-data">
                        select colors:
                        <input type="submit" value="theme" name="submit">
                    </form>
                </div>
            </div>

    </header>


    
    <iframe src="./myloculus.php" id="loculus"></iframe>

    

    <iframe src="./myspace.php" id="space"></iframe>
    
</body>


<script>

// open menu

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
            // console.log(c);
            // console.log(c.contains(b));

            // close previous menu when another one is opened
            if(c != b && c.contains(b) == false){
                c.classList.remove('active');
                prevMenu = c.querySelector('.objects');
                prevContainer = c.querySelector('.objects > .popup-container');
                prevMenu.classList.remove('active');
                prevContainer.classList.remove('active');
            }
        });

        
        // console.log(menu.getBoundingClientRect());
        // console.log(window.innerHeight);

        var menuRect = menu.getBoundingClientRect();
        var viewport = window.innerWidth;

        //reposition the menu div whenever it exceeds the viewport width
        if(menuRect.x + menuRect.right >= viewport){
            menu.style.right = "10px";
            // console.log(menuRect.x);

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



<script >
    //search on page 'my space'
    
    var iframe2 = document.getElementById('space');
    var iframe1 = document.getElementById('loculus');
    var obj = iframe1.contentWindow.document.querySelectorAll('.obj');
    var bar = document.getElementById("bar");

//search for a window in workshop
    iframe2.addEventListener('load', ()=>{
        var obj = iframe2.contentWindow.document.querySelectorAll('.obj');
        var bar = document.getElementById("bar");

        bar.addEventListener('keyup', (e)=>{
        
            const data = e.target.value.toLowerCase();
            console.log(data);
            

            obj.forEach(w => {
                if (w.textContent.toLowerCase().includes(data)){

                    w.style.display = "block";
                    obj.forEach(c => {
                        c.style.zIndex = "1";
                    });

                    w.style.zIndex = "5";

                }
                else{
                    w.style.display = "none";
                }
            })

        })
    })

// search for a file in directory
    iframe1.addEventListener('load', ()=>{
        var obj = iframe1.contentWindow.document.querySelectorAll('.container');
        var bar = document.getElementById("bar");
 
        bar.addEventListener('keyup', (e)=>{
        
            const data = e.target.value.toLowerCase();
            
            console.log(obj);
            obj.forEach(w => {
                console.log(w.textContent);
                if (w.textContent.toLowerCase().includes(data)){

                    w.style.display = "flex";
                }
                else{
                    w.style.display = "none";
                }
        })

    })
    })


    

</script>



<script>
// to open new window in workshop

function loadTemplate(source, dirname) {
  fetch('windowTemplate.php')
    .then(response => response.text())
    .then(html => {
        var iframe2 = document.getElementById('space');
        const container = iframe2.contentWindow.document.querySelector('spacecontainer');


        const obj = iframe2.contentWindow.document.createElement('.obj');
        
        container.innerHTML += html;
      
        // Extract the content from the fetched HTML
        var nestedFrame = container.querySelector('iframe').src;
        var frameTitle = container.querySelector('h6').innerHTML;
        
        // Replace the content of the element in the frame
        nestedFrame = source;
        frameTitle = title;
    })
    .catch(error => {
      console.log('Error loading template:', error);
    });
}


</script>


<script>
    //fills the workshop windows list
    var iframe2 = document.getElementById('space');
    var wp = document.querySelector('#workshop');    
    var menu = wp.querySelector('.popup-container');
    
    //onclick
    wp.addEventListener('click', ()=>{
        menu.innerHTML = '';
        const container = iframe2.contentWindow.document.querySelector('.spacecontainer');
        var obj1 = iframe2.contentWindow.document.querySelectorAll('.obj');
        // console.log(iframe2);
        // console.log(container);
        // console.log(obj1);

        //loop through obj and add their name to the menu
    
        obj1.forEach(w=>{
        
            var frameTitle = w.querySelector('h6').textContent;
            // console.log(w);
            var listItem = document.createElement('li');
            item = document.createElement('a');

            item.href = '#space';
            item.textContent = frameTitle;

            menu.appendChild(listItem);
            listItem.appendChild(item);

            // position the frame on the center of the page
            item.addEventListener('click', ()=>{
                offsetTop = iframe2.contentWindow.window.scrollY;
                // console.log(offsetTop);
                obj1.forEach(c=>{
                    c.style.zIndex = '1';
                })
                    // console.log('start');
                    w.style.left = '35%';
                    w.style.top = `${offsetTop+100}px`;
                    w.style.zIndex = '5';
            })


        })

        // console.log("content =" + menu.innerHTML);

        if (menu.innerHTML == ""){
            menu.innerHTML = "Empty Workshop";
        }
    })
</script>


<script>
    //modal popup for file uploading
    var modal = document.getElementById("backgrd");
    var modal1 = document.getElementById("backgrd1");
    var modal2 = document.getElementById("backgrd2");
    var plus = document.getElementById("plus");
    var newL = document.getElementById("newL");
    var theme = document.getElementById("chTheme");

    plus.onclick = function (){
        modal.style.display = "block";
    }

    newL.onclick = function (){
        modal1.style.display = "block";
    }

    theme.onclick = function (){
        modal2.style.display = "block";
    }

    window.onclick = function (event){
        if(event.target == modal || event.target == modal1 || event.target == modal2){
            modal.style.display = "none";
            modal1.style.display = "none";
            modal2.style.display = "none";
        }
    }
    


</script>

<script>
    //open searchbar on screen width<765
    btn = document.querySelectorAll('.btn');
    sc = document.getElementById('searchcontainer');
    var bar = document.getElementById("bar");
    sc.onclick = function(){
        // console.log(sc);
        sc.classList.toggle('on');
        bar.focus();
        btn.forEach(b => {b.classList.toggle('off')});
        

    }
</script>

<script>
    var directory_name = '';
    function reloadIframe(link) {
      // Get the reference to the iframe element
        var iframe1 = document.getElementById('loculus');

        
        // console.log(iframe1);
      // Refresh the iframe by setting its source to the current source
        iframe1.src = link;
        // const doc = iframe1.contentWindow.document.var;
        // console.log("doc is:"+doc);


    }
</script>


<script>
    // opens a file in the workspace
    function openFile(path, filename, type){
        const container = iframe2.contentWindow.document.querySelector('.spacecontainer');
        var iframe2 = document.getElementById('space');
        var iframe1 = document.getElementById('loculus');
        var obj = iframe2.contentWindow.document.querySelectorAll('.obj');
        var bar = document.getElementById("bar");

        if(type == "txt"){
            container.innerHTML += `<div class='obj'>
                                        <div class='objbar up'>
                                            <h6>${filename}</h6>
                                            <span><i class='fa-solid fa-close'></i></span>
                                        </div>
                                        <textarea id='myTextarea'></textarea>
                                        <input type='file' name='' id='inputFile'>

                                        <br>
                                    </div>`
            
        }else if(type == "mp4"){
            container.innerHTML += `<div class='obj'>
                                        <div class='objbar up'>
                                            <h6>${filename}</h6>
                                            <span><i class='fa-solid fa-close'></i></span>
                                        </div>
                                        <video src="${path}" controls></video>

                                        <br>
                                    </div>`
            
        }else{
            container.innerHTML += `<div class='obj'>
                                        <div class='objbar up'>
                                            <h6>${filename}</h6>
                                            <span><i class='fa-solid fa-close'></i></span>
                                        </div>
                                        <iframe src="${path}" frameborder="0"></iframe>

                                        <br>
                                    </div>`
            
        }
    }
</script>
</html>