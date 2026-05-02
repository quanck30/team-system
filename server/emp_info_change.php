<?php
//社員情報の変更
//ID
//パスワード以外の情報
//TODO:やらなくていける

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/utils.php";

session_start();

//emp_no（絶対変えれないため）とpassword（別のファイルで処理しているため）以外の情報を変更する

access();

//POSTで変更したい情報をとってくる

//空か判定


try{
    $pdo = getPDO();

    //トランザクション開始
    $pdo->beginTransaction();

    $update = "UPDATE EMPLOYEE ";
    $set = "変更する情報";
    $where = " WHERE emp_no = :emp_no";

    /* 
    ここでif文でそれぞれどの情報が空か判定して$setに結合する（やりかた調べた方がいい）
    */

    $sql = $update . $set . $where;

    $stmt = $pdo->prepare($sql);

    //その後バインドバリュー
    $stmt->bindValue(':emp_no', $emp_no, PDO::PARAM_STR);
    //TODO:
    $stmt->execute();

    //データの保存
    $pdo->commit();

    // 変更できてもできなくても管理者画面に遷移
    nextpage("kanrisha");
    $_SESSION['change_db_success'] = "データの変更が成功しました。";
} catch (PDOException $poe){
    $pdo->rollBack();
    // 変更できてもできなくても管理者画面に遷移
    nextpage("kanrisha");
    //エラーをセッションに保存
    $_SESSION['change_db_err'] = "DBエラー" . $poe->getMessage();
    exit;
}



?>