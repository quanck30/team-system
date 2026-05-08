<?php
//マサキカイリ
//ログアウトするとき用
//対象は全社員
require_once __DIR__ . "/../helpers/function.php";
session_start();

//ファンクションにするのもあり

//セッションの削除
$_SESSION = [];
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 999999, '/');
}
//サーバー側のセッションデータを破棄
session_destroy();

//index.php(ホーム画面)に遷移
if(empty($_SESSION)){
    homeidou();
} else {
    echo "エラーが発生しました。";
}
