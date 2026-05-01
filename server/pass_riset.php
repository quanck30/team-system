<?php
//パスワードをリセット（サーバー）
//UPDATE文

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";



//セッションスタート
session_start();

//URLの直打ちを対策
access($_SESSION['dept_no']);

$password = $_POST['password'];
$emp_no = $_POST['emp_no'];

if(empty($password) || empty($emp_no)){
    $_SESSION['empty_pass_emp_no'] = "パスワードもしくは従業員番号が空です";
    exit;
} 

//英数字混合か判断 preg_matchは英数字が含まれてたら1 含まれていなかったら0を返す
if (preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/', $inputs['password']) === 0) {
    $_SESSION['pass_mix_err'] = "パスワードは英数字混合にしてください。";
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

} catch(PDOException $poe){
    $_SESSION['pass_riset_err'] = $poe->getMessage();
    // nextpage("");//TODO
    exit;
}


?>