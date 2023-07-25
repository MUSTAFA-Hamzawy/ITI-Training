<?php $errors = isset($_GET['errors'])? unserialize(urldecode($_GET['errors'])): [] ?>

<!DOCTYPE html>
<html>
<head>
  <title>User Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <form action="add_user.php" method="post" enctype="multipart/form-data">
    <h1>Add User</h1>
    
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">
    <strong style='color: red'><?php if(isset($errors["name"])) echo $errors["name"] ?></strong><br>

    <br>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <strong style='color: red'><?php if(isset($errors["username"])) echo $errors["username"] ?></strong><br>

    <br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email">
    <strong style='color: red'><?php if(isset($errors["email"])) echo $errors["email"] ?></strong><br>

    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <strong style='color: red'><?php if(isset($errors["password"])) echo $errors["password"] ?></strong><br>

    <br>
    <label for="room">Room No.</label>
    <select id="room" name="room">
      <option value="Application1">Application1</option>
      <option value="Application2">Application2</option>
      <option value="Application3">Application3</option>
    </select>

    <br>
    <label for="exit">Exit:</label>
    <input type="text" id="exit" name="exit" value="Exit">

    <br>
    <label for="image">Profile Picture:</label>
    <input type="file" name="image" id="image">
    <strong style='color: red'><?php if(isset($errors["image"])) echo $errors["image"] ?></strong><br>
    <br>
    <label for="code">Please Enter This Code:1234</label>
    <input type="text" id="code" name="code" required>

    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
  </form>
</body>
</html>