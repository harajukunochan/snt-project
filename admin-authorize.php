<?php
$host = "127.0.0.1"; 
$user = "root"; 
$password = ""; 
$database = "snt"; 

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}



if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE login = '$login' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Пользователь авторизован
        session_start();
        $_SESSION['login'] = $login;
        header("Location: dashboard.php");
        exit();
    } 
    else {
        $error_message = "Неправильное имя пользователя или пароль.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
    
</head>
<body>
    <h1>АВход для администратора</h1>
    <form method="post">
        <label for="login">Имя пользователя:</label>
        <input type="text" name="login" required>
        <label for="password">Пароль:</label>
        <input type="password" name="password" required>
        <input type="submit" name="submit" value="прододжить">
    </form>
    <a href="index.php">Вы не администратор? Вернуться</a>
    <?php
    if (isset($error_message)) {
        echo '<p class="error">' . $error_message . '</p>';
    }
    ?>
</body>
</html>