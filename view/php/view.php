<?php
$page = 'view';

require_once "../../controller/controller.php";

?>

<script src=../js/header.js>

</script>

<?php
        // if (isset($_SESSION['c1'])){
        //     echo "<script> chTheme('".$_SESSION['c1']."','".$_SESSION['c2']."','".$_SESSION['c3']."'); </script>";
        // }
    ?>


<body>
    
    <?php include("./header.php"); ?>


    <div id="loculus"><?php include("myloculus.php"); ?></div>
    <div id="space"><?php include("myspace.php"); ?></div>
    
    
</body>


<script>
    // change theme
    function chTheme(c1, c2, c3){
    const root = document.documentElement;

    root.style.setProperty('--primarycolor', c1);
    root.style.setProperty('--secondarycolor', c2);
    root.style.setProperty('--accentcolor', c3);
    }

    chTheme('<?php echo $_SESSION['c1'] ?>', '<?php echo $_SESSION['c2'] ?>', '<?php echo $_SESSION['c3'] ?>');

    
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
// chTheme(<?php echo $_SESSION['c1']; ?>,<?php echo $_SESSION['c2']; ?>,<?php echo $_SESSION['c3'] ?>)

    // ajax
function loadContent(page, session='', val='', targetID="", method, formId='', targetEl=''){
    console.log("start");
    var req = new XMLHttpRequest();

    if (targetID != ""){
        var t = document.getElementById(targetID);
    }

    if (session == ''){
        link = page;
    } else {
        link = page + '?' + session + '=' + val;
    }

    console.log(link);
    req.open(method, link, true);

    req.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if (t){
                t.innerHTML = req.responseText;
            }else{
                console.log(req.responseText);
                console.log(targetEl);
                console.log(targetEl.texContent);
                targetEl.textContent = req.responseText;
            }
            console.log(req.responseText);
        } else {
            console.log('invalid request');
        }
    };

    if (formId != '' && method === 'POST'){
        const form = document.getElementById(formId);

        console.log('sending form...');

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

    
    }else {
        req.send();
    }
}
;


function updateFile(page, filename, content) {
    console.log("start");
    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Handle the response here, e.g., update the content of an element with the response.
            // You can also add more logic based on the response, such as error handling.
            console.log(req.responseText);
        } else {
            console.log('Invalid request');
        }
    };

    // Create a FormData object to send the filename and content as POST data.
    var formData = new FormData();
    formData.append('fileName', filename);
    formData.append('content', content);

    // Open a POST request to the specified page.
    req.open('POST', page, true);

    // Send the FormData object as the request body.
    req.send(formData);
}


