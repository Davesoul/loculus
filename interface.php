<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'authentication.php';

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $pass = $_SESSION['password'];
}else{
    header('location: index.php');
}



$page = 'menu';


// upload new file
if(isset($_POST["Upload"])){

    // $user = new user();

    // echo exec('whoami');
    if(isset($_SESSION['dir_path'])){
        $target_dir = '.'.$_SESSION['dir_path'].'/';    
    };
    // $target_dir = "./Directories/";
    echo $target_dir;
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
            //insert into resources
            $uploadtodb = $user->db->prepare("insert into resources (resource_name, type, size) values (:a, :b, :c)");
            $uploadtodb->bindParam(":a", $_FILES["toUpload"]["name"]);
            $uploadtodb->bindParam(":b", $_FILES["toUpload"]["type"]);
            $uploadtodb->bindParam(":c", $_FILES["toUpload"]["size"]);

            $uploadtodb->execute();

            //insert into directory_resource
            $lastID = $user->db->prepare('select last_insert_id()');

            $uploadtodb = $user->db->prepare("insert into directory_resource (directory_id, resource_id) values (:a, :b)");
            $uploadtodb->bindParam(":a", $_SESSION['dir_id']);
            $uploadtodb->bindParam(":b", $lastID);
            

            $uploadtodb->execute();
            echo exec('pwd');
            echo $_FILES["toUpload"]["tmp_name"]."has been uploaded";
        }
        else{
            echo "Sorry, there was an error uploading your file.";
        }
    }

}

// create new loculus(folder)
if(isset($_POST['Newloculus'])){
    $path = '.'.$_SESSION['dir_path'].'/'.$_POST['loculusName'];
    
    if(mkdir($path, 0777, true)){
        //insert into directories
        $uploadtodb = $user->db->prepare("insert into directories (directory_name, path) values (:a, :b)");
        $uploadtodb->bindParam(":a", $_POST['loculusName']);
        $uploadtodb->bindParam(":b", $path);
        $uploadtodb->execute();

        $lastID = $user->db->prepare('select last_insert_id()');

        //insert into user_directory
        $uploadtodb = $user->db->prepare("insert into user_directory (user_id, directory_id, permission_id) values (:a, :b, :c)");
        $uploadtodb->bindParam(":a", $id);
        $uploadtodb->bindParam(":b", $lastID);
        $uploadtodb->bindParam(":c", 1);
        $uploadtodb->execute();

    } else if (mkdir($path, 0777, false)){
        echo "folder already created";
    } else {
        echo "failed to create folder";
    }

    
}

// set theme
if(isset($_POST['theme'])){}


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
                                <li><a href="#loculus" onclick="loadContent('myloculus.php', <?php echo $row['directory_id']; ?>, 'loculus')"> 
                                <?php if($username==$row['directory_name']){echo 'home';}else{echo $row['directory_name'];} ?> 
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
                        <input type="submit" value="Upload" name="Upload">
                    </form>
                </div>
            </div>

            <!-- new loculus -->
            <div id="backgrd1">
                <h3>New Loculus</h3>
                <div class="modal-popup">    
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="input" name='loculusName' id="loculusName" placeholder="folder name...">
                        <input type="submit" value="New Loculus" name="Newloculus">
                    </form>
                </div>
            </div>

            <div id="backgrd2">
                <h3>Theme</h3>
                <div class="modal-popup">    
                    <form action="" method="POST" enctype="multipart/form-data">
                        Primary color:
                        <input type="color" name="" id="">
                        Secondary color:
                        <input type="color" name="" id="">
                        Accent color:
                        <input type="color" name="" id="">
                        <input type="submit" value="theme" name="Theme">
                    </form>
                </div>
            </div>

    </header>


    <div id="loculus"><?php include("myloculus.php"); ?></div>
    <div id="space"><?php include("myspace.php"); ?></div>
    
    
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
    //search for files and windows in search bar
    
    var workshop = document.getElementById('space');
    var loculus = document.getElementById('loculus');
    var bar = document.getElementById("bar");

