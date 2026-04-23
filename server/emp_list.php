<?php
//社員一覧画面（サーバー側）
//マサキカイリ

//
require_once __DIR__ . "../server/index.php";
require_once __DIR__ . "../helpers/def.php";
require_once __DIR__ . "../helpers/utils.php";

//URL直打ちの対策
access();

$page = "TODO";//TODO:管理者用メニュー画面に戻すパス
modoru($_SESSION['dept_no'] ?? 0 , $page);//0の場合Home.phpに遷移

//TODO:DB登録
try{

//TODO:sqlでselect文(社員一覧)

//TODO:結果をresultに格納
} catch(PDOException $poe){
    //TODO:ページを管理者用メニュー画面に戻す
    header("Location:" . TEAM_SYSTEM . "/client/page/TODO.php");
    exit;
}





?>