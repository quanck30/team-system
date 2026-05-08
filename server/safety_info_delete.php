<?php
//安否情報削除画面 不要になった社員の情報を削除
//delete
require_once __DIR__ . "/../helpers/utils.php";


function delete($emp_no)
{
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
