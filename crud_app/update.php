<?php
require 'config/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: read.php");
    exit;
}

$errors = []; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (empty($name)) {
        $errors[] = "Name cannot be empty";
    } elseif (!preg_match("/^[a-zA-Z-' ]+$/", $name)) {
        $errors[] = "Name can only contain letters, spaces, apostrophes and hyphens";
    }

    if (empty($email)) {
        $errors[] = "Email cannot be empty";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || stripos($email, '@gmail.com') === false) {
        $errors[] = "Email must be in valid format and contain @gmail.com";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$name, $email, $id]);
        header("Location: read.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Update User</h2>
        
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" 
                   value="<?php echo isset($name) ? htmlspecialchars($name) : htmlspecialchars($user['name']); ?>" 
                   required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" 
                   value="<?php echo isset($email) ? htmlspecialchars($email) : htmlspecialchars($user['email']); ?>" 
                   required>
            
            <button type="submit" class="form-btn">Update User</button>
        </form>
        
        <a href="read.php" class="back-link">Back to list</a>
    </div>
</body>
</html>