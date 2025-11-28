<?php
$config = include 'config.php';

try {
    $conn = new PDO(
        "mysql:host={$config['host']};dbname={$config['dbname']}",
        $config['username'],
        $config['password']
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successful<br>";
} catch (PDOException $e) {
    file_put_contents('db_errors.log', $e->getMessage(), FILE_APPEND);
    die("Connection failed: " . $e->getMessage());
}
?>
