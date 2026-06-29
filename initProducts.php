<?php
$vModulePath = "AdminCMS/Module/";
include_once $vModulePath . "Data.php";

$host = '127.0.0.1';
$db   = 'sabbagh_site';  
$user = 'root';          
$pass = 'RootPass';      
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database Connection failed: " . $e->getMessage());
}

$totalCats = count($aCats);
$totalProds = 0;
foreach ($aCats as $cat) {
    $totalProds += count($cat['aProducts'] ?? []);
}
echo "<h3>Debug Info</h3>";
echo "Total Categories found: <b>{$totalCats}</b><br>";
echo "Total Products found: <b>{$totalProds}</b><br>";

if ($totalCats === 0) {
    die("<b style='color:red;'>STOPPED: Your \$aCats array is empty! Please paste your array data into the script.</b>");
}

$pdo->beginTransaction();
try {
    // CHANGED TO "REPLACE INTO" to safely overwrite if IDs already exist
    $stmtCat = $pdo->prepare("
        REPLACE INTO ecom_cat (id, status_id, `order`, wdays, name1, name2, image, descrip) 
        VALUES (:id, :status_id, :order, :wdays, :name1, :name2, :image, :descrip)
    ");
    
    $stmtProd = $pdo->prepare("
        REPLACE INTO ecom_product (id, mnum, brand_id, status_id, cat_id, tag_id, name1, name2, qnt, price, cprice, desc1, desc2, desc3, desc4, desc5, image) 
        VALUES (:id, :mnum, :brand_id, :status_id, :cat_id, :tag_id, :name1, :name2, :qnt, :price, :cprice, :desc1, :desc2, :desc3, :desc4, :desc5, :image)
    ");

    foreach ($aCats as $index => $cat) {
        $stmtCat->execute([
            ':id'        => $cat['Id'],
            ':status_id' => 1,
            ':order'     => $index + 1,
            ':wdays'     => 365,
            ':name1'     => $cat['Name'],
            ':name2'     => '',
            ':image'     => $cat['Image'],
            ':descrip'   => ''
        ]);
        
        $currentCatId = $cat['Id'];
        
        if (!empty($cat['aProducts'])) {
            foreach ($cat['aProducts'] as $prod) {
                $stmtProd->execute([
                    ':id'        => $prod['Id'],
                    ':mnum'      => $prod['Id'], 
                    ':brand_id'  => 0,
                    ':status_id' => 1,
                    ':cat_id'    => $currentCatId, 
                    ':tag_id'    => 0,
                    ':name1'     => $prod['Name'],
                    ':name2'     => '',
                    ':qnt'       => 0.00,
                    ':price'     => 0.00,
                    ':cprice'    => 0.00,
                    ':desc1'     => '',
                    ':desc2'     => '',
                    ':desc3'     => '',
                    ':desc4'     => '',
                    ':desc5'     => '',
                    ':image'     => $prod['Image']
                ]);
            }
        }
    }
    
    $pdo->commit();
    echo "<br><b style='color:green;'>Success: Categories and Products inserted/updated successfully!</b>";
    
} catch (Exception $e) {
    $pdo->rollBack();
    echo "<br><b style='color:red;'>Failed: " . $e->getMessage() . "</b>";
}

?>