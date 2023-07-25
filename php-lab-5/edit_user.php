<?php
require_once "connect.php";

$user_id = $_GET['id'];
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
if($new_image){
    $fields = [
        "name" => $new_name,
        "email" => $new_email,
        "image" => $img_new_name
    ];
}else{
    $fields = [
        "name" => $new_name,
        "email" => $new_email
    ];
}


if($new_image){
    // remove the old image
    $user = $database->selectWhere("users", "id", $user_id)[0];
    $image = $user['image'];
    unlink(__DIR__ . "\\" . $image); // Removing the image from the folder
}


$database->update("users", $user_id, $fields);
$redirection_location = "data_table.php";
header("location:$redirection_location");

?>