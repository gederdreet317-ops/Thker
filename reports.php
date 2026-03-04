<?php
require_once 'config.php';
$from = $_GET['from'] ?? date('01/01/Y');
$to = $_GET['to'] ?? date('d/m/Y');
$type = $_GET['type'] ?? 'وارد';

// استعلام حسب النوع
if ($type == 'وارد') {
    $stmt = $pdo->prepare("SELECT * FROM incoming WHERE STR_TO_DATE(date, '%d/%m/%Y') BETWEEN STR_TO_DATE(?, '%d/%m/%Y') AND STR_TO_DATE(?, '%d/%m/%Y')");
    $stmt->execute([$from, $to]);
    $rows = $stmt->fetchAll();
} else {
    $stmt = $pdo->prepare("SELECT * FROM outgoing WHERE STR_TO_DATE(date, '%d/%m/%Y') BETWEEN STR_TO_DATE(?, '%d/%m/%Y') AND STR_TO_DATE(?, '%d/%m/%Y')");
    $stmt->execute([$from, $to]);
    $rows = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
... (تصميم HTML مع جدول يعرض $rows)