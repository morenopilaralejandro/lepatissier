<?php
require_once __DIR__ . '/../php/DbConnection.php';
$con = new DbConnection();
$link = $con->getConnection();
echo "test";
?>
