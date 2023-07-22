<?php
$username = $_GET['username'] ;
if($username){
    $users = file("customers.txt", FILE_IGNORE_NEW_LINES);
    foreach($users as $key => $line){
        if(strpos($line, $username) !== false){
            // removing this line from the file
            unset($users[$key]);
            $data = implode(PHP_EOL, $users);
            file_put_contents('customers.txt', $data);
        }

    }

    $redirection_location = "http://localhost/ITI-Training/php-lab-2/data_table.php";
    header("Location: $redirection_location");

}

?>