<?php
require_once "connect.php";

$errors = isset($_GET['errors'])? unserialize(urldecode($_GET['errors'])): [];


$user_id = $_GET['id'];
if($username !== null){
  $query = "SELECT id, name, email, image FROM users WHERE id = :user_id";
  $stmt = $connect->prepare($query);
  $stmt->bindParam(':user_id', $user_id);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if($user == null){
    echo "<h1>User not found</h1>";
    die;
  }
  $id = $user['id'];
  $name = $user['name'];
  $email = $user['email'];
  $image = $user['image'];
  
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit User Data</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form action=<?php echo "edit_user.php?id=$id" ?> method="post" enctype="multipart/form-data">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="<?php if($name) echo $name ?>">
    <strong style='color: red'><?php if(isset($errors["name"])) echo $errors["name"] ?></strong><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php if($email) echo $email ?>">
    <strong style='color: red'><?php if(isset($errors["email"])) echo $errors["email"] ?></strong><br>

    <br>
    <label for="image">Image</label>
    <input type="file" id="image" name="image" value="<?php if($image) echo $image ?>">
    <strong style='color: red'><?php if(isset($errors["image"])) echo $errors["image"] ?></strong><br>

    <input type="submit" value="Submit">
  </form>
</body>
</html>