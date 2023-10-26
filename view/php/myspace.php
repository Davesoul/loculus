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

     <div class="objcontainer">
        <div class="obj">
            <div class="objbar up">
                <h6>The Art of Electronics ( PDFDrive ) yes</h6>
                <span><i class="fa-solid fa-close"></i></span>
            </div>
            <iframe src="image/booklists.txt" frameborder="0" sandbox=""></iframe>
            <br>
        </div>
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
            <iframe src="../../aesthetic.mp4" frameborder="0"></iframe>
            <!-- <audio controls autoplay>
                <source src="../../Directories/user_1/test2.wav" type="audio/wav">
                Your browser does not support the audio element.
            </audio>  -->
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

</script>
<!-- <script src="../js/loculus.js"></script> -->

</html>