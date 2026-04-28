<?php
//社員の詳細画面
//マサキカイリ

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";

//URL直打ちの対策と権限があるか
access($_SESSION['dept_no']);

// if ($_SERVER["REQUEST_METHOD"] !== "POST") {
//     homeidou();
// }

//セッションスタート
session_start();

function user_detail($emp_no)
{
    try{
        // DB登録
        $db = getPDO();

        // sqlで社員のidで情報をとってくる
        $sql = "SELECT * FROM EMPLOYEE WHERE EMP_NO = :emp_no";

        $stmt = $db->prepare($sql);
        //bindValueで型が正しいか確認
        $stmt->bindValue(':emp_no', $emp_no, PDO::PARAM_STR);

        //userに結果を格納
        $stmt->execute();
        $user = $stmt->fetch();
        
        return $user;

    }catch(PDOException $poe){
        $_SESSION['error_message_detail'] = $poe->getMessage();
        nextpage("manager");
        // header("Location:" . TEAM_SYSTEM . "/client/page/manager.php");
        exit;
    }
}



?>