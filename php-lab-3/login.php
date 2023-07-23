<?php 

session_start();

if(!empty($_SESSION['email'])){
    $location = "welcome.php";
    header("location:$location");
    exit;
}

$error =  isset($_GET['error']) ? $_GET['error'] : null;


?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f1f1f1;
}

.login-container {
    max-width: 300px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-container h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

.err{
    color: red;
    text-align: center;
}

</style>
<body>
    <div class="login-container">
        
        <h2>Login</h2>
        <form action="authenticate_user.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <strong class="err" ><?php if($error) echo  $error ?></strong><br>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
