<?php
//安否情報削除画面
//delete

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";

access('dept_no');
//セッションスタート
session_start();
access($_SESSION['dept_no']);

$emp_no = $_POST['emp_no'] ?? "";
if(empty($emp_no)){
    $_SESSION['empty_emp_no'] = "社員番号がありません";
    exit;
}

try{
    $pdo = getPDO();

    //トランザクション開始
    $db->beginTransaction();

    $sql = "DELETE FROM EMPLOYEE WHERE emp_no = :emp_no";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':emp_no' , $emp_no , PDO::PARAM_INT);
    $stmt->execute();

    $db->commit();

} catch(PDOException $poe){
    $_SESSION['safety_info_err'] = $poe->getMessage();
    nextpage("");//TODO
    exit;
}


?>