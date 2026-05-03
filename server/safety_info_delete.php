<?php
//安否情報削除画面 不要になった社員の情報を削除
//delete

require_once __DIR__ . "/../helpers/def.php"; //多分def.phpいらない
require_once __DIR__ . "/../helpers/utils.php";

//セッションスタート
session_start();

access();

$emp_no = $_POST['emp_no'] ?? "";
if (empty($emp_no)) {
    $_SESSION['empty_emp_no'] = "社員番号がありません";
    exit;
}
function delete($emp_no)
{
    if(empty($emp_no) || preg_match('/[^!-~ ]/u', $emp_no)){
        $_SESSION['emp_err'] = "従業員番号が空もしくは、全角で入力されています";
        exit;
    }
    try {
        $pdo = getPDO();

        //トランザクション開始
        $pdo->beginTransaction();

        $sql = "DELETE FROM EMPLOYEE WHERE emp_no = :emp_no";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':emp_no', $emp_no, PDO::PARAM_STR);
        $stmt->execute();

        $pdo->commit();
    } catch (PDOException $poe) {
        $pdo->rollback(); 
        $_SESSION['safety_info_err'] = "DBエラー" . $poe->getMessage();
        exit;
    }
}
