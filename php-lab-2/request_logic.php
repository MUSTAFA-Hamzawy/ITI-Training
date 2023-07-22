<?php

$secrect_code = 'm#1234';
if (isset($_POST['code']) && $_POST['code'] === $secrect_code) {
    $errors = array();
    // Form data
    $fname = !empty($_POST['fname']) ? $_POST['fname'] : $errors[] = "First Name is required";
    $lname = !empty($_POST['lname']) ? $_POST['lname'] : $errors[] = "Last Name is required";
    $email = !empty($_POST['email']) ? $_POST['email'] : $errors[] = "Email is required";
    $address = isset($_POST['address']) ? $_POST['address'] : "Empty Field";
    $country = isset($_POST['country']) ? $_POST['country'] : "Empty Field";
    $gender = isset($_POST['gender']) ? $_POST['gender'] : $errors[] = "Gender is required";
    $skills = isset($_POST['skills']) ? $_POST['skills'] : 'Empty Field';
    $username = isset($_POST['username']) ? $_POST['username'] : "Empty Field";
    $password = isset($_POST['password']) ? $_POST['password'] : "Empty Field";
    $department = isset($_POST['department']) ? $_POST['department'] : "Empty Field";

    // redirect if there is any error
    if($errors != array()){
        $redirection_location = "http://localhost/ITI-Training/php-lab-2?errors=" . urlencode(serialize($errors));
        header("Location: $redirection_location");die;
    }
        

    // Store in file
    $file = fopen('customers.txt', 'a');
    $skills_as_string = implode(',', $skills);
    $user_data = "$fname;$lname;$email;$address;$country;$gender;$skills_as_string;$username;$department\n";

    fwrite($file, $user_data);
    fclose($file);

    echo "<h1>Written to the file successfully</h1>";

    $redirection_location = "http://localhost/ITI-Training/php-lab-2/data_table.php";
    header("Location: $redirection_location");


} else {
    echo "<h2>Code is wrong. Please try again.</h2><br>";
}
?>