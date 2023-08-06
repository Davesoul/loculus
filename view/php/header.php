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
                                <li><a href="#loculus" onclick="
                                
                                loadContent('../../controller/checkPermission.php', 'dir_id', <?php echo $row['directory_id']; ?>, 'loculusoptions', 'GET');
                                loadContent('myloculus.php', 'dir_id', <?php echo $row['directory_id']; ?>, 'loculus', 'GET');
                            
                            
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
                <?php include("../../controller/checkPermission.php"); ?>
            </div>

            
            <!-- </div> -->

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
                            <a href="view.php?logout=logout"><i class="fa-solid fa-right-from-bracket"></i></a>
                        </div>

                    </div>
                </div>
            </div>





            <!-- file import -->
            <div class="background" id="backgrd">
                <h3>Add new item</h3>
                <div class="modal-popup">    
                    <form action="" method="POST" enctype="multipart/form-data">
                        select file to upload:
                        <input type="file" name="toUpload" id="toUpload">
                        <input type="submit" value="Upload" name="Upload">
                    </form>
                </div>
            </div>

            <!-- new loculus -->
            <!-- <div class="background" id="backgrd1">
                <h3>New Loculus</h3>
                <div class="modal-popup">    
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="input" name='loculusName' id="loculusName" placeholder="folder name...">
                        <input type="submit" value="New Loculus" name="Newloculus">
                    </form>
                </div>
            </div>

            <div class="background" id="backgrd2">
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

            <div class="background" id="">
                <h3>Share loculus</h3>
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

            <div class="background" id="">
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
            </div> -->


            
    </header>


                            </body>
                            </html>




                            <script>
//                                 var btn = document.querySelectorAll('.btn');

// console.log(btn);
// btn.forEach(b => {
//     b.addEventListener('click', (e)=>{
//         e.stopPropagation();
//         console.log(b);
//         var menu = b.querySelector('.objects');
//         var container = b.querySelector('.objects > .popup-container');
//         console.log(container);

//         btn.forEach(c => {
//             // console.log(c);
//             // console.log(c.contains(b));

//             // close previous menu when another one is opened
//             if(c != b && c.contains(b) == false){
//                 c.classList.remove('active');
//                 prevMenu = c.querySelector('.objects');
//                 prevContainer = c.querySelector('.objects > .popup-container');
//                 prevMenu.classList.remove('active');
//                 prevContainer.classList.remove('active');
//             }
//         });

        
//         // console.log(menu.getBoundingClientRect());
//         // console.log(window.innerHeight);

//         var menuRect = menu.getBoundingClientRect();
//         var viewport = window.innerWidth;

//         //reposition the menu div whenever it exceeds the viewport width
//         if(menuRect.x + menuRect.right >= viewport){
//             menu.style.right = "10px";
//             // console.log(menuRect.x);

//             var menuRect = menu.getBoundingClientRect();

//             if(menuRect.x < 0){
                
//                 menu.style.left = "10px";
//                 console.log(menuRect.x);
//         }
//         }

//         b.classList.toggle('active');
//         menu.classList.toggle('active');
//         container.classList.toggle('active');

        

