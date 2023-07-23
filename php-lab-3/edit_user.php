<?php
// Updating the data
$username = $_GET['username'];
$new_image = $_FILES['image']['name'] != null ? $_FILES['image'] : null;

$errors = array();
// Form data
$new_name = !empty($_POST['name']) ? $_POST['name'] : $errors["name"] = "Name is required";
$new_email = !empty($_POST['email']) ? $_POST['email'] : $errors["email"] = "Email is required";


// validate email
// Second method
if(! filter_var($new_email, FILTER_VALIDATE_EMAIL)) $errors["email"] = "Invalid Email";


// Image
if($new_image != null){
    $image_name = $_FILES['image']['name'];
    $image_temp_name = $_FILES['image']['tmp_name'];
    $extension = pathinfo($image_name)['extension'];
    $img_new_name = "images\\" . time() . "." . $extension;

    if(in_array($extension, array('png', 'jpg', 'jpeg', 'gif', 'png', 'PNG'))){
        move_uploaded_file($image_temp_name, $img_new_name);
    }else{
        echo $errors["image"] = "This extension is not allowed. Allowed Extensions => [png, jpg, jpeg, gif]";
    }

}

// redirect if there is any error
if($errors != array()){
    $redirection_location = "edit_form.php?username=$username&errors=" . urlencode(serialize($errors));
    header("location:$redirection_location");die;
}


// Editting the data
$users = file("users.txt", FILE_IGNORE_NEW_LINES);
foreach($users as $key => $line){
    if(strpos($line, "$username;") !== false){
        $old_data = explode(';', $line);

        if($new_image != null){
            $new_data = "\n$username;$old_data[1];$new_email;$new_name;$old_data[4];$old_data[5];$img_new_name";

            // removing the old image form the folder
            unlink(__DIR__ . "\\" . $old_data[6]); // Removing the image from the folder

        }else{
            $new_data = "\n$username;$old_data[1];$new_email;$new_name;$old_data[4];$old_data[5];$old_data[6]\n";
        }

        // removing this line from the file
        $users[$key] = $new_data;
        $data = implode(PHP_EOL, $users);
        file_put_contents('users.txt', $data);
    }

}

$redirection_location = "data_table.php";
header("location:$redirection_location");

?>