<?php
require_once "connect.php";

$user_id = $_GET['id'] ;
if($user_id){
    try {
        $query = "SELECT image FROM users WHERE id = :user_id";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $image = $result['image'];
        unlink(__DIR__ . "\\" . $image); // Removing the image from the folder

        $query = "DELETE FROM users WHERE id = :user_id";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        
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