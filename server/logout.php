<?php
//マサキカイリ
//ログアウトするとき用
//対象は全社員

require_once __DIR__ . "/../helpers/function.php";

//ファンクションにするのもあり

//セッションの削除
$_SESSION = [];
if(isset($_COOKIE[session_name()])){
    setcookie(session_name() , '' , time() - 999999 , '/');
}
//index.php(ホーム画面)に遷移
homeidou();
?>