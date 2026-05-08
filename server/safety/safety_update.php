<?php
// 状況が変化した時に安否情報を変更する
// 2026/04/20
// DINH BINH QUAN
// 
session_start();
require_once __DIR__ . "/../../helpers/utils.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . TEAM_SYSTEM . "/client/index.php");
    exit;
}

//チェックボックスから安全かどうか送信してくれる
$status_id = filter_input(INPUT_POST, "safety", FILTER_VALIDATE_INT);
$comment = filter_input(INPUT_POST, "comment");
$current_location = filter_input(INPUT_POST, "location");

// 出社可否
$can_work_no = filter_input(INPUT_POST, "available", FILTER_VALIDATE_INT);
$emp_no = filter_input(INPUT_POST, "emp_no");


if (
    $status_id === false ||
    $can_work_no === false ||
    empty($emp_no)
) {
    $_SESSION["safety_update_err"] = "不正なデータです";
    header("Location: " . TEAM_SYSTEM . "/client/page/safetyList.php");
    exit;
}

if (isset($_SESSION["emp_no"])) {
    if ($_SESSION["dept_no"] != 1 && $emp_no != $_SESSION["emp_no"]) {
        $_SESSION["safety_update_err"] = "更新権限が持ってない";
        header("Location: " . TEAM_SYSTEM . "/client/page/safetyList.php");
        exit;
    }
    $pdo = getPDO();
    try {
        $pdo->beginTransaction();
        $update = "UPDATE safety SET status_id = :status_id,
                                    comment = :comment,
                                    current_location = :current_location,
                                    can_work_no = :can_work_no
                                WHERE emp_no = :emp_no";

        $stmt = $pdo->prepare($update);
        $stmt->execute([
            ":emp_no" => $emp_no,
            ":status_id" => $status_id,
            ":comment" => $comment ?? "",
            ":current_location" => $current_location,
            ":can_work_no" => $can_work_no
        ]);
        $pdo->commit();
        if ($stmt->rowCount() === 0) {
            $_SESSION["safety_update_err"] = "更新対象が存在しません";
        }
        $_SESSION["safety_update_success"] = "更新できました";
    } catch (\Throwable $th) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        $_SESSION["safety_update_err"] = "安否情報の更新に失敗しました";
    }
    header("Location: " . TEAM_SYSTEM . "/client/page/safetyList.php");
    exit;
}
