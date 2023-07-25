<?php
require_once "connect.php";

$user_id = $_GET['id'] ;
if($user_id){
    try {
        $user = $database->selectWhere("users", "id", $user_id)[0];
        $image = $user['image'];
        unlink(__DIR__ . "\\" . $image); // Removing the image from the folder

        $database->delete("users", $user_id);
        
        $redirection_location = "data_table.php";
        header("Location: $redirection_location");
        die;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    $redirection_location = "data_table.php";
    header("Location: $redirection_location");
    die;
}


?>