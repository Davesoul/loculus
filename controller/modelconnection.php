<?php
if (stripos(__DIR__, "controller") !== false){
    require '../../model/model.php';
}else if (stripos(__DIR__, "view") !== false){
    require '../model/model.php';
}

?>