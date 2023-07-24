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
$query = "UPDATE users SET name = :name, email = :email WHERE id = :user_id";
$stmt = $connect->prepare($query);
$stmt->bindParam(':name', $new_name);
$stmt->bindParam(':email', $new_email);
if($new_image){
    $stmt->bindParam(':image', $img_new_name);

    // remove the old image
    $query = "SELECT image FROM users WHERE id = :user_id";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $image = $result['image'];
    unlink(__DIR__ . "\\" . $image); // Removing the image from the folder
}

$stmt->bindParam(':user_id', $user_id);
$stmt->execute();

$redirection_location = "data_table.php";
header("location:$redirection_location");

?>