//     });
// });

                            </script>

                            <script>
    // opens a file in the workspace
    // function openFile(path, filename, type){
    //     // var workshop = document.getElementById('space');
    //     // const container = workshop.querySelector('.spacecontainer');

    //     console.log('opening '+ filename);
    //     const container = workshop.querySelector('.spacecontainer');

    //     // create the frame elements
    //     var obj = document.createElement('div');
    //     obj.classList.add('obj');

    //     const objBar = document.createElement('div');
    //     objBar.classList.add('objbar', 'up');

    //     const title = document.createElement('div');
    //     title.classList.add('titleContainer');

    //     const h6 = document.createElement('h6');
    //     h6.textContent = filename;

    //     title.append(h6);

    //     const span = document.createElement('span');

    //     span.innerHTML = '<i class="fa-solid fa-close"></i>';

    //     // span.addEventListener('click', () => {
    //     //     obj.remove();
    //     // });

    //     objBar.appendChild(title);
    //     objBar.appendChild(span);

    //     obj.style.zIndex = 6;
    //     obj.style.top = "35%";
    //     obj.style.left = "35%";

    //     console.log('open file');
    //     if(type.includes("text") || type.includes("application") && !type.includes("pdf")  && !type.includes("php")){

    //         el = 'textarea';
    //         const e = document.createElement(el);
        

    //         obj.appendChild(objBar);
    //         obj.appendChild(e);

    //         container.appendChild(obj);

    //         fetch(path + '/' + filename)
    //         .then(response => response.text())
    //         .then(contents => {
                
    //             e.textContent = contents;
    //         })

            
    //         .catch(error => {
    //         console.error("Error fetching file:", error);
    //         })

            
    //     } else if (type.includes("image")){

    //         el = 'img';
    //         const e = document.createElement(el);
        

    //         obj.appendChild(objBar);
    //         obj.appendChild(e);

    //         container.appendChild(obj);

    //         e.src = path + '/' + filename;

    //         // fetch(path + '/' + filename)
    //         // .then(response => response.text())
    //         // .then(contents => {
                
    //         //     e.src = contents;
    //         // })

            
    //         // .catch(error => {
    //         // console.error("Error fetching file:", error);
    //         // })

            
    //         // obj = workshop.querySelectorAll('.obj');

            
    //         // obj.forEach(w => {
    //         //     var bar = w.querySelector('.objbar');
    //         //     var close = w.querySelector('span');
    //         //     let prevActive;


    //         //     close.addEventListener('click', ()=>{
    //         //         w.remove();
    //         //     });

    //         //     w.addEventListener('mousedown', ()=>{


    //         //         console.log('start');
    //         //         // all frames on the same stack
    //         //         obj.forEach(c => {
    //         //             if(c.style.zIndex == 5){
    //         //                 c.style.zIndex = "2";
    //         //             }else{
    //         //                 c.style.zIndex = "1";
    //         //             }
    //         //         });

    //         //         // selected frame on top of stack
    //         //         w.style.zIndex = "5";

    //         //     });


    //         //     bar.addEventListener('mousedown', (e)=>{

                    
    //         //         // e.stopPropagation();
                
                    
    //         //         w.style.opacity = 0.6;
                    


    //         //         var menuRect = w.getBoundingClientRect();
    //         //         var viewport = w.innerWidth;

    //         //         var x = event.clientX - w.offsetLeft;
    //         //         var y = event.clientY - w.offsetTop;


    //         //         //reposition the frame div whenever it exceeds the viewport width
    //         //         if(menuRect.x + menuRect.right >= viewport){
    //         //             w.style.right = "10px";
    //         //         }

    //         //         // mouse coordinates minus the initial offset

    //         //         const moveObj = (e) => {


    //         //             w.style.position = "absolute";

    //         //             w.style.left = `${event.clientX - x}px`;
                        
    //         //             w.style.top = `${event.clientY - y}px`;
                    





    //         //         };

    //         //         document.addEventListener("mousemove", moveObj);

    //         //         bar.addEventListener("mouseup", ()=>{
                    
    //         //         document.removeEventListener("mousemove", moveObj);
    //         //         w.style.opacity = 1;
                    
                    
    //         //         // objBarr.style.position = "relative";
    //         //         })
    //         //         body.addEventListener("mouseleave", ()=>{
                        
    //         //             document.removeEventListener("mousemove", moveObj);
    //         //             w.style.opacity = 1;
                        
    //         //             // objBarr.style.position = "relative";
    //         //         })
                

                


    //         //     });


    //         //     w.addEventListener('touchstart', ()=>{

    //         //         obj.forEach(c => {
    //         //             c.style.zIndex = "1";
    //         //         });

    //         //         w.style.zIndex = "5";


    //         //     });

    //         //     bar.addEventListener('touchstart', (e)=>{



    //         //         // e.stopPropagation();


    //         //         w.style.opacity = 0.6;

    //         //         var menuRect = w.getBoundingClientRect();
    //         //         var viewport = w.innerWidth;

    //         //         var x = event.touches[0].clientX - w.offsetLeft;
    //         //         var y = event.touches[0].clientY - w.offsetTop;


    //         //         // touch coordinates minus the initial offset

    //         //         const moveObj = (e) => {

    //         //             w.style.position = "absolute";

    //         //             w.style.left = `${event.touches[0].clientX - x}px`;

    //         //             w.style.top = `${event.touches[0].clientY - y}px`;





    //         //         };


    //         //         e.preventDefault();
    //         //         document.addEventListener("touchmove", moveObj);

    //         //         bar.addEventListener("touchend", ()=>{

    //         //             document.removeEventListener("touchmove", moveObj);
    //         //             w.style.opacity = 1;

    //         //         // objBarr.style.position = "relative";
    //         //         })

    //         //         body.addEventListener("mouseleave", ()=>{
                        
    //         //             document.removeEventListener("touchmove", moveObj);
    //         //             w.style.opacity = 1;
    //         //             // objBarr.style.position = "relative";
    //         //         })


    //         //     });
    //         // });
    //     // } else if (type.includes("video")){

    //     } else {
    //         el = 'iframe';
    //         const e = document.createElement(el);
        

    //         obj.appendChild(objBar);
    //         obj.appendChild(e);

    //         container.appendChild(obj);
    //         e.src = path + '/' + filename;
    //     }

    //     moveFrame();
    //     onPageSearch();
    // }



    // opt(d_id){
    //     if (d_id == )
    // }

    // solves the directory section overflowing in workshop
    // window.addEventListener('resize', ()=>{
    //     console.log("resize");
    //     if (window.location.hash == "#space"){
    //         window.location.hash = "#space";
    //     }
        
    // });



/**
* modal popups
*/


    




    

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

