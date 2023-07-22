<?php
// Updating the data
$username = $_GET['username'];
$new_fname = $_POST['fname'];
$new_lname = $_POST['lname'];
$new_email = $_POST['email'];
$new_username = $_POST['username'];

$users = file("customers.txt", FILE_IGNORE_NEW_LINES);
foreach($users as $key => $line){
    if(strpos($line, $username) !== false){
        $old_data = explode(';', $line);
        $new_data = "\n$new_fname;$new_lname;$new_email;$old_data[3];$old_data[4];$old_data[5];$old_data[6];$new_username;$old_data[7]";
        // removing this line from the file
        $users[$key] = $new_data;
        $data = implode(PHP_EOL, $users);
        file_put_contents('customers.txt', $data);
    }

}

$redirection_location = "http://localhost/ITI-Training/php-lab-2/data_table.php";
header("Location: $redirection_location");

?>