function acceptTransfer(page, transferID, acceptance) {
    console.log("start");
    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Handle the response here, e.g., update the content of an element with the response.
            // You can also add more logic based on the response, such as error handling.
            console.log(req.responseText);
        } else {
            console.log('Invalid request');
        }
    };

    // Create a FormData object to send the filename and content as POST data.
    var formData = new FormData();
    formData.append('transferID', transferID);
    formData.append('acceptance', acceptance);

    // Open a POST request to the specified page.
    req.open('POST', page, true);

    // Send the FormData object as the request body.
    req.send(formData);
}


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
                var fname = w.querySelector('h6').textContent;
                console.log(fname);
                if(fname.endsWith("*")){
                    // Remove the asterisk (*) from the end of the string
                    console.log('trying to save');
                    
                    fname = fname.replace(/\*$/, "");
                    console.log('saving');

                    var txtarea = w.querySelector('.obj textarea');

                    // console.log(txtarea.value);
                    // console.log(fname);

                    
                    updateFile('../../controller/update_file.php', fname, txtarea.value);

                    w.remove();

                }else{
                    console.log('closing');

                    w.remove();
                }
            });

            w.addEventListener('mouseenter', ()=>{


                console.log('start');
                // all frames on the same stack
                obj.forEach(c => {
                    if(c.style.zIndex == 5){
                        c.style.zIndex = "4";
                        c.style.boxShadow = '0px 5px 1px 0px rgba(0,0,0,0)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }else if(c.style.zIndex == 4){
                        c.style.zIndex = "2";
                        c.style.boxShadow = '0px 5px 10px 0px rgba(0,0,0,0)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }else{
                        c.style.zIndex = "1";
                        c.style.boxShadow = '0px 5px 10px 0px rgba(0,0,0,0)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }
                });

                // selected frame on top of stack
                
                w.style.zIndex = "5";
                w.style.boxShadow = '0px 10px 15px 0px rgba(0,0,0,0.5)';
                w.style.border = 'solid 2px var(--secondarycolor)';

            });


            bar.addEventListener('mousedown', (e)=>{

                // obj.forEach(o => {o.removeEventListener('mouseenter');});
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
                        c.style.boxShadow = '0px 5px 1px 0px rgba(0,0,0,0)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }else if(c.style.zIndex == 4){
                        c.style.zIndex = "2";
                        c.style.boxShadow = '0px 5px 10px 0px rgba(0,0,0,0)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }else{
                        c.style.zIndex = "1";
                        c.style.boxShadow = '0px 5px 10px 0px rgba(0,0,0,0)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }
                });

                w.style.zIndex = '5';
                w.style.boxShadow = '0px 10px 15px 0px rgba(0,0,0,0.5)';
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

        var objContent = document.createElement('div');
        objContent.classList.add('objContent');

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

            console.log("txt...");
            el = 'textarea';
            var e = document.createElement(el);
        

            objContent.appendChild(objBar);
            objContent.appendChild(e);

            obj.appendChild(objContent);

            container.appendChild(obj);

            // fetch(path + '/' + filename)

            filePath = path + '/' + filename;

            // console.log("loadContent('../../controller/loculusoptions.php', 'filePath', filePath, '', 'GET')");
            loadContent('../../controller/loculusoptions.php', 'filePath', filePath, '', 'GET', '', e);

            // e.textContent = ;
            console.log("filepath");

            // notice changes in txt file
            var initialText = e.textContent;

            e.addEventListener('input', function(){
                if (e.textcontent != initialText){
                    h6.textContent = filename + "*";
                }
            })


            
            
        } else if (type.includes("image")){

            console.log("img...");
            el = 'img';
            const e = document.createElement(el);
        

            objContent.appendChild(objBar);
            objContent.appendChild(e);

            obj.appendChild(objContent);

            container.appendChild(obj);

            e.src = '../' + path + '/' + filename;
            console.log(e.src);

        } else {
            console.log("else...");
            el = 'iframe';
            const e = document.createElement(el);
        

            objContent.appendChild(objBar);
            objContent.appendChild(e);

            obj.appendChild(objContent);


            container.appendChild(obj);
            e.src = '../'+ path + '/' + filename;
            console.log("e.src");
        }
  
        moveFrame();
        onPageSearch();
    }


    function modal_popup(option){
        //modal popup for loculus options
        const header = document.querySelector('header');
        console.log(header);
        var modal = header.querySelector("#backgrd");
        var modalP = header.querySelector("#modal-popup");
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
                    loadContent('../../controller/loculusoptions.php', 'delLoculus', '<?php echo $dir ?>', 'modal-popup', 'GET');
                    
                    setTimeout(function() {
                        loadContent('../../controller/checkPermission.php', '', '', 'checkperm', 'GET');
                        loadContent('../../controller/options.php', '', '', 'loculusoptions', 'GET');
                        loadContent('myloculus.php', '', '', 'loculus', 'GET');
                    }, 1000);

                    // loadContent('myloculus.php', 'dir_id', '', 'loculus', 'GET');
                    modal.style.display = "none";
                }else if (event.target.id === 'shareLoculus') {
                    loadContent('../../controller/loculusoptions.php', '', '', 'modal-popup', 'POST', 'Form');
                    
                    setTimeout(function() {
                        loadContent('myloculus.php', 'dir_id', '<?php echo $dir ?>', 'loculus', 'GET');
                    }, 1000);

                }else if (event.target.id === 'theme') {
                    loadContent('../../controller/loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
                    loadContent('myloculus.php', 'dir_id', '<?php echo $dir ?>', 'loculus', 'GET');
                    modal.style.display = "none";
                }else if (event.target.id === 'upload') {
                    loadContent('../../controller/loculusoptions.php', '', '', 'modal-popup', 'POST', 'Form');
                    
                    setTimeout(function() {
                        loadContent('myloculus.php', 'dir_id', '<?php echo $dir ?>', 'loculus', 'GET');
                    }, 1000);

                }else if (event.target.id === 'NewLoculus') {
                    loadContent('../../controller/loculusoptions.php', '', '', 'modal-popup', 'POST', 'Form');
                    
                    setTimeout(function() {
                        loadContent('myloculus.php', 'dir_id', '<?php echo $dir ?>', 'loculus', 'GET');
                    }, 1000);

                }
            }

        });

        if(option == "plus"){
            modal.style.display = "block";
            modalP.innerHTML = `<h1>Add new item</h1>
 
                        <form id="Form"  method="POST" enctype="multipart/form-data">
                            select file to upload:
                            <input type="file" name="toUpload" id="toUpload">
                            <input id="upload" type="submit" value="Upload" name="Upload">
                        </form>`;

        }

        else if(option == "newL"){
            modal.style.display = "block";
            modalP.innerHTML = `<h1>New Loculus</h1>
                       
                        <form id="Form" action="" method="POST">
                            <input type="text" name='loculusName' id="loculusName" placeholder="folder name...">
                            <input id="NewLoculus" type="submit" value="New Loculus" name="Newloculus">
                        </form>`;
        }

        else if(option == "chTheme"){
            modal.style.display = "block";
            modalP.innerHTML = `<h2>Theme</h2>
                       
                        <form id="Form" action="">
                            Primary color:
                            <input type="color" name="c1" id="c1" value="<?php echo $_SESSION['c1']; ?>">
                            Secondary color:
                            <input type="color" name="c2" id="c2" value="<?php echo $_SESSION['c2']; ?>">
                            Accent color:
                            <input type="color" name="c3" id="c3" value="<?php echo $_SESSION['c3']; ?>">
                            <input onclick="chTheme(c1.value,c2.value,c3.value)" id="theme" type="submit" value="theme" name="Theme">
                        </form>`;
        }

        if(option == "share"){
            modal.style.display = "block";
            modalP.innerHTML = `
                    <h2>Share loculus</h2>
                 
                        <form id="Form" action="">
                            share with:
                            <select id="userRole" name="userRole" placeholder="user role">
                                <option value="admin">Admin</option>
                                <option value="standard">Standard</option>
                                <option value="guest">Guest</option>
                            </select>

                            <input type="text" name="searchedUser" id="searchedUser">
                            <input type="hidden" id="searchedUserId" name="searchedUserId">
                            <div id="livesearchcontainer">
                                
                                <ul id="list"></ul>
                            </div>
                            <input id="shareLoculus" type="submit" value="Share" name="shareLoculus">
                        </form>`;

            livesearch();
        }


        if(option == "del"){
            // loadContent('myloculus.php', 'del', 'del', 'loculus', 'GET');
            modal.style.display = "block";
            modalP.innerHTML = `<h2>Delete Loculus</h2>
                     
                        <form id="Form" action="">
                            <label>Are you sure you want to delete this loculus?</label>
                            <input id="delLoculus" type="submit" value="delete loculus" name="delLoculus">
                        </form>`;
            // var form = document.getElementById("del");
            // // console.log(submit);
            // form.addEventListener('onclick', function(event){
            //     event.preventDefault();
            //     console.log('submit');
                
                
            // });

            
        }


        

    }

        window.onclick = function (event){
            if(event.target == modal){
                modal.style.display = "none";
                // modal1.style.display = "none";
                // modal2.style.display = "none";
            }

            
        };



    //show transfers in popup
    function showTransfers(){
        const header = document.querySelector('header');
        var transIcon = document.getElementById('transferIcon');
        var modal = header.querySelector("#backgrd");
        var modalP = header.querySelector("#modal-popup");

        modal.style.display = "block";
        
        loadContent('transfers.php', '', '', 'modal-popup', 'GET');


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
        var researchedUserId = document.getElementById('searchedUserId');
        var list = document.getElementById('list');
        researchedUser.value = username;
        researchedUserId.value = userID;

        // Store the corresponding user_id as a data attribute in the input field
        // researchedUser.setAttribute("searched_user_id", userID);

        list.innerHTML = "";
    }


   


</script>

</html>
<script src="../js/loculus.js"></script>