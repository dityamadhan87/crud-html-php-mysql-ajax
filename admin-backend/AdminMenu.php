<?php
require_once '../AccessDatabase.php';
global $pdo;

$menuId = $_GET['menuId'];
$menuName = $_GET['menuName'];
$menuPrice = $_GET['menuPrice'];
$action = $_GET['action'];

try {
    if($action == 'create'){
        $sql = "INSERT INTO menu (menuID, menuName, menuPrice) VALUES (:menuID, :menuName, :menuPrice)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'menuID' => $menuId, 
            'menuName' => $menuName, 
            'menuPrice' => $menuPrice,
        ]);
        echo "Menu added successfully";
    } else if($action == 'update'){
        $sql = "UPDATE menu SET menuName = :menuName, menuPrice = :menuPrice WHERE menuID = :menuID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'menuName' => $menuName,
            'menuPrice' => $menuPrice,
            'menuID' => $menuId
        ]);
        echo "Menu updated successfully";
    } else if($action == 'delete'){
        $sql = "DELETE FROM menu WHERE menuID = :menuID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['menuID' => $menuId]);
        echo "Menu deleted successfully";
    } else if($action == 'read'){
        $sql = "SELECT * FROM menu";
        $stmt = $pdo->query($sql);
        $menus = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo "<table border='1' style='width: 50%;'>
                <thead>
                    <tr>
                        <th>Menu ID</th>
                        <th>Menu Name</th>
                        <th>Menu Price</th>
                    </tr>
                </thead>
            ";
        echo "<tbody>";
        foreach($menus as $menu){
            echo "<tr>
                    <td>$menu->menuID</td>
                    <td>$menu->menuName</td>
                    <td>$menu->menuPrice</td>
                </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
    
} catch (PDOException $e) {
    echo $e->getMessage();
}