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

// echo $_GET['dir_id'];

$page = 'menu';


// // upload new file
// if(isset($_POST["Upload"])){

//     // $user = new user();

//     echo exec('whoami');
//     if(isset($_SESSION['dir_path'])){
//         $target_dir = '.'.$_SESSION['dir_path'].'/';    
//     };
//     // $target_dir = "./Directories/";
//     echo $target_dir;
//     $target_file = $target_dir.basename($_FILES["toUpload"]["name"]);
//     echo $target_file;
//     // $uploadOk = 1;
//     $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    


//     //check if file exist
//     if (file_exists($target_file)){
//         echo exec('pwd');
//         echo "sorry, file already exists.";
//     //     $uploadOk = 0;
//     }else{
//         if(move_uploaded_file($_FILES["toUpload"]["tmp_name"], $target_file)){
//             //insert into resources
//             $uploadtodb = $user->db->prepare("insert into resources (resource_name, type, size) values (:a, :b, :c)");
//             $uploadtodb->bindParam(":a", $_FILES["toUpload"]["name"]);
//             $uploadtodb->bindParam(":b", $_FILES["toUpload"]["type"]);
//             $uploadtodb->bindParam(":c", $_FILES["toUpload"]["size"]);

//             $uploadtodb->execute();

//             //insert into directory_resource
//             $lastID = $user->db->prepare('select last_insert_id()');
//             $lastID->execute();
//             $row = $lastID->fetch(PDO::FETCH_ASSOC);

//             $uploadtodb = $user->db->prepare("insert into directory_resource (directory_id, resource_id) values (:a, :b)");
//             $uploadtodb->bindParam(":a", $_SESSION['dir_id']);
//             $uploadtodb->bindParam(":b", $row['last_insert_id()']);
            

//             $uploadtodb->execute();
//             echo exec('pwd');
//             echo $_FILES["toUpload"]["tmp_name"]."has been uploaded";
//         }
//         else{
//             echo "Sorry, there was an error uploading your file.";
//         }
//     }

// }

// // create new loculus(folder)
// if(isset($_POST['Newloculus'])){
//     $path = '.'.$_SESSION['dir_path'].'/'.$_POST['loculusName'];
    
//     if(mkdir($path, 0777, true)){
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

//     } else if (mkdir($path, 0777, false)){
//         echo "folder already created";
//     } else {
//         echo "failed to create folder";
//     }

    
// }

// // transfer file
// if(isset($_POST['share'])){}

// // set theme
// if(isset($_POST['theme'])){}

// // delete
// if(isset($_GET['del'])){
//     alert('are you sure?');
// }
// include ("checkPermission.php");


?>


<body>
    <!-- <div id="wholeheader"> -->
        <?php include("./header.php"); ?>

    <!-- </div> -->



    <div id="loculus"><?php include("myloculus.php"); ?></div>
    <div id="space"><?php include("myspace.php"); ?></div>
    
    
</body>


<script>

// open menu

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



<script >
//     //search for files and windows in search bar
// function onPageSearch(){
//     var workshop = document.getElementById('space');
//     var loculus = document.getElementById('loculus');
//     var bar = document.getElementById("bar");

//     //search for a window in workshop

//     var obj = workshop.querySelectorAll('.obj');

//     bar.addEventListener('keyup', (e)=>{
    
//         const data = e.target.value.toLowerCase();

//         obj.forEach(w => {
//             if (w.textContent.toLowerCase().includes(data)){
//                 console.log(w.textContent);
//                 w.style.display = "block";
//                 obj.forEach(c => {
//                     c.style.zIndex = "1";
//                 });

//                 w.style.zIndex = "5";

//             }
//             else{
//                 w.style.display = "none";
//             }
//         })

//     })



//     // search for a file in directory

//     var cont = loculus.getElementsByClassName("container");
//     var info = loculus.getElementsByClassName("smalldescription");
    

//     bar.addEventListener('keyup', (e)=>{
//         const data = e.target.value.toLowerCase();
//         console.log(data);
//         console.log(info);
//         for(i=0; i<cont.length; i++){
//             console.log(info[i].textcontent);
//             if(info[i].textContent.toLowerCase().includes(data)){

//                 cont[i].style.display = "flex"
//             }
//             else{
//                 cont[i].style.display = "none"
//             }
//         }
//     })

// }




    // onPageSearch();

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

</script>


<script>

            

</script>