//search for a window in workshop

    var obj = workshop.querySelectorAll('.obj');

    bar.addEventListener('keyup', (e)=>{
    
        const data = e.target.value.toLowerCase();

        obj.forEach(w => {
            if (w.textContent.toLowerCase().includes(data)){
                console.log(w.textContent);
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


// search for a file in directory


    // var cont = loculus.querySelectorAll('.container');
    // var bar = document.getElementById("bar");

    // bar.addEventListener('keyup', (e)=>{
    
    //     const data = e.target.value.toLowerCase();
        
    //     cont.forEach(w => {
    //         if (w.textContent.toLowerCase().includes(data)){
    //             console.log(w.textContent);

    //             w.style.display = "flex";
    //         }
    //         else{
    //             w.style.display = "none";
    //         }
    //     })

    // })


    var cont = loculus.getElementsByClassName("container");
    var info = loculus.getElementsByClassName("smalldescription");
    

    bar.addEventListener('keyup', (e)=>{
        const data = e.target.value.toLowerCase();
        console.log(data);
        console.log(info);
        for(i=0; i<cont.length; i++){
            console.log(info[i].textcontent);
            if(info[i].textContent.toLowerCase().includes(data)){

                cont[i].style.display = "flex"
            }
            else{
                cont[i].style.display = "none"
            }
        }
    })

    

</script>



<script>
// to open new window in workshop

function loadTemplate(source, dirname) {
  fetch('windowTemplate.php')
    .then(response => response.text())
    .then(html => {
        var workshop = document.getElementById('space');
        const container = workshop.contentWindow.document.querySelector('spacecontainer');


        const obj = workshop.contentWindow.document.createElement('.obj');
        
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
    // var workshop = document.getElementById('space');
    var wp = document.querySelector('#workshop');    
    var wpmenu = wp.querySelector('.popup-container');
    
    //onclick
    wp.addEventListener('click', ()=>{
        wpmenu.innerHTML = '';
        const container = workshop.querySelector('.spacecontainer');
        var obj1 = workshop.querySelectorAll('.obj');

        //loop through obj and add their name to the menu
    
        obj1.forEach(w=>{
        
            var frameTitle = w.querySelector('h6').textContent;
            // console.log(w);
            var listItem = document.createElement('li');
            item = document.createElement('a');

            item.href = '#space';
            item.textContent = frameTitle;

            wpmenu.appendChild(listItem);
            listItem.appendChild(item);

            // position the frame on the center of the page
            item.addEventListener('click', ()=>{
                offsetTop = workshop.scrollY;
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

        if (wpmenu.innerHTML == ""){
            wpmenu.innerHTML = "Empty Workshop";
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
        var workshop = document.getElementById('space');
        const container = workshop.querySelector('.spacecontainer');
    
        // var obj = workshop.querySelectorAll('.obj');
    
        // var file = new File(['file data'], 'file.txt', { type: 'text/plain' });

        console.log('yosha');
        if(type.includes("text")){

            var obj = document.createElement('div');
            obj.classList.add('obj');

            const objBar = document.createElement('div');
            objBar.classList.add('objbar', 'up');

            const h6 = document.createElement('h6');
            h6.textContent = filename;

            const span = document.createElement('span');
            span.innerHTML = '<i class="fa-solid fa-close"></i>';
            span.addEventListener('click', () => {
                obj.remove();
            });

            objBar.appendChild(h6);
            objBar.appendChild(span);

            const textarea = document.createElement('textarea');
            textarea.id = 'myTextarea';

            obj.appendChild(objBar);
            obj.appendChild(textarea);

            container.appendChild(obj);

            
            obj = workshop.querySelectorAll('.obj');

            obj.forEach(w => {
                var bar = w.querySelector('.objbar');
                var close = w.querySelector('span');
                let prevActive;


                close.addEventListener('click', ()=>{
                    w.remove();
                });

                w.addEventListener('mousedown', ()=>{


                    console.log('start');
                    // all frames on the same stack
                    obj.forEach(c => {
                        if(c.style.zIndex == 5){
                            c.style.zIndex = "2";
                        }else{
                            c.style.zIndex = "1";
                        }
                    });

                    // selected frame on top of stack
                    w.style.zIndex = "5";

                });


                bar.addEventListener('mousedown', (e)=>{

                    
                    // e.stopPropagation();
                
                    
                    w.style.opacity = 0.6;
                    


                    var menuRect = w.getBoundingClientRect();
                    var viewport = w.innerWidth;

                    var x = event.clientX - w.offsetLeft;
                    var y = event.clientY - w.offsetTop;


                    //reposition the frame div whenever it exceeds the viewport width
                    if(menuRect.x + menuRect.right >= viewport){
                        w.style.right = "10px";
                    }

                    // mouse coordinates minus the initial offset

                    const moveObj = (e) => {


                        w.style.position = "absolute";

                        w.style.left = `${event.clientX - x}px`;
                        
                        w.style.top = `${event.clientY - y}px`;
                    





                    };

                    document.addEventListener("mousemove", moveObj);

                    bar.addEventListener("mouseup", ()=>{
                    
                    document.removeEventListener("mousemove", moveObj);
                    w.style.opacity = 1;
                    
                    
                    // objBarr.style.position = "relative";
                    })
                    body.addEventListener("mouseleave", ()=>{
                        
                        document.removeEventListener("mousemove", moveObj);
                        w.style.opacity = 1;
                        
                        // objBarr.style.position = "relative";
                    })
                

                


                });


                w.addEventListener('touchstart', ()=>{

                    obj.forEach(c => {
                        c.style.zIndex = "1";
                    });

                    w.style.zIndex = "5";


                });

                bar.addEventListener('touchstart', (e)=>{



                    // e.stopPropagation();


                    w.style.opacity = 0.6;

                    var menuRect = w.getBoundingClientRect();
                    var viewport = w.innerWidth;

                    var x = event.touches[0].clientX - w.offsetLeft;
                    var y = event.touches[0].clientY - w.offsetTop;


                    // touch coordinates minus the initial offset

                    const moveObj = (e) => {

                        w.style.position = "absolute";

                        w.style.left = `${event.touches[0].clientX - x}px`;

                        w.style.top = `${event.touches[0].clientY - y}px`;





                    };


                    e.preventDefault();
                    document.addEventListener("touchmove", moveObj);

                    bar.addEventListener("touchend", ()=>{

                        document.removeEventListener("touchmove", moveObj);
                        w.style.opacity = 1;

                    // objBarr.style.position = "relative";
                    })

                    body.addEventListener("mouseleave", ()=>{
                        
                        document.removeEventListener("touchmove", moveObj);
                        w.style.opacity = 1;
                        // objBarr.style.position = "relative";
                    })


                });
            });
            
            fetch(path + '/' + filename)
            .then(response => response.text())
            .then(contents => {
                // const container = workshop.querySelector('.spacecontainer');
                textarea.textContent = contents;
            })

            
            .catch(error => {
            console.error("Error fetching file:", error);
            })

            
        }
    }
</script>



<script>
    //manipulate iframe on mouse events
    const body = document.querySelector('body');
    


    // console.log(obj);
    function moveFrame(){

        obj.forEach(w => {
            var obj = document.querySelectorAll('.obj');
            var bar = w.querySelector('.objbar');
            var close = w.querySelector('span');
            let prevActive;


            close.addEventListener('click', ()=>{
                w.remove();
            });

            w.addEventListener('mousedown', ()=>{


                console.log('start');
                // all frames on the same stack
                obj.forEach(c => {
                    if(c.style.zIndex == 5){
                        c.style.zIndex = "2";
                    }else{
                        c.style.zIndex = "1";
                    }
                });

                // selected frame on top of stack
                w.style.zIndex = "5";

            });


            bar.addEventListener('mousedown', (e)=>{

                
                // e.stopPropagation();
            
                
                w.style.opacity = 0.6;
                


                var menuRect = w.getBoundingClientRect();
                var viewport = w.innerWidth;

                var x = event.clientX - w.offsetLeft;
                var y = event.clientY - w.offsetTop;


                //reposition the frame div whenever it exceeds the viewport width
                if(menuRect.x + menuRect.right >= viewport){
                    w.style.right = "10px";
                }

                // mouse coordinates minus the initial offset

                const moveObj = (e) => {


                    w.style.position = "absolute";

                    w.style.left = `${event.clientX - x}px`;
                    
                    w.style.top = `${event.clientY - y}px`;
                





                };

                document.addEventListener("mousemove", moveObj);

                bar.addEventListener("mouseup", ()=>{
                
                document.removeEventListener("mousemove", moveObj);
                w.style.opacity = 1;
                
                
                // objBarr.style.position = "relative";
                })
                body.addEventListener("mouseleave", ()=>{
                    
                    document.removeEventListener("mousemove", moveObj);
                    w.style.opacity = 1;
                    
                    // objBarr.style.position = "relative";
                })
            

            


            });

            w.addEventListener('touchstart', ()=>{

                obj.forEach(c => {
                    c.style.zIndex = "1";
                });

                w.style.zIndex = "5";


            });

            bar.addEventListener('touchstart', (e)=>{



                // e.stopPropagation();


                w.style.opacity = 0.6;

                var menuRect = w.getBoundingClientRect();
                var viewport = w.innerWidth;

                var x = event.touches[0].clientX - w.offsetLeft;
                var y = event.touches[0].clientY - w.offsetTop;


                // touch coordinates minus the initial offset

                const moveObj = (e) => {

                    w.style.position = "absolute";

                    w.style.left = `${event.touches[0].clientX - x}px`;
                
                    w.style.top = `${event.touches[0].clientY - y}px`;

                };


                e.preventDefault();
                document.addEventListener("touchmove", moveObj);

                bar.addEventListener("touchend", ()=>{

                    document.removeEventListener("touchmove", moveObj);
                    w.style.opacity = 1;

                // objBarr.style.position = "relative";
                })

                body.addEventListener("mouseleave", ()=>{
                    
                    document.removeEventListener("touchmove", moveObj);
                    w.style.opacity = 1;
                    // objBarr.style.position = "relative";
                })





            });
                    
        });
    }
    moveFrame();
</script>

<!-- <script>
    //manipulate iframe on touchscreen events

    var obj = document.querySelectorAll('.obj');

    var frame = document.querySelectorAll('.obj iframe');


    obj.forEach(w => {
        var bar = w.querySelector('.objbar');
        
        


            w.addEventListener('touchstart', ()=>{

                obj.forEach(c => {
                    c.style.zIndex = "1";
                });

                w.style.zIndex = "5";
 

            });

            bar.addEventListener('touchstart', (e)=>{

                

                // e.stopPropagation();
            
                
                w.style.opacity = 0.6;
            
                var menuRect = w.getBoundingClientRect();
                var viewport = w.innerWidth;

                var x = event.touches[0].clientX - w.offsetLeft;
                var y = event.touches[0].clientY - w.offsetTop;
            

                // mouse coordinates minus the initial offset

                const moveObj = (e) => {

                    w.style.position = "absolute";

                    w.style.left = `${event.touches[0].clientX - x}px`;
                   
                    w.style.top = `${event.touches[0].clientY - y}px`;
                  




                };


                e.preventDefault();
                document.addEventListener("touchmove", moveObj);

                bar.addEventListener("touchend", ()=>{
                
                document.removeEventListener("touchmove", moveObj);
                w.style.opacity = 1;
                
                // objBarr.style.position = "relative";
                })
                body.addEventListener("mouseleave", ()=>{
                    
                    document.removeEventListener("touchmove", moveObj);
                    w.style.opacity = 1;
                    // objBarr.style.position = "relative";
                })
            

            


            });
        });
</script> -->


<script>
    // ajax
    function loadContent(page, get, target){
        console.log("start");
        var req = new XMLHttpRequest();

        // header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: GET, POST');
        // header('Access-Control-Allow-Headers: Content-Type');

        var t = document.getElementById(target);
        
        // req.setRequestHeader('Content-Type','text/plain');

        req.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
            
                // var response = JSON.parse(req.responseText);

                t.innerHTML = req.responseText;
                //console.log(response);
                console.log(req.responseText);
            } else {
                console.log('invalid request');
            }
            
        };

        req.open('GET', page+'?dir_id='+get, true);
        // req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        req.send();
    };

    

</script>



</html>