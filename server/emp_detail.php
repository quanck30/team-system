<?php
//社員の詳細画面
//マサキカイリ

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php";//多分def.phpいらない
require_once __DIR__ . "/../helpers/utils.php";


//セッションスタート
session_start();

//URL直打ちの対策と権限があるか
access();

function user_detail($emp_no)
{
    try{
        // DB登録
        $pdo = getPDO();

        // sqlで社員のidで情報をとってくる
        // joinの処理を書く
        $sql = "SELECT /*TODO:ここに取ってくる情報*/ FROM EMPLOYEE AS E 
                JOIN DEPARTMENT AS D ON E.DEPT_NO = D.DEPT_NO 
                WHERE EMP_NO = :emp_no";
       
        $stmt = $pdo->prepare($sql);
        //bindValueで型が正しいか確認して代入
        $stmt->bindValue(':emp_no', $emp_no, PDO::PARAM_STR);

        //userに結果を格納
        $stmt->execute();
        $user = $stmt->fetch();
        
        return $user;

    }catch(PDOException $poe){
        
        $_SESSION['error_message_detail'] = $poe->getMessage();
        nextpage("kanrisha");
        exit;
    }
}



?>