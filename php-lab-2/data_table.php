<?php

// fetching data from the file
$data = file("customers.txt");
echo "<table border='1'>";
echo "<tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>email</th>
        <th>address</th>
        <th>country</th>
        <th>Gender</th>
        <th>Skills</th>
        <th>Username</th>
        <th>Department</th>
        <th>Edit/Delete</th>
        <tr/>";

// preparing data
foreach($data as $line){
    if(trim($line) == '')
        continue;
    echo "<tr>";
    $one_user = explode(';', $line);
    $username = $one_user['7'];     // geeting the useranme
    foreach($one_user as $info) echo "<td>$info</td>";

    echo "<td><a href='edit_form.php?username=$username' >Edit</a> <a href='delete_user.php?username=$username' >Delete</a></td>";
    echo "</tr>";
}


echo "</table>";

?>