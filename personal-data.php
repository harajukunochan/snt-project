<?php
$host = "127.0.0.1"; 
$user = "root"; 
$password = ""; 
$database = "snt"; 

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Обработка операций CRUD
if (isset($_POST['submit'])) {
    if ($_POST['action'] == 'create') {
        // Создание новой записи
        $fullname = $_POST['fullname'];
        $email = $_POST['e-mail'];
        $phoneNumber = $_POST['phoneNumber'];
        $address = $_POST['address'];
        $password = $_POST['password'];

        $sql = "INSERT INTO user (fullname, e-mail, phoneNumber, address, password)
                VALUES ('$fulllname', '$email', '$phoneNumber', '$address', '$password')";
        $conn->query($sql);
    } elseif ($_POST['action'] == 'edit') {
        // Редактирование записи
        $id = $_POPST['id'];
        $fullname = $_POST['edit_fullname'];
        $email = $_POST['edit_e-mail'];
        $phoneNumber = $_POST['edit_phoneNumber'];
        $address = $_POST['edit_address'];
        $password = $_POST['edit_password'];
      

        $sql = "UPDATE user SET fullname = '$fullname', address = '$address', e-mail = '$email', phoneNumber = '$phoneNumber, address = '$address', password = '$password'
                WHERE id = $id";
        $conn->query($sql);
    } elseif ($_POST['action'] == 'delete') {
        // Удаление записи
        $id = $_POST['delete_id'];
        $sql = "DELETE FROM user WHERE id = $id";
        $conn->query($sql);
    }
}

// Запрос на выборку всех записей из таблицы "user"
$sql = "SELECT * FROM user";
$result = $conn->query($sql);

?>



<!DOCTYPE html>
<html>
<body>
    <div class="tabs">
        <div class="tab" onclick="window.location.href='dashboard.php'">На главную</div>
    </div>
</body>
<head>
    <title>Управление пользователями</title>
   
</head>
<body>
    <h1>Управление пользователями</h1>
    
    <h2>Добавить нового пользователя</h2>
    <form method="post">
        <input type="hidden" name="action" value="create">
        <label for="text">ФИО:</label>
        <label for="e-mail">Email:</label>
        <input type="e-mail" name="email" required>
        <label for="phoneNumber">Телефон:</label>
        <input type="text" name="phoneNumber">
        <label for="address">Адрес:</label>
        <input type="text" name="address">
        <label for="password">Пароль:</label>
        <input type="password" name="password" required>
        <input type="submit" name="submit" value="Создать">
    </form>

    <h2>Существующие пользователи</h2>
    <table>
        <tr>
            <th>id</th>
            <th>ФИО</th>
            <th>Email</th>
            <th>Телефон</th>
            <th>Адрес</th>
            <th>Действия</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['fullname'] . "</td>";
                echo "<td>" . $row['e-mail'] . "</td>";
                echo "<td>" . $row['phoneNumber'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo '<td>
                        <form method="post">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="edit_ID" value="' . $row['ID'] . '">
                            <input type="text" name="edit_Имя" value="' . $row['Имя'] . '" required>
                            <input type="text" name="edit_Фамилия" value="' . $row['Фамилия'] . '" required>
                            <input type="email" name="edit_Email" value="' . $row['Email'] . '" required>
                            <input type="text" name="edit_Телефон" value="' . $row['Телефон'] . '">
                            <input type="text" name="edit_Адрес" value="' . $row['Адрес'] . '">
                            <input type="text" name="edit_Роль" value="' . $row['Роль'] . '">
                            <input type="password" name="edit_Пароль" placeholder="Новый пароль">
                            <input type="submit" name="submit" value="Сохранить">
                        </form>
                        <form method="post">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="delete_ID" value="' . $row['ID'] . '">
                            <input type="submit" name="submit" value="Удалить">
                        </form>
                    </td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Нет данных</td></tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
$conn->close();
?>