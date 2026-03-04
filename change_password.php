<?php
session_start();
require_once 'config.php';
$message = '';
if ($_POST) {
    $old = md5($_POST['old']);
    $new = md5($_POST['new']);
    $confirm = md5($_POST['confirm']);
    // التحقق من القديم
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username='admin' AND password=?");
    $stmt->execute([$old]);
    if ($stmt->rowCount() == 0) {
        $message = "كلمة المرور القديمة غير صحيحة";
    } elseif ($new !== $confirm) {
        $message = "كلمة المرور الجديدة غير متطابقة";
    } else {
        $pdo->prepare("UPDATE users SET password=? WHERE username='admin'")->execute([$new]);
        $message = "تم التغيير بنجاح";
    }
}
?>
...