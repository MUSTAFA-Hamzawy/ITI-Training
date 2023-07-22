<?php
$username = $_GET['username'];
if($username !== null){
    $users = file("customers.txt", FILE_IGNORE_NEW_LINES);
    foreach($users as $key => $line){
        if(strpos($line, $username) !== false){
            // removing this line from the file
            $old_data = explode(';', $line);
            $fname = $old_data[0];
            $lname = $old_data[1];
            $email = $old_data[2];
            $useranme = $old_data[7];
            

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
  <form action=<?php echo "edit_user.php?username=$username" ?> method="post">
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname" value="<?php echo $fname ?>">

    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname" value="<?php echo $lname ?>">

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php echo $email ?>">

    <br>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $useranme ?>">

    <input type="submit" value="Submit">
  </form>
</body>
</html>