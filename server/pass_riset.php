<?php
//パスワードをリセット（サーバー）
//UPDATE文

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";

//URLの直打ちを対策
access('dept_no');

// if ($_SERVER["REQUEST_METHOD"] !== "POST") { //TODO:
//     homeidou();
// }

//セッションスタート
session_start();

//管理者とURL対策
access($dept_no);

$password = $_POST['password'];
$emp_no = $_POST['emp_no'];

if(empty($password) || empty($emp_no)){
    $_SESSION['empty_pass_emp_no'] = "パスワードもしくは従業員番号が空です";
    exit;
}

try{
    $db = getPDO();

    //トランザクション開始
    $db->beginTransaction();

    //UPDATE文
    $sql = "UPDATE EMPLOYEE SET password = :password WHERE emp_no = :emp_no";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':password', $password , PDO::PARAM_STR);
    $stmt->bindValue(':emp_no', $emp_no, PDO::PARAM_STR);
    $stmt->execute();

    $db->commit();
    //従業員番号でパスワードリセットする人を決める


} catch(PDOException $poe){
    $_SESSION['pass_riset_err'] = $poe->getMessage();
    nextpage("");//TODO
    exit;
}


?>