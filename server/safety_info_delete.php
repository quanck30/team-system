<?php
//安否情報削除画面 不要になった社員の情報を削除
//delete

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php"; //多分def.phpいらない
require_once __DIR__ . "/../helpers/utils.php";

//セッションスタート
session_start();

access();

$emp_no = $_POST['emp_no'] ?? "";
if(empty($emp_no)){
    $_SESSION['empty_emp_no'] = "社員番号がありません";
    exit;
}

try{
    $pdo = getPDO();

    //トランザクション開始
    $pdo->beginTransaction();

    $sql = "DELETE FROM EMPLOYEE WHERE emp_no = :emp_no";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':emp_no' , $emp_no , PDO::PARAM_STR);
    $stmt->execute();

    $pdo->commit();

} catch(PDOException $poe){
    $_SESSION['safety_info_err'] = $poe->getMessage();
    nextpage("");//TODO
    exit;
}


?>