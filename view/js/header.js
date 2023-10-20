// document.addEventListener('DOMContentLoaded', ()=>{

// // open menus
// var header = document.querySelector('header');

// console.log(header);

// function menus(a){
    
//     var clickedEL = a.target;
//     var btnEL = clickedEL.closest('.btn');
//     console.log('btnel:', btnEL);
//     console.log('clickedel', clickedEL);

//     if (btnEL){
//         console.log("start opening");
//         var btn = document.querySelectorAll('.btn');
//         console.log("buttons: " + btn);


//         a.stopPropagation();
//         console.log('click btn');
        
//         // console.log();
//         var menu = btnEL.querySelector('.objects');
//         var container = btnEL.querySelector('.objects > .popup-container');
//         console.log(container);

//         btn.forEach(c => {
//             // console.log(c);
//             // console.log(c.contains(b));

//             // close previous menu when another one is opened
//             if(c != btnEL && c.contains(btnEL) == false){
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
//         btnEL.classList.toggle('active');
//         menu.classList.toggle('active');
//         container.classList.toggle('active');

        


        
//     }
// }

// header.addEventListener("click", function(a){

//     menus(a);

//     //open searchbar on screen width<765
//     btn = document.querySelectorAll('.btn');
//     sc = document.getElementById('searchcontainer');
//     sb = document.getElementById('searchbtn');

//     var bar = document.getElementById("bar");
//     var sbEl = clickedEL.closest('#searchbtn');

//     if(sbEl){
//         console.log('open search bar');
//         console.log(sc);
//         sc.classList.toggle('on');
//         if (sc.classList.contains('on')){
//             bar.focus();
//         } else {
//             bar.value = '';
//         }

//         btn.forEach(b => {b.classList.toggle('off')});
        
//         window.onclick = function(w){
//             if (w.target != sc && w.target != sb && w.target != bar){
//                 console.log('close');
//                 sc.classList.remove('on');
//                 btn.forEach(b => {b.classList.remove('off')});
//                 bar.value = '';
//             }
//         }

//     }

//     // prevent searchbar from submitting
//     var sForm = document.getElementById("sForm");
//     var bar = document.getElementById("bar");

//     sForm.addEventListener('submit', function(e){
//         e.preventDefault();
//         // console.log('oi');
//         // openFile(path='https://google.com/', filename=bar.value, type='www-doc')
//     })
// });




// // function modal_popup(option){
// //     //modal popup for file uploading
// //     const header = document.querySelector('header');
// //     console.log(header);
// //     var modal = header.querySelector("#backgrd");
// //     console.log(modal);
// //     var plus = header.querySelector("#plus");
// //     console.log(plus);
// //     var newL = header.querySelector("#newL");
// //     var theme = header.querySelector("#chTheme");
// //     var share = header.querySelector("#share");
// //     var del = header.querySelector("#del");
    

// //     document.addEventListener('click', function(event) {
// //         // Check if the click event is from the submit button
// //         console.log(event.target);
// //         // var eL = event.target.closest('#');
// //         if (event.target.type === 'submit') {
// //             event.preventDefault(); // Prevent the default form submission

// //             if (event.target.id === 'del') {
// //                 loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
// //                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
// //                 modal.style.display = "none";
// //             }else if (event.target.id === 'share') {
// //                 loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
// //                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
// //                 modal.style.display = "none";
// //             }else if (event.target.id === 'theme') {
// //                 loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
// //                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
// //                 modal.style.display = "none";
// //             }else if (event.target.id === 'upload') {
// //                 loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
// //                 loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
// //                 // post('plusForm');
// //                 modal.style.display = "none";
// //             }else if (event.target.id === 'NewLoculus') {
// //                 loadContent('loculusoptions.php', '', '', 'modal', 'POST', 'Form');
// //                 // loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
// //                 modal.style.display = "none";
// //             }
// //         }

// //     });

// //     if(option == "plus"){
// //         modal.style.display = "block";
// //         modal.innerHTML = `                <h3>Add new item</h3>
// //                 <div class="modal-popup">    
// //                     <form id="Form" action="myloculus.php"  method="POST" enctype="multipart/form-data">
// //                         select file to upload:
// //                         <input type="file" name="toUpload" id="toUpload">
// //                         <input type="text" name="loculusTarget" id="loculusTarget">
// //                         <div id="livesearchcontainer">
                            
// //                             <ul id="list"></ul>
// //                         </div>

