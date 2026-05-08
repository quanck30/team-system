<?php
require_once __DIR__ . "/pass_riset.php";
//パスワードを変更
$result = passriset( "20260001", "ecc12345");//パスワードをecc12345に変更

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワードリセット用</title>
</head>
<body>
    <p><?=  $result?></p>
    
</body>
</html>