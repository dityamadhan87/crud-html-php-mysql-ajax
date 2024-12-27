<?php
require_once '../AccessDatabase.php';
global $pdo;

$promoType = $_GET['promoType'];
$promoCode = $_GET['promoCode'];
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];
$percentDiscount = $_GET['percentDiscount'];
$maxDiscount = $_GET['maxDiscount'];
$minPurchase = $_GET['minPurchase'];
$action = $_GET['action'];

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
        echo "Promo added successfully";
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
        echo "Promo updated successfully";
    } else if($action == 'delete'){
        $sql = "DELETE FROM promo WHERE promoCode = :promoCode";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['promoCode' => $promoCode]);
        echo "Promo deleted successfully";
    } else if($action == 'read'){
        $sql = "SELECT * FROM promo";
        $stmt = $pdo->query($sql);
        $promos = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo "<table border='1' style='width: 50%;'>
                <thead>
                    <tr>
                        <th>Promo Type</th>
                        <th>Promo Code</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Percent Off</th>
                        <th>Max Discount</th>
                        <th>Min Purchase</th>
                    </tr>
                </thead>
            ";
        echo "<tbody>";
        foreach($promos as $promo){
            echo "<tr>
                    <td>$promo->promoType</td>
                    <td>$promo->promoCode</td>
                    <td>$promo->startDate</td>
                    <td>$promo->endDate</td>
                    <td>$promo->percentDiscount</td>
                    <td>$promo->maxDiscount</td>
                    <td>$promo->minPurchase</td>
                </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
    
} catch (PDOException $e) {
    echo $e->getMessage();
}