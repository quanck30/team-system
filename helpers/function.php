<?php
//サーバー側のfunction一覧
//マサキカイリ

require_once __DIR__ . "/def.php";

function homeidou()
{
    //Home.phpに遷移
    header("Location: " . TEAM_SYSTEM . "/client/index.php");
    exit;
};


//URL直打ちを対策
function access()
{
    if( $_SERVER["REQUEST_METHOD"] !== "POST" ||empty($_SESSION["emp_no"]) || $_SERVER["REQUEST_METHOD"] === "") {
            homeidou();
            
    }
};

//次のページに遷移
function nextpage($page) 
{
    header("Location: " . TEAM_SYSTEM . "/client/page/" . $page . ".php");
}

?>