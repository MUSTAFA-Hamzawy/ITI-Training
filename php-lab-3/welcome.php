<?php
session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];


    $users = file("users.txt", FILE_IGNORE_NEW_LINES);
    foreach($users as $key => $line){
        if(strpos($line, $email) !== false){
            $data = explode(';', $line);
            $name = $data[2];
            $username = $data[0];
            $image = $data[6];
    }

}


} else {
    header("location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
</head>
<body>
    <h2>Welcome <?php echo $name; ?></h2>
    <h3>Profile Data</h3>
    <p>Username : <?php echo $username ?></p>
    <p>Email : <?php echo $email ?></p>
    <p>Image : <br> <img src="<?php echo $image ?>" alt="User image" width='200'> </p>
    <a href="logout.php">Logout</a>
</body>
</html>