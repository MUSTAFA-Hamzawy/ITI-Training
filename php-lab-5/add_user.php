<?php

require_once "connect.php";


$secrect_code = '1234';
if (isset($_POST['code']) && $_POST['code'] === $secrect_code) {
    $errors = array();
    // Form data
    $name = !empty($_POST['name']) ? $_POST['name'] : $errors["name"] = "Name is required";
    $username = isset($_POST['username']) ? $_POST['username'] : $errors["username"] = "Username is required";
    $email = !empty($_POST['email']) ? $_POST['email'] : $errors["email"] = "Email is required";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $room = isset($_POST['room']) ? $_POST['room'] : "";

    // validate email
    // First Method
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if(preg_match($pattern, $email) != 1) $errors["email"] = "Invalid Email";

    // Second method
    // if(! filter_var($email, FILTER_VALIDATE_EMAIL)) $errors["email"] = "Invalid Email";


    // validate password
    $pswd_pattern = '/^[a-z0-9_]{8}$/';
    if(preg_match($pswd_pattern, $password) != 1) $errors["password"] = "Invalid Password.";



    // Image
    if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];
        $image_temp_name = $_FILES['image']['tmp_name'];
        $extension = pathinfo($image_name)['extension'];
        $img_new_name = "images\\" . time() . "." . $extension;

        if(in_array($extension, array('png', 'jpg', 'jpeg', 'gif', 'png', 'PNG'))){
            move_uploaded_file($image_temp_name, $img_new_name);
        }else{
            echo $errors["image"] = "This extension is not allowed. Allowed Extensions => [png, jpg, jpeg, gif]";
        }

    }else{
        echo $errors["image"] = "Image is required.";
    }

    // redirect if there is any error
    if($errors != array()){
        $redirection_location = "index.php?errors=" . urlencode(serialize($errors));
        header("location:$redirection_location");
        die;
    }
        

    // Store in db
    $inserted = $database->insert("users", ["name", "email", "username", "password", "room", "image"], [$name, $email, $username, $password, $room, $img_new_name]);
    
    if($inserted){
        $redirection_location = "data_table.php";
        header("Location: $redirection_location");
        die;
    }else{
        echo "<h1>Failed to add</h1>";
        die;
    }

} else {
    echo "<h2>Code is wrong. Please try again.</h2><br>";
}
?>