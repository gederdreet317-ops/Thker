<?php
require_once 'config.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // إدخال جديد
    $stmt = $pdo->prepare("INSERT INTO incoming (date, number, financial_number, source, department, subject, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([
        $_POST['date'],
        $_POST['number'],
        $_POST['financial_number'],
        $_POST['source'],
        $_POST['department'],
        $_POST['subject'],
        $_POST['notes']
    ])) {
        $message = "تم الحفظ بنجاح";
    } else {
        $message = "حدث خطأ";
    }
}
// جلب آخر 10 سجلات للعرض (اختياري)
$incomings = $pdo->query("SELECT * FROM incoming ORDER BY id DESC LIMIT 10")->fetchAll();
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل البريد الوارد</title>
    <style>
        /* نفس الأنماط السابقة + تحسينات بسيطة */
        body { font-family: Tahoma; background: #f0f2f5; padding:20px; }
        .screen { background: white; border-radius:12px; padding:20px; }
        h2 { background: #2c3e50; color: white; padding:10px; margin:-20px -20px 20px; border-radius:12px 12px 0 0; }
        .form-group { margin-bottom:15px; }
        .form-group label { display:block; font-weight:bold; }
        input, textarea { width:100%; padding:8px; border:1px solid #ccc; border-radius:6px; }
        .btn-group { display:flex; gap:10px; margin-top:20px; flex-wrap:wrap; }
        .btn { padding:8px 16px; border:none; border-radius:6px; cursor:pointer; }
        .btn-success { background: #2ecc71; color:white; }
        .btn-primary { background: #3498db; color:white; }
        .btn-danger { background: #e74c3c; color:white; }
    </style>
</head>
<body>
<div class="screen">
    <h2>تسجيل البريد الوارد</h2>
    <div class="date-header">📅 <?php echo date('d/m/Y'); ?></div>

    <?php if ($message): ?>
        <div style="background:#d4edda; color:#155724; padding:10px; border-radius:6px;"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="post">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div>
                <div class="form-group">
                    <label>تاريخ الوارد</label>
                    <input type="text" name="date" value="<?php echo date('d/m/Y'); ?>" required>
                </div>
                <div class="form-group">
                    <label>رقم الوارد</label>
                    <input type="text" name="number" required>
                </div>
                <div class="form-group">
                    <label>الرقم المالي</label>
                    <input type="text" name="financial_number">
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label>الجهة الواردة منها</label>
                    <input type="text" name="source">
                </div>
                <div class="form-group">
                    <label>القسم</label>
                    <input type="text" name="department">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>الموضوع</label>
            <input type="text" name="subject">
        </div>
        <div class="form-group">
            <label>ملاحظات</label>
            <textarea name="notes"></textarea>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-success">💾 حفظ</button>
            <a href="index.php" class="btn btn-primary">🏠 الرئيسية</a>
            <a href="outgoing.php" class="btn">📤 شاشة الصادر</a>
            <button type="button" class="btn btn-danger" onclick="window.location='logout.php'">🚪 خروج</button>
        </div>
    </form>

    <!-- عرض آخر السجلات -->
    <hr>
    <h3>آخر البريد الوارد</h3>
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr><th>التاريخ</th><th>الرقم</th><th>الجهة</th><th>الموضوع</th></tr>
        </thead>
        <tbody>
        <?php foreach ($incomings as $inc): ?>
            <tr>
                <td><?php echo htmlspecialchars($inc['date']); ?></td>
                <td><?php echo htmlspecialchars($inc['number']); ?></td>
                <td><?php echo htmlspecialchars($inc['source']); ?></td>
                <td><?php echo htmlspecialchars($inc['subject']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>