// //                         <input id="upload" type="submit" value="Upload" name="Upload">
// //                     </form>
// //                 </div>`;

// //         livesearch();

// //     }

// //     else if(option == "newL"){
// //         modal.style.display = "block";
// //         modal.innerHTML = `                <h3>New Loculus</h3>
// //                 <div class="modal-popup">    
// //                     <form id="Form" action="" method="POST">
// //                         <input type="text" name='loculusName' id="loculusName" placeholder="folder name...">
// //                         <input id="NewLoculus" type="submit" value="New Loculus" name="Newloculus">
// //                     </form>
// //                 </div>`;
// //     }

// //     else if(option == "chTheme"){
// //         modal.style.display = "block";
// //         modal.innerHTML = `<h3>Theme</h3>
// //                 <div class="modal-popup">    
// //                     <form action="" method="POST" enctype="multipart/form-data">
// //                         Primary color:
// //                         <input type="color" name="" id="">
// //                         Secondary color:
// //                         <input type="color" name="" id="">
// //                         Accent color:
// //                         <input type="color" name="" id="">
// //                         <input id="theme" type="submit" value="theme" name="Theme">
// //                     </form>`;
// //     }

// //     if(option == "share"){
// //         modal.style.display = "block";
// //         modal.innerHTML = `
// //                 <h3>Share loculus</h3>
// //                 <div class="modal-popup">    
// //                     <form action="" method="POST" enctype="multipart/form-data">
// //                         share with:
// //                         <input type="text" name="shareLoculus" id="shareLoculus">
// //                         <input id="share" type="submit" value="Upload" name="Upload">
// //                     </form>
// //             </div>`;
// //     }

// //     if(option == "del"){
// //         // loadContent('myloculus.php', 'del', 'del', 'loculus', 'GET');
// //         modal.style.display = "block";
// //         modal.innerHTML = `                <h3>Delete Loculus</h3>
// //                 <div class="modal-popup">    
// //                     <form action="" >
// //                         <label>Are you sure you want to delete this loculus?</label>
// //                         <input id="del" type="submit" value="delete loculus">
// //                     </form>
// //                 </div>`;
// //         // var form = document.getElementById("del");
// //         // // console.log(submit);
// //         // form.addEventListener('onclick', function(event){
// //         //     event.preventDefault();
// //         //     console.log('submit');
            
            
// //         // });

        
// //     }

// //     window.onclick = function (event){
// //         if(event.target == modal){
// //             modal.style.display = "none";
// //             // modal1.style.display = "none";
// //             // modal2.style.display = "none";
// //         }
// //     };
    

// // }








// // var btn = document.querySelectorAll('.btn');

// // btn.forEach(b => {
// //     b.addEventListener('click', (e)=>{
// //         e.stopPropagation();
// //         console.log('click btn');
// //         console.log(b);
// //         var menu = b.querySelector('.objects');
// //         var container = b.querySelector('.objects > .popup-container');
// //         console.log(container);

// //         btn.forEach(c => {
// //             // console.log(c);
// //             // console.log(c.contains(b));

// //             // close previous menu when another one is opened
// //             if(c != b && c.contains(b) == false){
// //                 c.classList.remove('active');
// //                 prevMenu = c.querySelector('.objects');
// //                 prevContainer = c.querySelector('.objects > .popup-container');
// //                 prevMenu.classList.remove('active');
// //                 prevContainer.classList.remove('active');
// //             }
// //         });

// //         console.log("positioning");
// //         // console.log(menu.getBoundingClientRect());
// //         // console.log(window.innerHeight);

// //         var menuRect = menu.getBoundingClientRect();
// //         var viewport = window.innerWidth;

// //         //reposition the menu div whenever it exceeds the viewport width
// //         if(menuRect.x + menuRect.right >= viewport){
// //             menu.style.right = "10px";
// //             // console.log(menuRect.x);

// //             var menuRect = menu.getBoundingClientRect();

// //             if(menuRect.x < 0){
                
// //                 menu.style.left = "10px";
// //                 console.log(menuRect.x);
// //         }
// //         }

// //         console.log("activating menu");
// //         b.classList.toggle('active');
// //         menu.classList.toggle('active');
// //         container.classList.toggle('active');

        

// //     });
// // });


// /**
//  * fills the workshop menu list
//  */

// //fills the workshop windows list
// var workshop = document.getElementById('space');
// var loculus = document.getElementById('loculus');
// var wp = document.querySelector('#workshop');    
// var wpmenu = wp.querySelector('.popup-container');

