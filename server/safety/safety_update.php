<?php
// 状況が変化した時に安否情報を変更する
// 2026/04/20
// DINH BINH QUAN
// 
// session_start();
require_once __DIR__ . "/../../helpers/utils.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . TEAM_SYSTEM . "/client");
    exit;
}

//チェックボックスから安全かどうか送信してくれる
$status_id = filter_input(INPUT_POST, "safety", FILTER_VALIDATE_INT);
$comment = filter_input(INPUT_POST, "comment");
$current_location = filter_input(INPUT_POST, "location");

// 出社可否
$can_work_no = filter_input(INPUT_POST, "available", FILTER_VALIDATE_INT);



// if (isset($_SESSION["emp_no"])) {
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
        // ":emp_no" => $_SESSION["emp_no"],
        ":emp_no" => "E0001",
        ":status_id" => $status_id,
        ":comment" => $comment ?? "",
        ":current_location" => $current_location,
        ":can_work_no" => $can_work_no
    ]);
    $pdo->commit();
    header("Location: " . TEAM_SYSTEM . "/client/page/safetyList.php");
    exit;
} catch (\Throwable $th) {
    echo $th->getMessage();
    if ($pdo->inTransaction()) $pdo->rollBack();
    $_SESSION["safety_update_err"] = "編集できなかった";
    header("Location: " . TEAM_SYSTEM . "/client");
    exit;
}
// }
