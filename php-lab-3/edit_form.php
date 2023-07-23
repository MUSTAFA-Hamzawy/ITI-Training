<?php
$errors = isset($_GET['errors'])? unserialize(urldecode($_GET['errors'])): [];


$username = $_GET['username'];
if($username !== null){
    $users = file("users.txt", FILE_IGNORE_NEW_LINES);
    foreach($users as $key => $line){
        if(strpos($line, $username) !== false){
            // removing this line from the file
            $old_data = explode(';', $line);
            $name = $old_data[3];
            $email = $old_data[2];
            $image = $old_data[6];
            

        }
    }
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit User Data</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form action=<?php echo "edit_user.php?username=$username" ?> method="post" enctype="multipart/form-data">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="<?php echo $name ?>">
    <strong style='color: red'><?php if(isset($errors["name"])) echo $errors["name"] ?></strong><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php echo $email ?>">
    <strong style='color: red'><?php if(isset($errors["email"])) echo $errors["email"] ?></strong><br>

    <br>
    <label for="image">Image</label>
    <input type="file" id="image" name="image" value="<?php echo $image ?>">
    <strong style='color: red'><?php if(isset($errors["image"])) echo $errors["image"] ?></strong><br>

    <input type="submit" value="Submit">
  </form>
</body>
</html>