<?php 


if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $users = file("users.txt", FILE_IGNORE_NEW_LINES);

    if(count($users) == 0){
        $error = "Invalid Credentials.";
        $redirection_location = "login.php?error=$error";
        header("location:$redirection_location");
        exit;
    }

    foreach($users as $key => $line){
        if(strpos($line, $email) !== false){
            $data = explode(';', $line);
            if($email == $data[2] && $password == $data[1]){

                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $data[0];
                $_SESSION['name'] = $data[3];
                $_SESSION['room'] = $data[4];
                $_SESSION['image'] = $data[6];

                $redirection_location = "welcome.php";
                header("location:$redirection_location");exit;

            }else{
                $error = "Invalid Credentials.";
                $redirection_location = "login.php?error=$error";
                header("location:$redirection_location");exit;
            }

    }

}
}
else{
    $error = "Please, write correct info.";
    $redirection_location = "login.php?error=$error";
    header("location:$redirection_location");exit;
}