<script>

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
    


    // console.log(obj);

    function appendToWorkshop(el, path, filename, type){
        const container = workshop.querySelector('.spacecontainer');
        var obj = document.createElement('div');
        obj.classList.add('obj');

        const objBar = document.createElement('div');
        objBar.classList.add('objbar', 'up');

        const h6 = document.createElement('h6');
        h6.textContent = filename;

        const span = document.createElement('span');

        span.innerHTML = '<i class="fa-solid fa-close"></i>';

        // span.addEventListener('click', () => {
        //     obj.remove();
        // });

        objBar.appendChild(h6);
        objBar.appendChild(span);

        const e = document.createElement(el);
        

        obj.appendChild(objBar);
        obj.appendChild(e);

        container.appendChild(obj);

        moveFrame();

        

        fetch(path + '/' + filename)
        .then(response => response.text())
        .then(contents => {
            
            e.textContent = contents;
        })

        
        .catch(error => {
        console.error("Error fetching file:", error);
        })


    }

function adjustTextForElements(elements) {
  elements.forEach((elem) => {
    const textElem = elem.querySelector('h4');
    const lineHeight = parseInt(window.getComputedStyle(textElem).lineHeight);
    const maxHeight = 3 * lineHeight; // Adjust the number of lines (e.g., 3 lines)

    if (textElem.offsetHeight > maxHeight) {
      let words = textElem.innerText.split(' ');
      textElem.innerText = '';
      let currentLine = '';
      words.forEach((word) => {
        const testLine = currentLine + word + ' ';
        if (textElem.scrollHeight > maxHeight && currentLine !== '') {
          textElem.innerText += currentLine.trim() + '\n';
          currentLine = word + ' ';
        } else {
          currentLine = testLine;
        }
      });
      textElem.innerText += currentLine.trim();
    }
  });
}

window.addEventListener('load', () => {
  const elements = Array.from(document.querySelectorAll('.smalldescription'));
  adjustTextForElements(elements);
});

window.addEventListener('resize', () => {
  const elements = Array.from(document.querySelectorAll('.smalldescription'));
  adjustTextForElements(elements);
});

</script>


<script>

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
    function loadContent(page, session='', val='', target, method, formId=''){
    console.log("start");
    var req = new XMLHttpRequest();

    var t = document.getElementById(target);

    if (session == ''){
        link = page;
    } else {
        link = page + '?' + session + '=' + val;
    }

    console.log(link);
    req.open(method, link, true);

    req.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            t.innerHTML = req.responseText;
            console.log(req.responseText);
        } else {
            console.log('invalid request');
        }
    };

    if (formId != '' && method === 'POST'){
        const form = document.getElementById(formId);
        var formData = new FormData(form);

        // req.onreadystatechange = function() {
        //     if (this.readyState == 4 && this.status == 200){
        //         t.innerHTML = req.responseText;
        //         console.log(req.responseText);
        //     } else {
        //         console.log('invalid request');
        //     }
        // };

        req.send(formData);
    } else {
        req.send();
    }
};




// function modal_popup(){
//     //modal popup for file uploading
//     const header = document.querySelector('header');
//     console.log(header);
//     var modal = document.getElementById("backgrd");
//     var plus = document.getElementById("plus");
//     var newL = document.getElementById("newL");
//     var theme = document.getElementById("chTheme");
//     var share = document.getElementById("share");
//     var del = document.getElementById("del");
    

//     document.addEventListener('click', function(event) {
//         // Check if the click event is from the submit button
//         console.log(event.target);
//         // var eL = event.target.closest('#');
//         if (event.target.type === 'submit') {
//             event.preventDefault(); // Prevent the default form submission

//             if (event.target.id === 'del') {
//                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
//                 modal.style.display = "none";
//             }else if (event.target.id === 'share') {
//                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
//                 modal.style.display = "none";
//             }else if (event.target.id === 'theme') {
//                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
//                 modal.style.display = "none";
//             }else if (event.target.id === 'upload') {
//                 loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
//                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
//                 // post('plusForm');
//                 modal.style.display = "none";
//             }else if (event.target.id === 'NewLoculus') {
//                 loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
//                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
//                 modal.style.display = "none";
//             }
//         }

//     });

//     plus.onclick = function (){
//         modal.style.display = "block";
//         modal.innerHTML = `                <h3>Add new item</h3>
//                 <div class="modal-popup">    
//                     <form id="Form" action="myloculus.php"  method="POST" enctype="multipart/form-data">
//                         select file to upload:
//                         <input type="file" name="toUpload" id="toUpload">
//                         <input type="text" name="loculusTarget" id="loculusTarget">
//                         <div id="livesearchcontainer">
                            
