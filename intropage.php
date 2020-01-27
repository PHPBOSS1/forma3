<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
<!doctype html>
<html lang="ru">
<head>
    <title>Админ-панель</title>
</head>
<body>
<?php
$link = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS, $DB_NAME); // Соединяемся с базой

// Ругаемся, если соединение установить не удалось
if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
}

//Если переменная Name передана
if (isset($_POST["Name"])) {
    //Если это запрос на обновление, то обновляем
    if (isset($_GET['red_id'])) {
        $sql = mysqli_query($link, "UPDATE `products` SET `Name` = '{$_POST['Name']}',`Cod` = '{$_POST['Cod']}',`Price` = '{$_POST['Price']}',`Description` = '{$_POST['Description']}' WHERE `ID`={$_GET['red_id']}");
    } else {
        //Иначе вставляем данные, подставляя их в запрос
        $sql = mysqli_query($link, "INSERT INTO `products` (`Name`, `Price`, `Cod`,`Description`) VALUES ('{$_POST['Name']}', '{$_POST['Price']}', '{$_POST['Cod']}', '{$_POST['Description']}')");
    }

    //Если вставка прошла успешно
    if ($sql) {
        echo '<p>Успешно!</p>';
    } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
}


?>

<table border='1'>
    <tr>
        <td>Идентификатор</td>
        <td>Полное имя</td>
        <td>E-mail</td>
        <td>Имя пользователя</td>
        <td>Пароль</td>
    </tr>
    <?php
    $sql = mysqli_query($link, 'SELECT `ID`, `full_name`, `email`,`username`,`password`  FROM `Users`');
    while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
            "<td>{$result['ID']}</td>" .
            "<td>{$result['full_name']}</td>" .
            "<td>{$result['email']}</td>" .
            "<td>{$result['username']}</td>" .
            "<td>{$result['password']}</td>" .
            '</tr>';
    }
    ?>
</table>
</body>
</html>
<div id="welcome">
    <h2>Добро пожаловать, <span> в кабинет </span></h2>!
    <p><a href="logout.php">Выйти</a> из системы</p>
</div>

