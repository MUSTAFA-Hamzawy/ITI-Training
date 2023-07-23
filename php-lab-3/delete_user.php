<?php
$username = $_GET['username'] ;
if($username){
    $users = file("users.txt", FILE_IGNORE_NEW_LINES);
    foreach($users as $key => $line){
        if(strpos($line, "$username;") !== false){
            // removing this line from the file
            $image = explode(';', $line)[6];
            unset($users[$key]);
            unlink(__DIR__ . "\\" . $image); // Removing the image from the folder
            $data = implode(PHP_EOL, $users);
            file_put_contents('users.txt', $data);
        }

    }

    $redirection_location = "data_table.php";
    header("location:$redirection_location");

}

?>