// //onclick
// wp.addEventListener('click', ()=>{
//     wpmenu.innerHTML = '';
//     const container = workshop.querySelector('.spacecontainer');
//     var obj1 = workshop.querySelectorAll('.obj');

//     //loop through obj and add their name to the menu

//     obj1.forEach(w=>{
    
//         var frameTitle = w.querySelector('h6').textContent;
//         // console.log(w);
//         var listItem = document.createElement('li');
//         item = document.createElement('a');

//         item.href = '#space';
//         item.textContent = frameTitle;

//         wpmenu.appendChild(listItem);
//         listItem.appendChild(item);

//         // position the frame on the center of the page
//         item.addEventListener('click', ()=>{
//             loculusHeight = workshop.style.height;
//             bound = w.getBoundingClientRect();

//             offsetTop = window.innerHeight;
//             console.log(bound);
//             console.log(window.scrollY);
//             obj1.forEach(c=>{
//                 c.style.zIndex = '1';
//                 c.style.border = 'solid 2px rgba(0,0,0,0)';
//             })
//                 // console.log('start');
//                 // w.style.left = '35%';
//                 // w.style.top = `${offsetTop}px`;
//             var scrollTop = w.offsetTop - 100
//             workshop.scrollTo({
//                 top: scrollTop,
//                 behaviour: "smooth"
//             });
//             w.style.zIndex = '5';
//             w.style.border = 'solid 2px var(--secondarycolor)';
//         })


//     })

//     // console.log("content =" + menu.innerHTML);

//     if (wpmenu.innerHTML == ""){
//         wpmenu.innerHTML = "Empty Workshop";
//     }
// })



// // /**
// //  * search for files and frames with search bar
// //  */

// // //search for files and windows in search bar
// // function onPageSearch(){
// //     var workshop = document.getElementById('space');
// //     var loculus = document.getElementById('loculus');
// //     var bar = document.getElementById("bar");

// //     //search for a window in workshop

// //     var obj = workshop.querySelectorAll('.obj');

// //     bar.addEventListener('keyup', (e)=>{
    
// //         const data = e.target.value.toLowerCase();

// //         obj.forEach(w => {
// //             if (w.textContent.toLowerCase().includes(data)){
// //                 console.log(w.textContent);
// //                 w.style.display = "block";
// //                 obj.forEach(c => {
// //                     c.style.zIndex = "1";
// //                 });

// //                 w.style.zIndex = "5";

// //             }
// //             else{
// //                 w.style.display = "none";
// //             }
// //         })

// //     })



// //     // search for a file in directory

// //     var cont = loculus.getElementsByClassName("container");
// //     var info = loculus.getElementsByClassName("smalldescription");
    

// //     bar.addEventListener('keyup', (e)=>{
// //         const data = e.target.value.toLowerCase();
// //         console.log(data);
// //         console.log(info);
// //         for(i=0; i<cont.length; i++){
// //             console.log(info[i].textcontent);
// //             if(info[i].textContent.toLowerCase().includes(data)){

// //                 cont[i].style.display = "flex"
// //             }
// //             else{
// //                 cont[i].style.display = "none"
// //             }
// //         }
// //     })

// // }

// // onPageSearch();




// // //open searchbar on screen width<765
// // btn = document.querySelectorAll('.btn');
// // sc = document.getElementById('searchcontainer');
// // sb = document.getElementById('searchbtn');

// // var bar = document.getElementById("bar");
// // var sbEl = sb.closest('#searchbtn');

// // sbEl.onclick = function(){
// //     console.log('open search bar');
// //     console.log(sc);
// //     sc.classList.toggle('on');
// //     if (sc.classList.contains('on')){
// //         bar.focus();
// //     } else {
// //         bar.value = '';
// //     }

// //     btn.forEach(b => {b.classList.toggle('off')});
    
// //     window.onclick = function(w){
// //         if (w.target != sc && w.target != sb && w.target != bar){
// //             console.log('close');
// //             sc.classList.remove('on');
// //             btn.forEach(b => {b.classList.remove('off')});
// //             bar.value = '';
// //         }
// //     }

// // }

// // // prevent searchbar from submitting
// // var sForm = document.getElementById("sForm");
// // var bar = document.getElementById("bar");

// // sForm.addEventListener('submit', function(e){
// //     e.preventDefault();
// //     // console.log('oi');
// //     // openFile(path='https://google.com/', filename=bar.value, type='www-doc')
// // })





