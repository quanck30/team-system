<?php
// ログイン画面処理
require_once __DIR__ . "/../helpers/utils.php";
session_start();
$login_db_err = $_SESSION["login_db_err"] ?? "";
$emp_no_err = $_SESSION["emp_no_err"] ?? "";
$pass_err = $_SESSION["pass_err"] ?? "";
unset($_SESSION["emp_no_err"]);
unset($_SESSION["pass_err"]);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php if (!empty($login_err)): ?>
        <p><?= h($login_db_err) ?></p>
    <?php else: ?>
        <p></p>
    <?php endif; ?>

    <form action="./../server/index.php" method="POST">
        <h2>ログイン</h2>
        <div>
            <label for="emp_no">社員場号：</label>
            <input id="emp_no" name="emp_no" placeholder="＜例＞20260001" type="text">
            <?php if (!empty($emp_no_err)): ?>
                <p><?= h($emp_no_err) ?></p>
            <?php else: ?>
                <p></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="password">パスワード：</label>
            <input id="password" name="password" placeholder="＜例＞ 123456789" type="password">
            <?php if (!empty($pass_err)): ?>
                <p><?= h($pass_err) ?></p>
            <?php else: ?>
                <p></p>
            <?php endif; ?>
        </div>
        <button type="submit">ログイン</button>
    </form>
</body>

</html>