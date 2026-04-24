<?php
// 災害発生時に安否情報を新規登録する
// 2026/04/17
// DINH BINH QUAN


require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";


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
        $insert = "INSERT INTO safety(emp_no, status_id, comment, location, is_available_for_work) VALUES (:emp_no, :status_id, :comment, :location, :is_available_for_work)";

        $stmt = $pdo->prepare($insert);
        $stmt->execute([
            ":emp_no" => $_SESSION["emp_no"],
            ":status_id" => $status_id,
            ":comment" => $comment ?? "",
            ":location" => $location,
            ":is_available_for_work" => $is_available_for_work
        ]);
        $pdo->commit();
    } catch (\Throwable $th) {
        $_SESSION["safety_create_err"] = "作成できなかった";
        header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
        exit;
    }

    header("location* " . TEAM_SYSTEM . "/client/page");
    exit;
}