// /**
//  * modal popups
//  */


//     // //modal popup for file uploading
//     // var modal = document.getElementById("backgrd");
//     // var plus = document.getElementById("plus");
//     // var newL = document.getElementById("newL");
//     // var theme = document.getElementById("chTheme");
//     // var share = document.getElementById("share");
//     // var del = document.getElementById("del");
    

//     // document.addEventListener('click', function(event) {
//     //     // Check if the click event is from the submit button
//     //     console.log(event.target.type);
//     //     if (event.target.type === 'submit') {
//     //         event.preventDefault(); // Prevent the default form submission

//     //         if (event.target.id === 'del') {
//     //             loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
//     //             modal.style.display = "none";
//     //         }else if (event.target.id === 'share') {
//     //             loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
//     //             modal.style.display = "none";
//     //         }else if (event.target.id === 'theme') {
//     //             loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
//     //             modal.style.display = "none";
//     //         }else if (event.target.id === 'upload') {
//     //             loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
//     //             loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
//     //             // post('plusForm');
//     //             modal.style.display = "none";
//     //         }else if (event.target.id === 'NewLoculus') {
//     //             loadContent('loculusoptions.php', '', '', 'loculus', 'POST', 'Form');
//     //             loadContent('myloculus.php', 'dir_id', '<?php echo $_SESSION["dir_id"] ?>', 'loculus', 'GET');
//     //             modal.style.display = "none";
//     //         }
//     //     }
//     // });

//     // plus.onclick = function (){
//     //     modal.style.display = "block";
//     //     modal.innerHTML = `                <h3>Add new item</h3>
//     //             <div class="modal-popup">    
//     //                 <form id="Form" action="myloculus.php"  method="POST" enctype="multipart/form-data">
//     //                     select file to upload:
//     //                     <input type="file" name="toUpload" id="toUpload">
//     //                     <input type="text" name="loculusTarget" id="loculusTarget">
//     //                     <div id="livesearchcontainer">
                            
//     //                         <ul id="list"></ul>
//     //                     </div>

//     //                     <input id="upload" type="submit" value="Upload" name="Upload">
//     //                 </form>
//     //             </div>`;

//     //     livesearch();

//     // }

//     // newL.onclick = function (){
//     //     modal.style.display = "block";
//     //     modal.innerHTML = `                <h3>New Loculus</h3>
//     //             <div class="modal-popup">    
//     //                 <form id="Form" action="" method="POST">
//     //                     <input type="text" name='loculusName' id="loculusName" placeholder="folder name...">
//     //                     <input id="NewLoculus" type="submit" value="New Loculus" name="Newloculus">
//     //                 </form>
//     //             </div>`;
//     // }

//     // theme.onclick = function (){
//     //     modal.style.display = "block";
//     //     modal.innerHTML = `<h3>Theme</h3>
//     //             <div class="modal-popup">    
//     //                 <form action="" method="POST" enctype="multipart/form-data">
//     //                     Primary color:
//     //                     <input type="color" name="" id="">
//     //                     Secondary color:
//     //                     <input type="color" name="" id="">
//     //                     Accent color:
//     //                     <input type="color" name="" id="">
//     //                     <input id="theme" type="submit" value="theme" name="Theme">
//     //                 </form>`;
//     // }

//     // share.onclick = function (){
//     //     modal.style.display = "block";
//     //     modal.innerHTML = `
//     //             <h3>Share loculus</h3>
//     //             <div class="modal-popup">    
//     //                 <form action="" method="POST" enctype="multipart/form-data">
//     //                     share with:
//     //                     <input type="text" name="shareLoculus" id="shareLoculus">
//     //                     <input id="share" type="submit" value="Upload" name="Upload">
//     //                 </form>
//     //         </div>`;
//     // }

//     // del.onclick = function (){
//     //     // loadContent('myloculus.php', 'del', 'del', 'loculus', 'GET');
//     //     modal.style.display = "block";
//     //     modal.innerHTML = `                <h3>Delete Loculus</h3>
//     //             <div class="modal-popup">    
//     //                 <form action="" >
//     //                     <label>Are you sure you want to delete this loculus?</label>
//     //                     <input id="del" type="submit" value="delete loculus">
//     //                 </form>
//     //             </div>`;
//     //     // var form = document.getElementById("del");
//     //     // // console.log(submit);
//     //     // form.addEventListener('onclick', function(event){
//     //     //     event.preventDefault();
//     //     //     console.log('submit');
            
            
//     //     // });

        
//     // }

