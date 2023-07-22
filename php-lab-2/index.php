<?php $errors = isset($_GET['errors'])? unserialize(urldecode($_GET['errors'])): [] ?>

<!DOCTYPE html>
<html>
<head>
  <title>User Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php if(true) {
    foreach($errors as $error)
      echo "<strong style='color: red'>$error</strong><br>";
  } ?>
  <form action="request_logic.php" method="post">
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname">

    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname">

    <label for="email">Email:</label>
    <input type="text" id="email" name="email">

    <label for="address">Address:</label>
    <textarea id="address" name="address"></textarea>

    <label for="country">Select Country:</label>
    <select id="country" name="country">
      <option value="Egypt">Egypt</option>
      <option value="Iraq">Iraq</option>
      <option value="Palastine">Palastine</option>
      <option value="Saudi Arabia">Saudi Arabia</option>
      <option value="Algeria">Algeria</option>
    </select>

    <section>
      <label>Gender:</label>
      <input type="radio" id="male" name="gender" value="male">
      <label for="male">Male</label>
      <input type="radio" id="female" name="gender" value="female">
      <label for="female">Female</label>
    </section>
    <br>
    <section>
      <label>Skills:</label>
      <input type="checkbox" id="php" name="skills[]" value="PHP">
      <label for="php">PHP</label>
      <input type="checkbox" id="js" name="skills[]" value="JS">
      <label for="js">JS</label>
      <input type="checkbox" id="mysql" name="skills[]" value="MySql">
      <label for="mysql">MySql</label>
      <input type="checkbox" id="postgresql" name="skills[]" value="PostgreeSQL">
      <label for="postgresql">PostgreeSQL</label>
    </section>
    <br>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <br>
    <label for="department">Department:</label>
    <input type="text" id="department" name="department" value="OpenSource" readonly>

    <label for="code">Please Enter This Code:m#1234</label>
    <input type="text" id="code" name="code" required>

    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
  </form>
</body>
</html>