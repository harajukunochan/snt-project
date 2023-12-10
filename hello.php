<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Панель управления</title>
</head>
<body>
    <h1>Панель управления</h1>
    <div class="tabs">
        <div class="tab" onclick="window.location.href='my-data.php'">Мои данные</div>
        <div class="tab" onclick="window.location.href='bills-to-pay.php'">Счета на оплату</div>
    </div>
    <div class="tabs">
        <div class="tab" onclick="window.location.href='bills-payed.php'">Оплаченные счета</div>
        <div class="tab" onclick="window.location.href='land-data.php'">Мои участки</div>
    </div>
</body>
</html>
