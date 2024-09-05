<?php
session_start();

$id = $_SESSION['id'];

require "connection.php";

header('Content-Type: application/json');

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}

header('Content-Type: application/json');

$sem = isset($_GET['sem']) ? $_GET['sem'] : null;

if ($sem) {
    $tableName = "sem" . intval($sem);
    try {
        $stmt = $pdo->prepare("SELECT * FROM $tableName WHERE id = ?");
        $stmt->execute([$id]);
        $marks = $stmt->fetch();

        if ($marks) {
            echo json_encode(['marks' => $marks]);
        } else {
            echo json_encode(['error' => 'No data found']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid parameters']);
}
?>
