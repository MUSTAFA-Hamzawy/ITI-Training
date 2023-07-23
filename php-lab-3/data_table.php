<?php

// fetching data from the file
$data = file("users.txt");
echo "<table border='1'>";
echo "<tr class='styled-table'>
        <th>Name</th>
        <th>email</th>
        <th>Username</th>
        <th>Image</th>
        <th>Edit - Delete</th>
        <tr/>";

// preparing data
foreach($data as $line){
    if(trim($line) == '')
        continue;
    echo "<tr>";
    $one_user = explode(';', $line);
    $username = $one_user[0];
    $email = $one_user[2];
    $name = $one_user[3];
    $image = $one_user[6];
    
    // show data
    echo "<td>$name</td>";
    echo "<td>$email</td>";
    echo "<td>$username</td>";
    echo
    "<td>
    
        <img width='100' src='$image' alt='User Image'>
    
    </td>";

    echo "<td><a href='edit_form.php?username=$username' >Edit</a> <a href='delete_user.php?username=$username' >Delete</a></td>";
    echo "</tr>";
}


echo "</table>";

?>