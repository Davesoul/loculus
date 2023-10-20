document.addEventListener('DOMContentLoaded', function(){

    




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




    // //open searchbar on screen width<765
    // btn = document.querySelectorAll('.btn');
    // sc = document.getElementById('searchcontainer');
    // var bar = document.getElementById("bar");
    // sc.onclick = function(){
    //     // console.log(sc);
    //     sc.classList.toggle('on');
    //     bar.focus();
    //     btn.forEach(b => {b.classList.toggle('off')});
        

    // }







    // solves the directory section overflowing in workshop
    window.addEventListener('resize', ()=>{
        if (window.location.hash == "#space"){
            setTimeout(function(){window.location.hash = "#space";}, 1000);
            
        }
        
    });




    /**
     * move frames
     */

    //manipulate iframe on mouse events
    const body = document.querySelector('body');
    

    function moveFrame(){
        
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
                        c.style.boxShadow = '0px 5px 5px 0px rgba(0, 0, 0, 0.5)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }else if(c.style.zIndex == 4){
                        c.style.zIndex = "2";
                        c.style.boxShadow = '0px 5px 3px 0px rgba(0, 0, 0, 0.5)';
                        c.style.border = 'solid 2px rgba(0,0,0,0)';
                    }else{
                        c.style.zIndex = "1";
                        c.style.boxShadow = '0px 5px 1px 0px rgba(0, 0, 0, 0.5)';
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
    moveFrame();



    //     var deleteBtn = document.getElementById('delete');

    // function deleteFile(filename, fileID){
    //     console.log('delete');
    //     modal.style.display = "block";
    //     modal.innerHTML = `                
    //     <div class="modal-popup">    
    //         <form action="" method="POST">
    //             <i class="fa-solid fa-trash-can"></i>
    //             <p>You are going to delete the file ${filename}</p>
    //             <input id="deletion" type="submit" value="deletion" name="deletion">
    //         </form>
    //     </div>`;

    //     var deleteBtn2 = document.getElementById('deletion');
    //     deleteBtn2.onclick = function(){
    //         loadContent('myloculus.php', session='del', fileID, 'loculus', 'GET');
    //         modal.style.display = "none";
    //     };
    // }

    console.log(window.location.href);
});