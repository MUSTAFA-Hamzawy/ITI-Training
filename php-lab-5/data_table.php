<?php
require_once "connect.php";

// Fetching the users data from the db
// $query = "select * from users";
// $stmt = $connect->query($query);
// $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$users = $database->select("users");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Data</title>
</head>
<style>
/* Basic table styling */
.styled-table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
    font-size: 14px;
}

.styled-table th,
.styled-table td {
    padding: 10px;
    text-align: left;
}

/* Alternating row background color */
.styled-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Header styles */
.styled-table th {
    background-color: #007bff;
    color: #fff;
}

/* Image column width */
.styled-table th:nth-child(4),
.styled-table td:nth-child(4) {
    width: 100px;
}

/* Edit - Delete column width */
.styled-table th:nth-child(5),
.styled-table td:nth-child(5) {
    width: 120px;
}

/* Edit and Delete link styling */
a.edit-link,
a.delete-link {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 5px;
    text-decoration: none;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

/* Edit link styles */
a.edit-link {
    background-color: #3498db;
}

/* Delete link styles */
a.delete-link {
    background-color: #e74c3c;
}

/* Hover styles */
a.edit-link:hover,
a.delete-link:hover {
    background-color: #2980b9;
}

/* Active styles (when the link is clicked) */
a.edit-link:active,
a.delete-link:active {
    background-color: #1c6ea4;
}
</style>

<body>

    <table class="styled-table">
        <tr class='styled-table'>
            <th>Name</th>
            <th>email</th>
            <th>Username</th>
            <th>Image</th>
            <th>Edit - Delete</th>
        </tr>
        < <?php foreach ($users as $user) : ?>
        <tr>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><img width='100' src='<?php echo $user['image']; ?>' alt='User Image'></td>
            <td>
                <a class="edit-link" href='edit_form.php?id=<?php echo $user['id']; ?>'>Edit</a>
                <a class="delete-link" href='delete_user.php?id=<?php echo $user['id']; ?>'>Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>