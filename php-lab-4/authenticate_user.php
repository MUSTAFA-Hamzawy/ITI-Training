<?php 

require_once "connect.php";

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user != null){
        $fetched_email = $user['email'];
        $fetched_password = $user['password'];

        if($email == $fetched_email && $password == $fetched_password){

            session_start();
            $_SESSION['user_id'] =  $user['id'];
            $_SESSION['email'] =  $user['email'];
            $_SESSION['username'] =  $user['username'];
            $_SESSION['name'] =  $user['name'];
            $_SESSION['room'] =  $user['room'];
            $_SESSION['image'] =  $user['image'];

            $redirection_location = "welcome.php";
            header("location:$redirection_location");exit;

        }else{
            $error = "Invalid Credentials.";
            $redirection_location = "login.php?error=$error";
            header("location:$redirection_location");exit;
        }

    }else{
        $error = "Invalid Credentials.";
        $redirection_location = "login.php?error=$error";
        header("location:$redirection_location");
        exit;
    }
}
else{
    $error = "Please, write correct info.";
    $redirection_location = "login.php?error=$error";
    header("location:$redirection_location");exit;
}