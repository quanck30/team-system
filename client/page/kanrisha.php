<?php
require_once __DIR__ . "/../../helpers/def.php";
session_start();

//管理人かどうか
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
    <title>管理者画面</title>
    <link rel="stylesheet" href="../css/kanrisha.css">
</head>
<body>
    <div class="container"> 
    <h1>管理者メニュー</h1>
    <div class="menu">
        <a href="EmployeeList.php" class="card" >
            <h2>社員一覧</h2>
            <p>社員情報を確認・管理</p>
        </a>
        <a href="safetyList.php" class="card" >
            <h2>安否一覧</h2>
            <p>社員の安否状況を確認</p>
        </a>
        <a href="registerform.php" class="card">
            <h2>社員登録</h2>
            <p>社員情報を登録</p>
        </a>
        <a href="touroku.php" class="card">
            <h2>安否登録</h2>
            <p>安否情報を登録</p>
        </a>
       <div class="logout" class="card">
            <a href="./../index.php">ログアウト</a>    
        </div>
    </div>
    </div>
</body>
</html>
