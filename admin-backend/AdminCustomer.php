<?php
require_once '../AccessDatabase.php';
global $pdo;

$customerType = $_GET['customerType'];
$customerId = $_GET['customerId'];
$customerName = $_GET['customerName'];
$memberDate = $_GET['memberDate'];
$openingBalance = $_GET['openingBalance'];
$action = $_GET['action'];

try {
    if($action == 'create'){
        $sql = "INSERT INTO customer (customerType, customerID, customerName, memberDate, openingBalance) VALUES (:customerType, :customerID, :customerName, :memberDate, :openingBalance)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'customerType' => $customerType, 
            'customerID' => $customerId, 
            'customerName' => $customerName, 
            'memberDate' => $memberDate, 
            'openingBalance' => $openingBalance
        ]);
        echo "Customer added successfully";
    } else if($action == 'update'){
        $sql = "UPDATE customer SET customerType = :customerType, customerName = :customerName, memberDate = :memberDate, openingBalance = :openingBalance WHERE customerID = :customerID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'customerType' => $customerType,
            'customerName' => $customerName,
            'memberDate' => $memberDate,
            'openingBalance' => $openingBalance,
            'customerID' => $customerId
        ]);
        echo "Customer updated successfully";
    } else if($action == 'delete'){
        $sql = "DELETE FROM customer WHERE customerID = :customerID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['customerID' => $customerId]);
        echo "Customer deleted successfully";
    } else if($action == 'read'){
        $sql = "SELECT * FROM customer";
        $stmt = $pdo->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo "<table border='1' style='width: 50%;'>
                <thead>
                    <tr>
                        <th>Customer Type</th>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Member Date</th>
                        <th>Opening Balance</th>
                    </tr>
                </thead>
            ";
        echo "<tbody>";
        foreach($customers as $customer){
            echo "<tr>
                    <td>$customer->customerType</td>
                    <td>$customer->customerID</td>
                    <td>$customer->customerName</td>
                    <td>$customer->memberDate</td>
                    <td>$customer->openingBalance</td>
                </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
    
} catch (PDOException $e) {
    echo $e->getMessage();
}