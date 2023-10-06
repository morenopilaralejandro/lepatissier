<?php
require_once __DIR__ . '/../php/class/Alle.php';
$alleObj = Alle::factory();
//$alleObj->insert(0, "asd", "asdasd");
$alleResult = $alleObj->getAlleByProdId(3);

while($row = $alleResult->fetch_assoc()) {
    $alleObj = new Alle(
        $row['alleId'], 
        $row['alleNameEn'],
        $row['alleNameEs']);
    print_r($alleObj);
    //print_r($alleObj);
    //print_r($alleObj->getAlleId());
    echo "<br>";
}
echo "test";
?>
