<?php
session_start();

function loadUsers() {
    if (!file_exists('users.json')) {
        return [];
    }
    return json_decode(file_get_contents('users.json'), true);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "Логин и пароль обязательны!";
        exit;
    }

    $users = loadUsers();
    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        }
    }

    echo "Неверные логин или пароль!";
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Логин" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <button type="submit">Войти</button>
</form>
<a href="register.php">Нет аккаунта? Зарегистрируйтесь</a>
