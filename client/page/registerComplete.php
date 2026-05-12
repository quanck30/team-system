<?php
require_once __DIR__ . "/../../helpers/def.php";
session_start();

if (empty($_SESSION["dept_no"]) || $_SESSION["dept_no"] !== 1) {
    header("Location: " . TEAM_SYSTEM . "/client/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了</title>
</head>
<body>
    <h1>データの登録が完了しました</h1>
    <p><a href="kanrisha.php">管理者画面に戻る</a></p>
</body>
</html>