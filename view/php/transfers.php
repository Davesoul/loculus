<h1>Transfers</h1>
<?php

    $page = 'transfers';
    require_once("../../controller/controller.php");

    ?><h1>Transfers</h1><?php
        $statement = "SELECT * FROM transfers a LEFT JOIN users b ON a.user_id = b.user_id RIGHT JOIN users c ON a.destination_user_id = c.user_id JOIN resources d ON a.transfered_resource = d.resource_name WHERE a.destination_user_id = $id";

        // $statement = "SELECT * FROM transfers a LEFT JOIN users b ON a.user_id = b.user_id RIGHT JOIN users c ON a.destination_user_id = c.user_id JOIN resources d ON a.transfered_resource = d.resource_name WHERE a.destination_user_id = $id";
        // echo $statement;
        $results = $user->manage_sql($statement);

        
        if ($results->rowCount()== 0){
            echo "no file received";
        } else {
            ?>

<div class="loculuscontainer">

<?php while($row = $results->fetch(PDO::FETCH_ASSOC)){ ?>

<div class="container">
    <div class="iconcontainer">
        <?php if (stripos($row["type"], "pdf") !== false){ ?>
            <i class="fa-solid fa-file-pdf"></i>
        <?php } elseif (stripos($row["type"], "image") !== false){ ?>
            <i class="fa-solid fa-file-image"></i>
        <?php } elseif (stripos($row["type"], "audio") !== false){ ?>
            <i class="fa-solid fa-file-music"></i>
        <?php } elseif (stripos($row["type"], "video") !== false){ ?>
            <i class="fa-solid fa-file-video"></i>
            <?php } elseif (stripos($row["type"], "text") !== false || stripos($row["type"], "application") !== false){ ?>
            <i class="fa-solid fa-file-lines"></i>
        <?php } ?>
    </div>
    <div class="itemcontainer">                
        <div class="smalldescription">
            <h4><?php echo $row["resource_name"];?></h4>
            <p><?php echo $row["type"];?></p>
            <p><?php echo $row["size"]." MB"; ?></p>
            <p><?php echo $row["transfer_date"];?></p>
            
            <div class="gap"></div>
        </div>
        <!-- <div class="fading-bg"></div> -->
        <div class="options">
            <i class="fa-solid fa-chevron-down hint"></i>
            <p><?php echo $row["user_id"];?></p>

                    <a href="#loculus" onclick="acceptTransfer('../../controller/loculusoptions.php', <?php echo $row['transfer_id'] ?>, 1);
                        loadContent('transfers.php', '', '', 'modal-popup', 'GET');
                    " ><i class="fa-solid fa-check"></i></a>
                    <a href="#loculus" onclick="loadContent('../../controller/loculusoptions.php', 'acceptance', 0, 'modal-popup', 'GET');
                        loadContent('transfers.php', '', '', 'modal-popup', 'GET');
                    " ><i class="fa-solid fa-x"></i></a>
                  
        </div>
    </div>
</div>
        <?php   }  ?>
</div>

                <?php
            }
        

?>