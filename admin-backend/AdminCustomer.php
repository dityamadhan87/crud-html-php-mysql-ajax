<?php
require_once '../AccessDatabase.php';
global $pdo;

$customerType = $_POST['customerType'] ?? null;
$customerId = $_POST['customerId'] ?? null;
$customerName = $_POST['customerName'] ?? null;
$memberDate = $_POST['memberDate'] ?? null;
$openingBalance = $_POST['openingBalance'] ?? null;
$action = $_GET['action'] ?? $_POST['action'] ?? null;

header('Content-Type: application/json');

try {
    if ($action === 'create') {
        $sql = "INSERT INTO customer (customerType, customerID, customerName, memberDate, openingBalance) 
                VALUES (:customerType, :customerID, :customerName, :memberDate, :openingBalance)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'customerType' => $customerType,
            'customerID' => $customerId,
            'customerName' => $customerName,
            'memberDate' => $memberDate,
            'openingBalance' => $openingBalance,
        ]);
        echo json_encode(['status' => 'success', 'message' => 'Customer added successfully']);
    } elseif ($action === 'read') {
        $sql = "SELECT * FROM customer";
        $stmt = $pdo->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($customers);
    } elseif ($action === 'delete'){
        $sql = "DELETE FROM customer WHERE customerID = :customerID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['customerID' => $customerId]);
        echo json_encode(['status' => 'success', 'message' => 'Customer deleted successfully']);
    } elseif ($action === 'update'){
        $sql = "UPDATE customer SET customerType = :customerType, customerName = :customerName, 
                memberDate = :memberDate, openingBalance = :openingBalance WHERE customerID = :customerID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'customerType' => $customerType,
            'customerName' => $customerName,
            'memberDate' => $memberDate,
            'openingBalance' => $openingBalance,
            'customerID' => $customerId,
        ]);
        echo json_encode(['status' => 'success', 'message' => 'Customer updated successfully']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}