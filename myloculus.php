<?php
require_once 'authentication.php';

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $pass = $_SESSION['password'];
}

if(isset($_GET['del'])){
    //delete resource
    $resid = $_GET['resid'];
    $delstmt = "delete from resources where resource_id = $resid ";
    $user->manage_sql($delstmt);
}

// echo "hello";

$page = "myloculus";
// echo $page;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>My loculus</title>

    <script src="https://kit.fontawesome.com/766f30b49e.js" crossorigin="anonymous"></script>
</head>


<body>
   
    <div class="gap"></div>

    <div class="big-container">

        <?php
        
        
            // echo $page;
            if (isset($_GET['dir_id'])){
                $dir = $_GET['dir_id'];
                $stmt0 = "select * from directories where directory_id = $dir";
                $stmt = "select * from resources a inner join directory_resource b on a.resource_id = b.resource_id join directories c on c.directory_id = b.directory_id where c.directory_id = $dir";
            }else if (isset($_SESSION["id"])){
                $stmt0 = "select * from directories where directory_name = '$username'";
                $stmt = "select * from resources a inner join directory_resource b on a.resource_id = b.resource_id join directories c on c.directory_id = b.directory_id where c.directory_name = '{$username}'";
            }
            
            if (isset($stmt0) && isset($stmt)){
                $results0 = $user->manage_sql($stmt0);
                $row0 = $results0->fetch(PDO::FETCH_ASSOC);
                
                $_SESSION['dir_id'] = $row0['directory_id'];
                $_SESSION['dir_name'] = $row0['directory_name'];
                $_SESSION['dir_path'] = $row0['path'];


                $results = $user->manage_sql($stmt);
    

                ?>

                <div class="gap"></div>
                <h1><?php echo $_SESSION['dir_name']; ?></h1>
                <div class="gap"></div>

                <?php
                if ($results->rowCount()== 0){
                    echo "Empty folder";
                }
            
                
             ?>
             
                <div class="loculuscontainer">

                    <?php while($row = $results->fetch(PDO::FETCH_ASSOC)){ ?>

                    <div class="container">
                        <div class="iconcontainer">
                            <i class="fa-solid fa-file-pdf"></i>
                        </div>
                        <div class="itemcontainer">                
                            <div class="smalldescription">
                                <h4><?php echo $row["resource_name"];?></h4>
                                <p><?php echo $row["type"];?></p>
                                <p><?php echo $row["size"];?></p>
                                <p><?php echo $row["created_at"];?></p>
                            </div>
                            <!-- <div class="fading-bg"></div> -->
                            <div class="options">
                                <i class="fa-solid fa-chevron-down hint"></i>
                                <a href="#space" onclick="openFile('<?php echo './'.$row['path']; ?>', '<?php echo $row['resource_name']; ?>', '<?php echo $row['type']; ?>')"><i class="fa-solid fa-play"></i></a>
                                <a href="<?php echo './'.$row['path'] . '/' . $row['resource_name']; ?>" download><i class="fa-solid fa-download"></i></a>
                                <a href="#?del=del&resid=<?php echo $row['resource_id'];?>"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </div>
                    </div>
                            <?php   } }  ?>
                </div>
        
    </div>
        

</body>

<script >
    //search on page
    var item = document.getElementsByClassName("container");
    var info = document.getElementsByClassName("smalldescription");
    var bar = document.getElementById("bar");

    // bar.addEventListener('keyup', (e)=>{
    //     const data = e.target.value.toLowerCase();
    //     console.log(data);
        
    //     for(i=0; i<item.length; i++){
    //         if(info[i].textContent.toLowerCase().includes(data)){

    //             item[i].style.display = "flex"
    //         }
    //         else{
    //             item[i].style.display = "none"
    //         }
    //     }
    // })
</script>

<script>

    //set global prev_id to store the previous id used
    var prev_id = "";



    //show menu

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
    //             console.log(c.contains(b));
    //             if(c != b && c.contains(b) == false){
    //                 c.classList.remove('active');
    //                 prevMenu = c.querySelector('.objects');
    //                 prevContainer = c.querySelector('.objects > .popup-container');
    //                 prevMenu.classList.remove('active');
    //                 prevContainer.classList.remove('active');
    //             }
    //         });

            
    //         console.log(menu.getBoundingClientRect());
    //         console.log(window.innerHeight);

    //         var menuRect = menu.getBoundingClientRect();
    //         var viewport = window.innerWidth;

    //         //reposition the menu div whenever it exceeds the viewport width
    //         if(menuRect.x + menuRect.right >= viewport){
    //             menu.style.right = "2px";
    //         }

    //         b.classList.toggle('active');
    //         menu.classList.toggle('active');
    //         container.classList.toggle('active');

            

    //     });
    // });



    function sp(id){
        var popup = document.getElementById(id);
        console.log(id);
        popup.classList.toggle("active");
    }

    //show a popup according to its id
    function showpopup(id, notouch_id=""){

        //previous popup hidden if set and different from the current popup
        if(id != prev_id && prev_id != "" && prev_id !=notouch_id){
            console.log("gooooo");
            hidePrevPopup(prev_id);
        }

        console.log(id);
        var popup = document.getElementById(id);
        var container = document.getElementById("popup-container");

        if (popup.style.maxHeight != "500px"){
            popup.style.maxHeight = "500px";

            container.style.maxHeight = "500px";
            
            console.log(popup.style.maxHeight);
            console.log(container.style.maxHeight);
        }
        else{
            console.log("nope");
            popup.style.maxHeight = "0";
            container.style.maxHeight = "0";
            console.log(popup.style.maxHeight);
        }
        prev_id = id;
        console.log(prev_id);
    }

    //hide the previous popup
    function hidePrevPopup(prev_id){
        
        var popup = document.getElementById(prev_id);

        popup.style.maxHeight = "0";
    }

</script>

<script>
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
    
</script>



</html>