//                             <ul id="list"></ul>
//                         </div>

//                         <input id="upload" type="submit" value="Upload" name="Upload">
//                     </form>
//                 </div>`;

//         livesearch();

//     }

//     newL.onclick = function (){
//         modal.style.display = "block";
//         modal.innerHTML = `                <h3>New Loculus</h3>
//                 <div class="modal-popup">    
//                     <form id="Form" action="" method="POST">
//                         <input type="text" name='loculusName' id="loculusName" placeholder="folder name...">
//                         <input id="NewLoculus" type="submit" value="New Loculus" name="Newloculus">
//                     </form>
//                 </div>`;
//     }

//     theme.onclick = function (){
//         modal.style.display = "block";
//         modal.innerHTML = `<h3>Theme</h3>
//                 <div class="modal-popup">    
//                     <form action="" method="POST" enctype="multipart/form-data">
//                         Primary color:
//                         <input type="color" name="" id="">
//                         Secondary color:
//                         <input type="color" name="" id="">
//                         Accent color:
//                         <input type="color" name="" id="">
//                         <input id="theme" type="submit" value="theme" name="Theme">
//                     </form>`;
//     }

//     share.onclick = function (){
//         modal.style.display = "block";
//         modal.innerHTML = `
//                 <h3>Share loculus</h3>
//                 <div class="modal-popup">    
//                     <form action="" method="POST" enctype="multipart/form-data">
//                         share with:
//                         <input type="text" name="shareLoculus" id="shareLoculus">
//                         <input id="share" type="submit" value="Upload" name="Upload">
//                     </form>
//             </div>`;
//     }

//     del.onclick = function (){
//         // loadContent('myloculus.php', 'del', 'del', 'loculus', 'GET');
//         modal.style.display = "block";
//         modal.innerHTML = `                <h3>Delete Loculus</h3>
//                 <div class="modal-popup">    
//                     <form action="" >
//                         <label>Are you sure you want to delete this loculus?</label>
//                         <input id="del" type="submit" value="delete loculus">
//                     </form>
//                 </div>`;
//         // var form = document.getElementById("del");
//         // // console.log(submit);
//         // form.addEventListener('onclick', function(event){
//         //     event.preventDefault();
//         //     console.log('submit');
            
            
//         // });

        
//     }

//     window.onclick = function (event){
//         if(event.target == modal){
//             modal.style.display = "none";
//             // modal1.style.display = "none";
//             // modal2.style.display = "none";
//         }
//     };
    

// }

// modal_popup();

    

// function post(formId){
//     const form = document.getElementById(formId);


//   const formData = new FormData(form); // Create a FormData object from the form

//   // Perform Ajax request to the server
//   fetch('myloculus.php', {
//     method: 'POST',
//     body: formData, // Pass the FormData object as the request body
//   })
//     .then((response) => console.log(response.json()))
//     .then((data) => {
//       // Handle the server response
//       console.log(data);
//     })
//     .catch((error) => {
//       // Handle any errors that occurred during the fetch request
//       console.error('Error:', error);
//     });

// }
</script>


<script>
    /**
 * search for files and frames with search bar
 */

//search for files and windows in search bar
function onPageSearch(){
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

}

onPageSearch();
</script>

