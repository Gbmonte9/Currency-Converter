<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'conversion_db';

try {
   
    $pdo = new PDO("mysql:host=$host;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

    $pdo->exec("USE `$dbname`");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS conversions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            amount DECIMAL(10,2) NOT NULL,
            from_currency VARCHAR(10) NOT NULL,
            to_currency VARCHAR(10) NOT NULL,
            converted_amount DECIMAL(10,2) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['amount'], $data['currencyFrom'], $data['currencyTo'], $data['convertedAmount'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid parameters.']);
        exit;
    }

    $amount = $data['amount'];
    $currencyFrom = strtoupper($data['currencyFrom']);
    $currencyTo = strtoupper($data['currencyTo']);
    $convertedAmount = $data['convertedAmount'];

    $stmt = $pdo->prepare("INSERT INTO conversions (amount, from_currency, to_currency, converted_amount) VALUES (?, ?, ?, ?)");
    $stmt->execute([$amount, $currencyFrom, $currencyTo, $convertedAmount]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro: ' . $e->getMessage()]);
}
?>