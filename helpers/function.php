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
    if( $_SERVER["REQUEST_METHOD"] !== "POST" ||empty($_SESSION["emp_no"])) {
        
        if( $_SERVER["REQUEST_METHOD"] !== "GET"){
            homeidou();
        }
            
    }
};

//次のページに遷移
function nextpage($page) 
{
    header("Location: " . TEAM_SYSTEM . "/client/page/" . $page . ".php");
}

?>