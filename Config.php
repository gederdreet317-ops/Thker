<?php
$host = 'localhost';      // أو 127.0.0.1
$dbname = 'archive';
$user = 'root';           // مستخدم KSWeb الافتراضي
$pass = '';               // كلمة مرور KSWeb غالباً فارغة

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("فشل الاتصال: " . $e->getMessage());
}
?>