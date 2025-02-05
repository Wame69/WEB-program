<?php
session_start();

function loadUsers() {
    if (!file_exists('users.json')) {
        return [];
    }
    return json_decode(file_get_contents('users.json'), true);
}

function saveUsers($users) {
    file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
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
        if ($user['username'] === $username) {
            echo "Пользователь уже существует!";
            exit;
        }
    }

    $users[] = [
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ];
    saveUsers($users);

    echo "Регистрация успешна! <a href='login.php'>Войти</a>";
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Логин" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <button type="submit">Зарегистрироваться</button>
</form>
<a href="login.php">Уже есть аккаунт? Войти</a>