<script>


    var deleteBtn = document.getElementById('delete');
    var modal = document.getElementById("backgrd");
    function deleteFile(filename, fileID){
        console.log('delete');
        modal.style.display = "block";
        modal.innerHTML = `                
        <div class="modal-popup">    
            <form action="" method="POST">
                <i class="fa-solid fa-trash-can"></i>
                <p>You are going to delete the file ${filename}</p>
                <input id="deletion" type="submit" value="deletion" name="deletion">
            </form>
        </div>`;

        var deleteBtn2 = document.getElementById('deletion');
        deleteBtn2.onclick = function(){
            loadContent('myloculus.php', session='del', fileID, 'loculus', 'GET');
            modal.style.display = "none";
        };
    }



    /**
    * move frame & open files
    */

    function moveFrame(){
        const body = document.querySelector("body");
        var obj = document.querySelectorAll('.obj');
        obj.forEach(w => {
            
            var bar = w.querySelector('.objbar');
            var close = w.querySelector('span');
            let prevActive;


            close.addEventListener('click', ()=>{
                w.remove();
            });

            w.addEventListener('mouseenter', ()=>{


                console.log('start');
                // all frames on the same stack
                obj.forEach(c => {
                    if(c.style.zIndex == 5){
                        c.style.zIndex = "4";
                        c.style.boxShadow = '0px 5px 1px 0px rgba(0, 0, 0, 0.5)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }else if(c.style.zIndex == 4){
                        c.style.zIndex = "2";
                        c.style.boxShadow = '0px 5px 10px 0px rgba(0, 0, 0, 0.5)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }else{
                        c.style.zIndex = "1";
                        c.style.boxShadow = '0px 5px 10px 0px rgba(0, 0, 0, 0.5)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }
                });

                // selected frame on top of stack
                
                w.style.zIndex = "5";
                w.style.boxShadow = '0px 10px 15px 0px rgba(0, 0, 0, 0.5)';
                w.style.border = 'solid 2px var(--secondarycolor)';

            });


            bar.addEventListener('mousedown', (e)=>{

                
                // e.stopPropagation();
            
                
                w.style.opacity = 0.6;
                


                var menuRect = w.getBoundingClientRect();
                var viewport = w.innerWidth;

                var x = e.clientX - w.offsetLeft;
                var y = e.clientY - w.offsetTop;


                //reposition the frame div whenever it exceeds the viewport width
                if(menuRect.x + menuRect.right >= viewport){
                    w.style.right = "10px";
                }

                // mouse coordinates minus the initial offset

                const moveObj = (e) => {


                    w.style.position = "absolute";

                    w.style.left = `${e.clientX - x}px`;
                    
                    w.style.top = `${e.clientY - y}px`;
                





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

                console.log("touchstart");
                obj.forEach(c => {
                    console.log(c);
                    console.log("zindex: " + c.style.zIndex);
                    if(c.style.zIndex == 5){
                        c.style.zIndex = "4";
                        c.style.boxShadow = '0px 5px 1px 0px rgba(0, 0, 0, 0.5)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }else if(c.style.zIndex == 4){
                        c.style.zIndex = "2";
                        c.style.boxShadow = '0px 5px 10px 0px rgba(0, 0, 0, 0.5)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }else{
                        c.style.zIndex = "1";
                        c.style.boxShadow = '0px 5px 10px 0px rgba(0, 0, 0, 0.5)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }
                });

                w.style.zIndex = '5';
                w.style.boxShadow = '0px 10px 15px 0px rgba(0, 0, 0, 0.5)';
                w.style.border = 'solid 2px var(--secondarycolor)';
            });

            bar.addEventListener('touchstart', (e)=>{



                // e.stopPropagation();


                w.style.opacity = 0.6;

                var menuRect = w.getBoundingClientRect();
                var viewport = w.innerWidth;

                var x = e.touches[0].clientX - w.offsetLeft;
                var y = e.touches[0].clientY - w.offsetTop;


                // touch coordinates minus the initial offset

                const moveObj = (e) => {

                    w.style.position = "absolute";

                    w.style.left = `${e.touches[0].clientX - x}px`;
                
                    w.style.top = `${e.touches[0].clientY - y}px`;

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

    // opens a file in the workspace
    function openFile(path, filename, type){
        var workshop = document.getElementById('space');
        // const container = workshop.querySelector('.spacecontainer');
        console.log("workshop");
        console.log('opening '+ filename);
        var container = workshop.querySelector('.spacecontainer');

        
        // create the frame elements
        var obj = document.createElement('div');
        obj.classList.add('obj');

        const objBar = document.createElement('div');
        objBar.classList.add('objbar', 'up');

        const title = document.createElement('div');
        title.classList.add('titleContainer');

        const h6 = document.createElement('h6');
        h6.textContent = filename;

        title.append(h6);

        const span = document.createElement('span');

        span.innerHTML = '<i class="fa-solid fa-close"></i>';

        // span.addEventListener('click', () => {
        //     obj.remove();
        // });

        objBar.appendChild(title);
        objBar.appendChild(span);

        obj.style.zIndex = 6;
        obj.style.top = "35%";
        obj.style.left = "35%";

        console.log('open file');
        
        if(type.includes("text") || type.includes("application") && !type.includes("pdf")  && !type.includes("php")){

            el = 'textarea';
            const e = document.createElement(el);
        

            obj.appendChild(objBar);
            obj.appendChild(e);

            container.appendChild(obj);

            fetch(path + '/' + filename)
            .then(response => response.text())
            .then(contents => {
                
                e.textContent = contents;
            })

            
            .catch(error => {
            console.error("Error fetching file:", error);
            })

            
        } else if (type.includes("image")){

            el = 'img';
            const e = document.createElement(el);
        

            obj.appendChild(objBar);
            obj.appendChild(e);

            container.appendChild(obj);

            e.src = path + '/' + filename;

            // fetch(path + '/' + filename)
            // .then(response => response.text())
            // .then(contents => {
                
            //     e.src = contents;
            // })

            
            // .catch(error => {
            // console.error("Error fetching file:", error);
            // })

            
            // obj = workshop.querySelectorAll('.obj');

            
            // obj.forEach(w => {
            //     var bar = w.querySelector('.objbar');
            //     var close = w.querySelector('span');
            //     let prevActive;


            //     close.addEventListener('click', ()=>{
            //         w.remove();
            //     });

            //     w.addEventListener('mousedown', ()=>{


            //         console.log('start');
            //         // all frames on the same stack
            //         obj.forEach(c => {
            //             if(c.style.zIndex == 5){
            //                 c.style.zIndex = "2";
            //             }else{
            //                 c.style.zIndex = "1";
            //             }
            //         });

            //         // selected frame on top of stack
            //         w.style.zIndex = "5";

            //     });


            //     bar.addEventListener('mousedown', (e)=>{

                    
            //         // e.stopPropagation();
                
                    
            //         w.style.opacity = 0.6;
                    


            //         var menuRect = w.getBoundingClientRect();
            //         var viewport = w.innerWidth;

            //         var x = event.clientX - w.offsetLeft;
            //         var y = event.clientY - w.offsetTop;


            //         //reposition the frame div whenever it exceeds the viewport width
            //         if(menuRect.x + menuRect.right >= viewport){
            //             w.style.right = "10px";
            //         }

            //         // mouse coordinates minus the initial offset

            //         const moveObj = (e) => {


            //             w.style.position = "absolute";

            //             w.style.left = `${event.clientX - x}px`;
                        
            //             w.style.top = `${event.clientY - y}px`;
                    





            //         };

            //         document.addEventListener("mousemove", moveObj);

            //         bar.addEventListener("mouseup", ()=>{
                    
            //         document.removeEventListener("mousemove", moveObj);
            //         w.style.opacity = 1;
                    
                    
            //         // objBarr.style.position = "relative";
            //         })
            //         body.addEventListener("mouseleave", ()=>{
                        
            //             document.removeEventListener("mousemove", moveObj);
            //             w.style.opacity = 1;
                        
            //             // objBarr.style.position = "relative";
            //         })
                

                


            //     });


            //     w.addEventListener('touchstart', ()=>{

            //         obj.forEach(c => {
            //             c.style.zIndex = "1";
            //         });

            //         w.style.zIndex = "5";


            //     });

            //     bar.addEventListener('touchstart', (e)=>{



            //         // e.stopPropagation();


            //         w.style.opacity = 0.6;

            //         var menuRect = w.getBoundingClientRect();
            //         var viewport = w.innerWidth;

            //         var x = event.touches[0].clientX - w.offsetLeft;
            //         var y = event.touches[0].clientY - w.offsetTop;


            //         // touch coordinates minus the initial offset

            //         const moveObj = (e) => {

            //             w.style.position = "absolute";

            //             w.style.left = `${event.touches[0].clientX - x}px`;

            //             w.style.top = `${event.touches[0].clientY - y}px`;





            //         };


            //         e.preventDefault();
            //         document.addEventListener("touchmove", moveObj);

            //         bar.addEventListener("touchend", ()=>{

            //             document.removeEventListener("touchmove", moveObj);
            //             w.style.opacity = 1;

            //         // objBarr.style.position = "relative";
            //         })

            //         body.addEventListener("mouseleave", ()=>{
                        
            //             document.removeEventListener("touchmove", moveObj);
            //             w.style.opacity = 1;
            //             // objBarr.style.position = "relative";
            //         })


            //     });
            // });
        // } else if (type.includes("video")){

        } else {
            el = 'iframe';
            const e = document.createElement(el);
        

            obj.appendChild(objBar);
            obj.appendChild(e);

            container.appendChild(obj);
            e.src = path + '/' + filename;
        }

        moveFrame();
        onPageSearch();
    }



    



</script>

</html>

<!-- <script src="loculus.js"></script> -->