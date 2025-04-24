<?php
$host = 'localhost';
$dbname = 'crud_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// try {
//     $pdo = new PDO("mysql:host=$host;db_name=$dbname",$username,$password);
// }
// catch(PDOException $e){
//     echo "Connection Failed" .$e->getMessage();
// }
?>