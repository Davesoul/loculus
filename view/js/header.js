document.addEventListener('DOMContentLoaded', ()=>{

// open menus
var header = document.querySelector('header');

console.log(header);


header.addEventListener("click", function(a){
    var clickedEL = a.target;
    var btnEL = clickedEL.closest('.btn');
    console.log(clickedEL);
    if (btnEL){
        console.log("start opening");
        var btn = document.querySelectorAll('.btn');
        console.log("buttons: " + btn);


        a.stopPropagation();
        console.log('click btn');
        
        // console.log();
        var menu = btnEL.querySelector('.objects');
        var container = btnEL.querySelector('.objects > .popup-container');
        console.log(container);

        btn.forEach(c => {
            // console.log(c);
            // console.log(c.contains(b));

            // close previous menu when another one is opened
            if(c != btnEL && c.contains(btnEL) == false){
                c.classList.remove('active');
                prevMenu = c.querySelector('.objects');
                prevContainer = c.querySelector('.objects > .popup-container');
                prevMenu.classList.remove('active');
                prevContainer.classList.remove('active');
            }
        });

        console.log("positioning");
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

        console.log("activating menu");
        btnEL.classList.toggle('active');
        menu.classList.toggle('active');
        container.classList.toggle('active');

        


        
    }
});




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

            if (event.target.id === 'del') {
                loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
                loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
                modal.style.display = "none";
            }else if (event.target.id === 'share') {
                loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
                loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
                modal.style.display = "none";
            }else if (event.target.id === 'theme') {
                loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
                loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
                modal.style.display = "none";
            }else if (event.target.id === 'upload') {
                loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
                loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
                // post('plusForm');
                modal.style.display = "none";
            }else if (event.target.id === 'NewLoculus') {
                loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
                // loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
                modal.style.display = "none";
            }
        }

    });

    if(option == "plus"){
        modal.style.display = "block";
        modal.innerHTML = `                <h3>Add new item</h3>
                <div class="modal-popup">    
                    <form id="Form" action="myloculus.php"  method="POST" enctype="multipart/form-data">
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
                    <form action="" method="POST" enctype="multipart/form-data">
                        Primary color:
                        <input type="color" name="" id="">
                        Secondary color:
                        <input type="color" name="" id="">
                        Accent color:
                        <input type="color" name="" id="">
                        <input id="theme" type="submit" value="theme" name="Theme">
                    </form>`;
    }

    if(option == "share"){
        modal.style.display = "block";
        modal.innerHTML = `
                <h3>Share loculus</h3>
                <div class="modal-popup">    
                    <form action="" method="POST" enctype="multipart/form-data">
                        share with:
                        <input type="text" name="shareLoculus" id="shareLoculus">
                        <input id="share" type="submit" value="Upload" name="Upload">
                    </form>
            </div>`;
    }

    if(option == "del"){
        // loadContent('myloculus.php', 'del', 'del', 'loculus', 'GET');
        modal.style.display = "block";
        modal.innerHTML = `                <h3>Delete Loculus</h3>
                <div class="modal-popup">    
                    <form action="" >
                        <label>Are you sure you want to delete this loculus?</label>
                        <input id="del" type="submit" value="delete loculus">
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








// var btn = document.querySelectorAll('.btn');

// btn.forEach(b => {
//     b.addEventListener('click', (e)=>{
//         e.stopPropagation();
//         console.log('click btn');
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

//         console.log("positioning");
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

//         console.log("activating menu");
//         b.classList.toggle('active');
//         menu.classList.toggle('active');
//         container.classList.toggle('active');

        

//     });
// });


/**
 * fills the workshop menu list
 */

//fills the workshop windows list
var workshop = document.getElementById('space');
var loculus = document.getElementById('loculus');
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
            loculusHeight = workshop.style.height;
            bound = w.getBoundingClientRect();

            offsetTop = window.innerHeight;
            console.log(bound);
            console.log(window.scrollY);
            obj1.forEach(c=>{
                c.style.zIndex = '1';
                c.style.border = 'solid 2px rgba(0,0,0,0)';
            })
                // console.log('start');
                // w.style.left = '35%';
                // w.style.top = `${offsetTop}px`;
            var scrollTop = w.offsetTop - 100
            workshop.scrollTo({
                top: scrollTop,
                behaviour: "smooth"
            });
            w.style.zIndex = '5';
            w.style.border = 'solid 2px var(--secondarycolor)';
        })


    })

    // console.log("content =" + menu.innerHTML);

    if (wpmenu.innerHTML == ""){
        wpmenu.innerHTML = "Empty Workshop";
    }
})



// /**
//  * search for files and frames with search bar
//  */

// //search for files and windows in search bar
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

// prevent searchbar from submitting
var sForm = document.getElementById("sForm");
var bar = document.getElementById("bar");

sForm.addEventListener('submit', function(e){
    e.preventDefault();
    // console.log('oi');
    // openFile(path='https://google.com/', filename=bar.value, type='www-doc')
})





/**
 * modal popups
 */


    // //modal popup for file uploading
    // var modal = document.getElementById("backgrd");
    // var plus = document.getElementById("plus");
    // var newL = document.getElementById("newL");
    // var theme = document.getElementById("chTheme");
    // var share = document.getElementById("share");
    // var del = document.getElementById("del");
    

    // document.addEventListener('click', function(event) {
    //     // Check if the click event is from the submit button
    //     console.log(event.target.type);
    //     if (event.target.type === 'submit') {
    //         event.preventDefault(); // Prevent the default form submission

    //         if (event.target.id === 'del') {
    //             loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
    //             modal.style.display = "none";
    //         }else if (event.target.id === 'share') {
    //             loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
    //             modal.style.display = "none";
    //         }else if (event.target.id === 'theme') {
    //             loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
    //             modal.style.display = "none";
    //         }else if (event.target.id === 'upload') {
    //             loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
    //             loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
    //             // post('plusForm');
    //             modal.style.display = "none";
    //         }else if (event.target.id === 'NewLoculus') {
    //             loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
    //             loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
    //             modal.style.display = "none";
    //         }
    //     }
    // });

    // plus.onclick = function (){
    //     modal.style.display = "block";
    //     modal.innerHTML = `                <h3>Add new item</h3>
    //             <div class="modal-popup">    
    //                 <form id="Form" action="myloculus.php"  method="POST" enctype="multipart/form-data">
    //                     select file to upload:
    //                     <input type="file" name="toUpload" id="toUpload">
    //                     <input type="text" name="loculusTarget" id="loculusTarget">
    //                     <div id="livesearchcontainer">
                            
    //                         <ul id="list"></ul>
    //                     </div>

    //                     <input id="upload" type="submit" value="Upload" name="Upload">
    //                 </form>
    //             </div>`;

    //     livesearch();

    // }

    // newL.onclick = function (){
    //     modal.style.display = "block";
    //     modal.innerHTML = `                <h3>New Loculus</h3>
    //             <div class="modal-popup">    
    //                 <form id="Form" action="" method="POST">
    //                     <input type="text" name='loculusName' id="loculusName" placeholder="folder name...">
    //                     <input id="NewLoculus" type="submit" value="New Loculus" name="Newloculus">
    //                 </form>
    //             </div>`;
    // }

    // theme.onclick = function (){
    //     modal.style.display = "block";
    //     modal.innerHTML = `<h3>Theme</h3>
    //             <div class="modal-popup">    
    //                 <form action="" method="POST" enctype="multipart/form-data">
    //                     Primary color:
    //                     <input type="color" name="" id="">
    //                     Secondary color:
    //                     <input type="color" name="" id="">
    //                     Accent color:
    //                     <input type="color" name="" id="">
    //                     <input id="theme" type="submit" value="theme" name="Theme">
    //                 </form>`;
    // }

    // share.onclick = function (){
    //     modal.style.display = "block";
    //     modal.innerHTML = `
    //             <h3>Share loculus</h3>
    //             <div class="modal-popup">    
    //                 <form action="" method="POST" enctype="multipart/form-data">
    //                     share with:
    //                     <input type="text" name="shareLoculus" id="shareLoculus">
    //                     <input id="share" type="submit" value="Upload" name="Upload">
    //                 </form>
    //         </div>`;
    // }

    // del.onclick = function (){
    //     // loadContent('myloculus.php', 'del', 'del', 'loculus', 'GET');
    //     modal.style.display = "block";
    //     modal.innerHTML = `                <h3>Delete Loculus</h3>
    //             <div class="modal-popup">    
    //                 <form action="" >
    //                     <label>Are you sure you want to delete this loculus?</label>
    //                     <input id="del" type="submit" value="delete loculus">
    //                 </form>
    //             </div>`;
    //     // var form = document.getElementById("del");
    //     // // console.log(submit);
    //     // form.addEventListener('onclick', function(event){
    //     //     event.preventDefault();
    //     //     console.log('submit');
            
            
    //     // });

        
    // }

    // window.onclick = function (event){
    //     if(event.target == modal){
    //         modal.style.display = "none";
    //         // modal1.style.display = "none";
    //         // modal2.style.display = "none";
    //     }
    // };


    

})