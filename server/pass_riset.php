<?php
//パスワードをリセット（サーバー）
//UPDATE文

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";

//URLの直打ちを対策
access('dept_no');

// if ($_SERVER["REQUEST_METHOD"] !== "POST") { //TODO:
//     homeidou();
// }

//セッションスタート
session_start();

//TODO:どんな情報を扱うかフロントの人と話し合う

// 社員ID 、パスワード
$info = [];

$info = [

];

try{
    $db = getPDO();

} catch(PDOException $poe){
    $_SESSION['pass_riset_err'] = $poe->getMessage();
    nextpage("TODO");//TODO
    exit;
}


?>