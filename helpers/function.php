<?php
//サーバー側のfunction一覧
//マサキカイリ

function homeidou()
{
    //Home.phpに遷移
    header("Location: " . TEAM_SYSTEM . "/client/index.php");
    exit;
};


//URL直打ちを対策
function access()
{
    if($_SERVER["REQUEST_METHOD"] !== "POST" || isset($_SERVER["REQUEST_METHOD"]) || $_SESSION["dept_no"] !== "1" || $_SESSION['logged_in'] !== 1) {
        homeidou();
    }
};

//次のページに遷移
function nextpage($page) 
{
    header("Location: " . TEAM_SYSTEM . "/client/page/" . $page . ".php");
}

?>