<?php
$page = 'view';

require_once "../../controller/controller.php";

?>

<script src=../js/header.js></script>


<body>
    
    <?php include("./header.php"); ?>


    <div id="loculus"><?php include("myloculus.php"); ?></div>
    <div id="space"><?php include("myspace.php"); ?></div>
    
    
</body>


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


    function modal_popup(option){
        //modal popup for file uploading
        const header = document.querySelector('header');
        console.log(header);
        var modal = header.querySelector("#backgrd");
        console.log(modal);
        var plus = header.querySelector("#plus");
        console.log(plus);
        var newL = header.querySelector("#newL");
        var theme = header.querySelector("#chTheme");
        var share = header.querySelector("#share");
        var del = header.querySelector("#del");
        

        document.addEventListener('click', function(event) {
            // Check if the click event is from the submit button
            console.log(event.target);
            // var eL = event.target.closest('#');
            if (event.target.type === 'submit') {
                event.preventDefault(); // Prevent the default form submission

                if (event.target.id === 'delLoculus') {
                    loadContent('../../controller/loculusoptions.php', 'delLoculus', '<?php echo $dir ?>', 'loculus', 'GET');
                    loadContent('myloculus.php', '', '', 'loculus', 'GET');
                    modal.style.display = "none";
                }else if (event.target.id === 'share') {
                    loadContent('../../controller/loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
                    loadContent('myloculus.php', 'dir_id', '<?php echo $dir ?>', 'loculus', 'GET');
                    modal.style.display = "none";
                }else if (event.target.id === 'theme') {
                    loadContent('../../controller/loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
                    loadContent('myloculus.php', 'dir_id', '<?php echo $dir ?>', 'loculus', 'GET');
                    modal.style.display = "none";
                }else if (event.target.id === 'upload') {
                    loadContent('../../controller/loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
                    loadContent('./myloculus.php', 'dir_id', '<?php echo $dir ?>', 'loculus', 'GET');
                    modal.style.display = "none";
                }else if (event.target.id === 'NewLoculus') {
                    loadContent('../../controller/loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
                    loadContent('myloculus.php', 'dir_id', '<?php echo $dir ?>', 'loculus', 'GET');
                    modal.style.display = "none";
                }
            }

        });

        if(option == "plus"){
            modal.style.display = "block";
            modal.innerHTML = `                <h3>Add new item</h3>
                    <div class="modal-popup">    
                        <form id="Form"  method="POST" enctype="multipart/form-data">
                            select file to upload:
                            <input type="file" name="toUpload" id="toUpload">
                            <input type="text" name="loculusTarget" id="loculusTarget">
                            <div id="livesearchcontainer">
                                
                                <ul id="list"></ul>
                            </div>

                            <input id="upload" type="submit" value="Upload" name="Upload">
                        </form>
                    </div>`;

            livesearch();

        }

        else if(option == "newL"){
            modal.style.display = "block";
            modal.innerHTML = `                <h3>New Loculus</h3>
                    <div class="modal-popup">    
                        <form id="Form" action="" method="POST">
                            <input type="text" name='loculusName' id="loculusName" placeholder="folder name...">
                            <input id="NewLoculus" type="submit" value="New Loculus" name="Newloculus">
                        </form>
                    </div>`;
        }

        else if(option == "chTheme"){
            modal.style.display = "block";
            modal.innerHTML = `<h3>Theme</h3>
                    <div class="modal-popup">    
                        <form id="Form" action="" method="POST" enctype="multipart/form-data">
                            Primary color:
                            <input type="color" name="c1" id="c1">
                            Secondary color:
                            <input type="color" name="c2" id="c2">
                            Accent color:
                            <input type="color" name="c3" id="c3">
                            <input onclick="chTheme(c1.value,c2.value,c3.value)" id="theme" type="submit" value="theme" name="Theme">
                        </form>`;
        }

        if(option == "share"){
            modal.style.display = "block";
            modal.innerHTML = `
                    <h3>Share loculus</h3>
                    <div class="modal-popup">    
                        <form id="Form" action="">
                            share with:
                            <select id="userRole" name="userRole" placeholder="user role">
                                <option value="admin">Admin</option>
                                <option value="standard">Standard</option>
                                <option value="guest">Guest</option>
                            </select>

                            <input type="text" name="searchedUser" id="searchedUser">
                            <input type="hidden" id="searched_user_id" name="searched_user_id">
                            <div id="livesearchcontainer">
                                
                                <ul id="list"></ul>
                            </div>
                            <input id="share" type="submit" value="Share" name="shareLoculus">
                        </form>
                </div>`;

            livesearch();
        }


        if(option == "del"){
            // loadContent('myloculus.php', 'del', 'del', 'loculus', 'GET');
            modal.style.display = "block";
            modal.innerHTML = `                <h3>Delete Loculus</h3>
                    <div class="modal-popup">    
                        <form id="Form" action="">
                            <label>Are you sure you want to delete this loculus?</label>
                            <input id="delLoculus" type="submit" value="delete loculus" name="delLoculus">
                        </form>
                    </div>`;
            // var form = document.getElementById("del");
            // // console.log(submit);
            // form.addEventListener('onclick', function(event){
            //     event.preventDefault();
            //     console.log('submit');
                
                
            // });

            
        }

        window.onclick = function (event){
            if(event.target == modal){
                modal.style.display = "none";
                // modal1.style.display = "none";
                // modal2.style.display = "none";
            }

            
        };
        

    }



    // livesearch

    function livesearch(){
        var researchedUser = document.getElementById('searchedUser');
        console.log(researchedUser);
        researchedUser.addEventListener('input', (e)=>{
            console.log("input");
            loadContent('../../controller/livesearch.php', 'receiver_name', e.target.value, 'list', 'GET');
        })
    }

    function fillsearch(username, userID){
        var researchedUser = document.getElementById('searchedUser');
        var list = document.getElementById('list');
        researchedUser.value = username;

        // Store the corresponding user_id as a data attribute in the input field
        researchedUser.setAttribute("searched_user_id", userId);

        list.innerHTML = "";
    }


    // function modal_popup(option){
    //     //modal popup for file uploading
    //     const header = document.querySelector('header');
    //     console.log(header);
    //     var modal = header.querySelector("#backgrd");
    //     console.log(modal);
    //     var plus = header.querySelector("#plus");
    //     console.log(plus);
    //     var newL = header.querySelector("#newL");
    //     var theme = header.querySelector("#chTheme");
    //     var share = header.querySelector("#share");
    //     var del = header.querySelector("#del");
        

    //     document.addEventListener('click', function(event) {
    //         // Check if the click event is from the submit button
    //         console.log(event.target);
    //         // var eL = event.target.closest('#');
    //         if (event.target.type === 'submit') {
    //             event.preventDefault(); // Prevent the default form submission

    //             if (event.target.id === 'del') {
    //                 loadContent('../../controller/loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
    //                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
    //                 modal.style.display = "none";
    //             }else if (event.target.id === 'share') {
    //                 loadContent('../../controller/loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
    //                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
    //                 modal.style.display = "none";
    //             }else if (event.target.id === 'theme') {
    //                 loadContent('../../controller/loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
    //                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
    //                 modal.style.display = "none";
    //             }else if (event.target.id === 'upload') {
    //                 loadContent('../../controller/loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
    //                 loadContent('./myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
    //                 modal.style.display = "none";
    //             }else if (event.target.id === 'NewLoculus') {
    //                 loadContent('../../controller/loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
    //                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
    //                 modal.style.display = "none";
    //             }
    //         }

    //     });

    //     if(option == "plus"){
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

    //     else if(option == "newL"){
    //         modal.style.display = "block";
    //         modal.innerHTML = `                <h3>New Loculus</h3>
    //                 <div class="modal-popup">    
    //                     <form id="Form" action="" method="POST">
    //                         <input type="text" name='loculusName' id="loculusName" placeholder="folder name...">
    //                         <input id="NewLoculus" type="submit" value="New Loculus" name="Newloculus">
    //                     </form>
    //                 </div>`;
    //     }

    //     else if(option == "chTheme"){
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

    //     if(option == "share"){
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

    //     if(option == "del"){
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
    



</script>

</html>
<script src="../js/loculus.js"></script>