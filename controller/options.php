<?php

require_once("controller.php");


if (isset($_SESSION["dir_id"])){
    $dir_id = $_SESSION["dir_id"];

    if ($_SESSION['perm_id'] == 1){
        if ($_SESSION['dir_name'] == 'user_'.$_SESSION['id']){ ?>


            <div id="more-options" class="btn">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                <div id="options-menu" class="objects">
                    <div class="objbar up"></div>
                    <ul class="popup-container">
                        <li><a href="#loculusTop" id="plus" onclick="modal_popup('plus')"><i class="fa-solid fa-plus"></i>Import</a></li>
                        <li><a href="#loculusTop" id="newL" onclick="modal_popup('newL')"><i class="fa-solid fa-folder-plus"></i>New loculus</a></li>
                        <!-- <li><a href="#" id = 'share' onclick="modal_popup('share')"><i class="fa-solid fa-share-nodes"></i>Share loculus</a></li> -->
                        <!-- <li><a href="#" id = 'del' onclick="modal_popup('del')"><i class="fa-solid fa-trash-can"></i>Delete loculus</a></li> -->
                        <li><a href="#loculusTop" id="chTheme" onclick="modal_popup('chTheme')"><i class="fa-solid fa-moon"></i>theme</a></li>
                    </ul>
                    <div class="objbar down"></div>
                </div>
            </div>


            <?php
        } else {
            
            ?>
            <div id="more-options" class="btn">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                <div id="options-menu" class="objects">
                    <div class="objbar up"></div>
                    <ul class="popup-container">
                        <li><a href="#loculusTop" id="plus" onclick="modal_popup('plus')"><i class="fa-solid fa-plus"></i>Import</a></li>
                        <li><a href="#loculusTop" id="newL" onclick="modal_popup('newL')"><i class="fa-solid fa-folder-plus"></i>New loculus</a></li>
                        <li><a href="#loculusTop" id = 'share' onclick="modal_popup('share')"><i class="fa-solid fa-share-nodes"></i>Share loculus</a></li>
                        <li><a href="#loculusTop" id = 'del' onclick="modal_popup('del')"><i class="fa-solid fa-trash-can"></i>Delete loculus</a></li>
                        <li><a href="#loculusTop" id="chTheme" onclick="modal_popup('chTheme')"><i class="fa-solid fa-moon"></i>theme</a></li>
                    </ul>
                    <div class="objbar down"></div>
                </div>
            </div>

        <?php
        }
}   }
?>