<?php
require 'config/db.php';
$errors = []; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']); 
    $email = trim($_POST['email']);
    
    if (empty($name)) {
        $errors[] = "Name cannot be empty";
    } elseif (!preg_match("/^[\p{L}\-' ]+$/u", $name)) {
        $errors[] = "Name can only contain letters, spaces, apostrophes and hyphens";
    }
    
    if (empty($email)) {
        $errors[] = "Email cannot be empty";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || stripos($email, '.com') === false) {
        $errors[] = "Email must be in valid format and contain .com";
    }
    
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->execute([$name, $email]);
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
        <h2>Add New User</h2>
        
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
            <input type="text" id="name" name="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
            
            <button type="submit" class="form-btn">Add User</button>
        </form>
        
        <a href="read.php" class="back-link">Back to list</a>
    </div>
</body>
</html>