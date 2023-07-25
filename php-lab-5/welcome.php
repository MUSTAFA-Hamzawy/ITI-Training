<?php
require_once "connect.php";
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $user = $database->selectWhere("users", "id", $user_id)[0];
    $name = $user['name'];
    $username = $user['username'];
    $image = $user['image'];
    $email = $user['email'];


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