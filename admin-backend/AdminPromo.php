<?php
require_once '../AccessDatabase.php';
global $pdo;

$promoType = $_POST['promoType'] ?? null;
$promoCode = $_POST['promoCode'] ?? null;
$startDate = $_POST['startDate'] ?? null;
$endDate = $_POST['endDate'] ?? null;
$percentDiscount = $_POST['percentDiscount'] ?? null;
$maxDiscount = $_POST['maxDiscount'] ?? null;
$minPurchase = $_POST['minPurchase'] ?? null;
$action = $_GET['action'] ?? $_POST['action'] ?? null;

try {
    if($action == 'create'){
        $sql = "INSERT INTO promo (promoType, promoCode, startDate, endDate, percentDiscount, maxDiscount, minPurchase) VALUES (:promoType, :promoCode, :startDate, :endDate, :percentDiscount, :maxDiscount, :minPurchase)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'promoType' => $promoType, 
            'promoCode' => $promoCode, 
            'startDate' => $startDate, 
            'endDate' => $endDate, 
            'percentDiscount' => $percentDiscount,
            'maxDiscount' => $maxDiscount,
            'minPurchase' => $minPurchase
        ]);
        echo json_encode(['status' => 'success', 'message' => 'Promo added successfully']);
    } else if($action == 'update'){
        $sql = "UPDATE promo SET promoType = :promoType, startDate = :startDate, endDate = :endDate, percentDiscount = :percentDiscount, maxDiscount = :maxDiscount, minPurchase = :minPurchase WHERE promoCode = :promoCode";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'promoType' => $promoType,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'percentDiscount' => $percentDiscount,
            'maxDiscount' => $maxDiscount,
            'minPurchase' => $minPurchase,
            'promoCode' => $promoCode
        ]);
        echo json_encode(['status' => 'success', 'message' => 'Promo updated successfully']);
    } else if($action == 'delete'){
        $sql = "DELETE FROM promo WHERE promoCode = :promoCode";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['promoCode' => $promoCode]);
        echo json_encode(['status' => 'success', 'message' => 'Promo deleted successfully']);
    } else if($action == 'read'){
        $sql = "SELECT * FROM promo";
        $stmt = $pdo->query($sql);
        $promos = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($promos);
    }
    
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}