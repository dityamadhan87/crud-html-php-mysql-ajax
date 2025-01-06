<?php
require_once '../AccessDatabase.php';
global $pdo;

$menuId = $_POST['menuId'] ?? null;
$menuName = $_POST['menuName'] ?? null;
$menuPrice = $_POST['menuPrice'] ?? null;
$action = $_GET['action'] ?? $_POST['action'] ?? null;

header('Content-Type: application/json');

try {
    if($action == 'create'){
        $sql = "INSERT INTO menu (menuID, menuName, menuPrice) VALUES (:menuID, :menuName, :menuPrice)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'menuID' => $menuId, 
            'menuName' => $menuName, 
            'menuPrice' => $menuPrice,
        ]);
        echo json_encode(['status' => 'success', 'message' => 'Menu added successfully']);
    } else if($action == 'update'){
        $sql = "UPDATE menu SET menuName = :menuName, menuPrice = :menuPrice WHERE menuID = :menuID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'menuName' => $menuName,
            'menuPrice' => $menuPrice,
            'menuID' => $menuId
        ]);
        echo json_encode(['status' => 'success', 'message' => 'Menu updated successfully']);
    } else if($action == 'delete'){
        $sql = "DELETE FROM menu WHERE menuID = :menuID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['menuID' => $menuId]);
        echo json_encode(['status' => 'success', 'message' => 'Menu deleted successfully']);
    } else if($action == 'read'){
        $sql = "SELECT * FROM menu";
        $stmt = $pdo->query($sql);
        $menus = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($menus);
    }
    
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}