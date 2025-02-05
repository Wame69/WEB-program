<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<h1>Добро пожаловать, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
<a href="logout.php">Выйти</a>
