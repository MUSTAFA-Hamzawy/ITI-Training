<?php
$secrect_code = 'm#1234';
if (isset($_POST['code']) && $_POST['code'] === $secrect_code) {
    // Form data
    $fname = isset($_POST['fname']) ? $_POST['fname'] : "Empty Field";
    $lname = isset($_POST['lname']) ? $_POST['lname'] : "Empty Field";
    $address = isset($_POST['address']) ? $_POST['address'] : "Empty Field";
    $country = isset($_POST['country']) ? $_POST['country'] : "Empty Field";
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "Empty Field";
    $skills = isset($_POST['skills']) ? $_POST['skills'] : 'Empty Field';
    $username = isset($_POST['username']) ? $_POST['username'] : "Empty Field";
    $password = isset($_POST['password']) ? $_POST['password'] : "Empty Field";
    $department = isset($_POST['department']) ? $_POST['department'] : "Empty Field";

    // Output data based on gender
    if ($gender === 'male') {
        echo "Thanks Mr. $fname $lname<br>";
    } elseif ($gender === 'female') {
        echo "Thanks Mrs. $fname $lname<br>";
    }

    // Output the form data
    echo "<h2>Please Review Your Info. </h2>";
    echo "Address: $address<br>";
    echo "Country: $country<br>";
    echo "Skills: <br>";
    foreach($skills as $key => $value)
        echo "$value <br>";
    echo "Username: $username<br>";
    echo "Department: $department<br>";
} else {
    echo "<h2>Code is wrong. Please try again.</h2><br>";
}
?>