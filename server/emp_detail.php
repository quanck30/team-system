<?php
//社員の詳細画面
//マサキカイリ

require_once __DIR__ . "../server/index.php";
require_once __DIR__ . "../helpers/def.php";
require_once __DIR__ . "../helpers/utils.php";

//URL直打ちの対策
access();

try{
    //TODO:DB登録

    //TODO:sqlで社員のidで情報をとってくる
}catch(PDOException $poe){
    header("Location:" . TEAM_SYSTEM . "/client/page/manager.php");
    exit;
}



?>