<?php
// 状況が変化した時に安否情報を変更する
// 2026/04/20
// DINH BINH QUAN
// 
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
    exit;
}

//チェックボックスから安全かどうか送信してくれる
$status_id = filter_input(INPUT_POST, "status_id", FILTER_VALIDATE_INT);
$comment = filter_input(INPUT_POST, "comment");
$location = filter_input(INPUT_POST, "location");

// 出社可否
$is_available_for_work = filter_input(INPUT_POST, "is_available_for_work", FILTER_VALIDATE_INT);


if (isset($_SESSION["emp_no"])) {
    $pdo = getPDO();
    try {
        $pdo->beginTransaction();
        $update = "UPDATE safety SET status_id = :status_id,
                                    comment = :comment,
                                    location = :location
                                WHERE emp_no = :emp_no";

        $stmt = $pdo->prepare($update);
        $stmt->execute([
            ":emp_no" => $_SESSION["emp_no"],
            ":status_id" => $status_id,
            ":comment" => $comment ?? "",
            ":location" => $location,
            ":is_available_for_work" => $is_available_for_work
        ]);
        $pdo->commit();
    } catch (\Throwable $th) {
        $_SESSION["safety_update_err"] = "編集できなかった";
        header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
        exit;
    }

    header("location* " . TEAM_SYSTEM . "/client/page");
    exit;
}
