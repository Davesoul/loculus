document.addEventListener('DOMContentLoaded', function(){

    



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



        //search on page 'my space'
    
    var iframe2 = document.getElementById('space');
    var iframe1 = document.getElementById('loculus');
    var obj = document.querySelectorAll('.obj');
    var bar = document.getElementById("bar");

//search for a window in workshop
        //select search input
        var bar = document.getElementById("bar");

        //event listener
        bar.addEventListener('keyup', (e)=>{
            var obj = document.querySelectorAll('.obj');
        
            const data = e.target.value.toLowerCase();
            console.log(data);
            
            //loop through all objects
            obj.forEach(w => {
                if (w.textContent.toLowerCase().includes(data)){

                    //hide objects with names not corresponding to search
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

        });
    

// search for a file in directory
var bar = document.getElementById("bar");

    bar.addEventListener('keyup', (e)=>{
        var obj = document.querySelectorAll('.container');
        
    
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
    });

});



    




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

    //fills the workshop windows list
        var wp = document.querySelector('#workshop');    
        var menu = wp.querySelector('.popup-container');
        
        //onclik
        wp.addEventListener('click', ()=>{
            menu.innerHTML = '';
            const container = document.querySelector('.spacecontainer');
            var obj1 = document.querySelectorAll('.obj');
            
            console.log(container);
            console.log(obj1);

            //loop through obj and add their name to the menu
        
            obj1.forEach(w=>{
            
            var frameTitle = w.querySelector('h6').textContent;
            console.log(w);
            var listItem = document.createElement('li');
            item = document.createElement('a');

            item.href = '#space';
            item.textContent = frameTitle;

            menu.appendChild(listItem);
            listItem.appendChild(item);

            item.addEventListener('click', ()=>{
                viewport = window.scrollY;
                console.log(viewport);
                obj1.forEach(c=>{
                    c.style.zIndex = '1';
                })
                    console.log('start');
                    w.style.left = '35%';
                    w.style.top = `${viewport+100}px`;
                    w.style.zIndex = '5';
            })
        })

    })

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
        
        //open searchbar on screen<765
        btn = document.querySelectorAll('.btn');
        sc = document.getElementById('searchcontainer');
        sc.onclick = function(){
            console.log(sc);
            sc.classList.toggle('on');
            btn.forEach(b => {b.classList.toggle('off')});
            

        }

        var directory_name = '';
        function reloadIframe(link) {
        // Get the reference to the iframe element
            var iframe1 = document.getElementById('loculus');

            
            console.log(iframe1);
        // Refresh the iframe by setting its source to the current source
            iframe1.src = link;
            const doc = iframe1.contentWindow.document.var;
            console.log(doc);


        }




            //manipulate iframe on mouse events
    const body = document.querySelector('body');
    var obj = document.querySelectorAll('.obj');


    console.log(obj);
    obj.forEach(w => {
        var bar = w.querySelector('.objbar');
        var close = w.querySelector('span');
        
            console.log(w.offsetLeft, w.offsetTop);


            close.addEventListener('click', ()=>{
                w.remove();
            });

            w.addEventListener('mousedown', ()=>{

                obj.forEach(c => {
                    c.style.zIndex = "1";
                });

                w.style.zIndex = "5";


            });


            bar.addEventListener('mousedown', (e)=>{

                
                // e.stopPropagation();
          
                
                w.style.opacity = 0.6;
               


                var menuRect = w.getBoundingClientRect();
                var viewport = w.innerWidth;

                var x = document.event.clientX - w.offsetLeft;
                var y = document.event.clientY - w.offsetTop;
   

                //reposition the frame div whenever it exceeds the viewport width
                if(menuRect.x + menuRect.right >= viewport){
                    w.style.right = "10px";
                }

                // mouse coordinates minus the initial offset

                const moveObj = (e) => {


                    w.style.position = "absolute";

                    w.style.left = `${document.event.clientX - x}px`;
                   
                    w.style.top = `${document.event.clientY - y}px`;
             





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
        });

        
    //manipulate iframe on touchscreen events

    var obj = document.querySelectorAll('.obj');



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


});