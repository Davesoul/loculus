<?php

// require 'authentication.php';

$page="myspace";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my space</title>
    <!-- <link rel="stylesheet" href="../css/style.css"> -->

    <!-- <script src="https://kit.fontawesome.com/766f30b49e.js" crossorigin="anonymous"></script> -->


    <style>
        html{
            overflow-x: hidden;
        }
    </style>
</head>
<body style="box-sizing:border-box; margin:0; padding:0">

<!-- gap for the header -->
<div class="gap"></div>

    <div class="spacecontainer">
        <div class="obj">
            <div class="objbar up">
                <h6>The Art of Electronics ( PDFDrive ) yes</h6>
                <span><i class="fa-solid fa-close"></i></span>
            </div>
            <iframe src="image/booklists.txt" frameborder="0" sandbox=""></iframe>
            <br>
        </div>

        <div class="obj">
            <div class="objbar up">
                <h6>The Art of Electronics ( PDFDrive ) yosh</h6>
                <span><i class="fa-solid fa-close"></i></span>
            </div>
            <textarea id="myTextarea"></textarea>
            <input type="file" name="" id="inputFile">

            <br>
        </div>

        <div class="obj" id="hello">
            <div class="objContent">
                <div class="objbar up">
                    <h6>The Art of Electronics ( PDFDrive ) hello</h6>
                    <span><i class="fa-solid fa-close"></i></span>
                </div>
                <iframe src="https://www.youtube.com/watch?v=_j7JEDWuqLE" frameborder="0"></iframe>
                <br>
            </div>

        </div>


        <div class="obj" style="width:200px; height:300px; background:#000; position:relative">
            <div class="objbar" style="width: 100%; height:25px; background: #155">
                <h6>bro</h6>
                <span><i class="fa-solid fa-close"></i></span>
            </div>
            <audio controls autoplay>
                <source src="../../../Directories/user_1/test2.wav" type="audio/wav">
                Your browser does not support the audio element.
            </audio> 
            <!-- <audio src="../../../Directories/user_1/test2.wav" controls></audio> -->
            <!-- <video src="../../aesthetic.mp4" controls></video> -->
        </div>


    </div>


    
</body>

<script>
    // reads a file and embed it in a textarea
    const tArea = document.getElementById("myTextarea");
    const fInput = document.getElementById("inputFile");

    fInput.addEventListener('change', function(e){
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e){
            const contents = e.target.result;
            tArea.value = contents;
        };

        reader.readAsText(file);
    })
</script>

<script >
    //search on page 'my space'
    var obj = document.querySelectorAll('.obj');
    var bar = document.getElementById("bar");

    // bar.addEventListener('keyup', (e)=>{
    //     const data = e.target.value.toLowerCase();
    //     console.log(data);
        

    //     obj.forEach(w => {
    //         if (w.textContent.toLowerCase().includes(data)){

    //             w.style.display = "block";
    //             obj.forEach(c => {
    //                 c.style.zIndex = "1";
    //             });

    //             w.style.zIndex = "5";

    //         }
    //         else{
    //             w.style.display = "none";
    //         }
    //     })

    // })
</script>



<!-- <script>
    //not optimized
    var id;
    const body = document.querySelector("body");
    var obj = document.getElementsByClassName("obj");
    var objBarr = document.getElementsByClassName("objbar");
    
    function space(event, i){
        id = i;


        obj[id].style.position = "absolute";

        // reset the z-index for each object
        for(a=0; a<obj.length; a++){
            obj[a].style.zIndex = "0";
        }

        obj[id].style.zIndex = "2";
        var x = event.clientX - obj[id].offsetLeft;
        var y = event.clientY - obj[id].offsetTop;
        // console.log(event.clientX, event.clientY);
        console.log(obj[id].offsetLeft, obj[id].offsetTop);
        console.log(x, y);
        
        const moveObj = (e)=>{
            // mouse coordinates minus the initial offset
            console.log(e.clientX, e.clientY)
            console.log(e.clientX-x, e.clientY-y);

            obj[id].style.opacity = 0.6;

            obj[id].style.left = `${e.clientX - x}px`;
            console.log(obj[id].style.left);
            obj[id].style.top = `${e.clientY - y}px`;
            console.log(obj[id].style.top);
        }



        document.addEventListener("mousemove", moveObj);


        objBarr[id].addEventListener("mouseup", ()=>{
            document.removeEventListener("mousemove", moveObj);
            obj[id].style.opacity = 1;
            // objBarr.style.position = "relative";
        })
        body.addEventListener("mouseleave", ()=>{
            document.removeEventListener("mousemove", moveObj);
            obj[id].style.opacity = 1;
            // objBarr.style.position = "relative";
        })

        
    }

    function removeObj(i){
        obj[i].remove();
    }




</script> -->


<!-- <script>
    //manipulate iframe on mouse events
    const body = document.querySelector('body');
    var obj = document.querySelectorAll('.obj');


    // console.log(obj);

    obj.forEach(w => {
        var bar = w.querySelector('.objbar');
        var close = w.querySelector('span');
        let prevActive;
        
            // console.log(w.offsetLeft, w.offsetTop);


            close.addEventListener('click', ()=>{
                w.remove();
            });

            w.addEventListener('mousedown', ()=>{


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
                
                
                objBarr.style.position = "relative";
                })
                body.addEventListener("mouseleave", ()=>{
                    
                    document.removeEventListener("mousemove", moveObj);
                    w.style.opacity = 1;
                    
                    // objBarr.style.position = "relative";
                })
            

            


            });
        });
</script>

<script>
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
    
</script>
<!-- <script src="../js/loculus.js"></script> -->

</html>