<?php
//サーバー側のfunction一覧
//マサキカイリ

function homeidou()
{
    //Home.phpに遷移
    header("Location: " . TEAM_SYSTEM . "/client/Home.php");
    exit;
};

//URL直打ちを対策
function access($dept_no)
{
    if($_SERVER["REQUEST_METHOD"] !== "POST" || isset($_SERVER["REQUEST_METHOD"]) || $dept_no !== "1") {
        homeidou();
    }
};

//次のページに遷移
function nextpage($page) 
{
    header("Location: " . TEAM_SYSTEM . "/client/page/" . $page . ".php");
}

?>