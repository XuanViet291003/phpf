<?php
require 'config/db.php';
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="read.css">
</head>
<body>
    <h2>List user</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Function</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td>
                <a href="update.php?id=<?php echo $user['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $user['id']; ?>" 
                onclick="return confirm('Are you sure delete?')" class="delete-link">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="create.php" class="add-new">Add new user</a>
</body>
</html>