//     // window.onclick = function (event){
//     //     if(event.target == modal){
//     //         modal.style.display = "none";
//     //         // modal1.style.display = "none";
//     //         // modal2.style.display = "none";
//     //     }
//     // };


    

// })

document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    const workshop = document.getElementById('space');
    const loculus = document.getElementById('loculus');
    const searchBar = document.getElementById("bar");

    function handleMenuClick(event) {
        const clickedElement = event.target;
        const buttonElement = clickedElement.closest('.btn');

        if (buttonElement) {
            closeOtherMenus(buttonElement);

            const menu = buttonElement.querySelector('.objects');
            const container = buttonElement.querySelector('.objects > .popup-container');
            
            adjustMenuPosition(buttonElement, menu);
            
            buttonElement.classList.toggle('active');
            menu.classList.toggle('active');
            container.classList.toggle('active');
        }
    }

    function closeOtherMenus(currentButton) {
        const buttons = document.querySelectorAll('.btn');
        
        buttons.forEach(button => {
            if (button != currentButton && !button.contains(currentButton)) {
                button.classList.remove('active');
                const prevMenu = button.querySelector('.objects');
                const prevContainer = button.querySelector('.objects > .popup-container');
                prevMenu.classList.remove('active');
                prevContainer.classList.remove('active');
            }
        });
    }

    function adjustMenuPosition(buttonElement, menu) {
        const menuRect = menu.getBoundingClientRect();
        const viewport = window.innerWidth;

        if (menuRect.x + menuRect.right >= viewport) {
            menu.style.right = "10px";
            
            if (menuRect.x < 0) {
                menu.style.left = "10px";
            }
        }
    }

    header.addEventListener("click", handleMenuClick);



    // Get the required elements
    const wp = document.querySelector('#workshop');
    const wpmenu = wp.querySelector('.popup-container');

    // Add a click event listener to the workshop menu
    wp.addEventListener('click', () => {
        // Clear the workshop menu
        wpmenu.innerHTML = '';

        // Get all workshop items
        const workshopItems = workshop.querySelectorAll('.obj');

        // Loop through workshop items and add their names to the menu
        workshopItems.forEach(item => {
            const frameTitle = item.querySelector('h6').textContent;
            
            const listItem = document.createElement('li');
            const link = document.createElement('a');
            link.href = '#space';
            link.textContent = frameTitle;

            listItem.appendChild(link);
            wpmenu.appendChild(listItem);

            // Add a click event listener to scroll and focus on the selected item
            link.addEventListener('click', () => {
                const loculusHeight = workshop.style.height;
                const bound = item.getBoundingClientRect();
                const scrollTop = item.offsetTop - 100;

                // Reset z-index and border for all items
                workshopItems.forEach(w => {
                    w.style.zIndex = '1';
                    w.style.border = 'solid 2px rgba(0,0,0,0)';
                });

                // Scroll to the selected item smoothly
                workshop.scrollTo({
                    top: scrollTop,
                    behavior: "smooth"
                });

                // Highlight the selected item
                item.style.zIndex = '5';
                item.style.border = 'solid 2px var(--secondarycolor)';
            });
        });

        // If the menu is empty, display a message
        if (!wpmenu.hasChildNodes()) {
            wpmenu.innerHTML = "Empty Workshop";
        }
    });



    // Additional functions and event listeners can be added here

    // Open search bar on screens narrower than 765 pixels
const btns = document.querySelectorAll('.btn');
const searchContainer = document.getElementById('searchcontainer');
const searchButton = document.getElementById('searchbtn');

const searchButtonElement = searchButton.closest('#searchbtn');

if (searchButtonElement) {
    searchButtonElement.addEventListener('click', () => {
        searchContainer.classList.toggle('on');
        if (searchContainer.classList.contains('on')) {
            searchBar.focus();
        } else {
            searchBar.value = '';
        }

        btns.forEach(btn => btn.classList.toggle('off'));

        window.onclick = function(event) {
            if (event.target != searchContainer && event.target != searchButton && event.target != searchBar) {
                searchContainer.classList.remove('on');
                btns.forEach(btn => btn.classList.remove('off'));
                searchBar.value = '';
            }
        };
    });

    // Prevent the search bar form from submitting
    const searchForm = document.getElementById('sForm');

    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Add your code for handling the search here
    });
}

});
