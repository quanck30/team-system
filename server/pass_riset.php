<?php
//パスワードをリセット（サーバー）
//UPDATE文

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";

//TODO:やらなくていける

//セッションスタート
session_start();

function passriset($emp_no , $password)
{
    try {
        $pdo = getPDO();

        //トランザクション開始
        $pdo->beginTransaction();

        //UPDATE文
        $sql = "UPDATE EMPLOYEE SET password = :password WHERE emp_no = :emp_no";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':password', password_hash($password , PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->bindValue(':emp_no', $emp_no, PDO::PARAM_STR);
        $stmt->execute();

        $pdo->commit();
        return "データの登録が完了しました。";
    } catch (PDOException $poe) {
        $pdo->rollback();
        $_SESSION['pass_riset_err'] = $poe->getMessage();
        return "データの登録に失敗しました。";
        exit;
    }
}
