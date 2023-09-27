<?php
    require_once("controller.php");

$file_name = $_POST['fileName'];
$new_content = $_POST['content'];


$statement = "SELECT * FROM  resources a JOIN directory_resource b on a.resource_id = b.resource_id JOIN directories c ON b.directory_id = c.directory_id WHERE a.resource_name = '$file_name'";
// echo $statement;
$results = $user->manage_sql($statement);

$row = $results->fetch(PDO::FETCH_ASSOC);

// File path
$filePath = "../".$row['path']. "/" .$file_name;


// Write the new content to the file, overwriting the old content
file_put_contents($filePath, $new_content);

echo $filePath;

echo "File content has been overwritten.";
?>
