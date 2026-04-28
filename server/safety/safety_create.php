<?php
// 災害発生時に安否情報を新規登録する
// 2026/04/17
// DINH BINH QUAN


require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . TEAM_SYSTEM . "/client/page/touroku.php");
    exit;
}

//チェックボックスから安全かどうか送信してくれる
$status_id = filter_input(INPUT_POST, 'status_id', FILTER_VALIDATE_INT);
$can_work = filter_input(INPUT_POST, 'available', FILTER_VALIDATE_INT);

if (
    $status_id === false || $can_work === false ||
    !in_array($status_id, [1, 2], true) ||
    !in_array($can_work, [1, 2], true)
) {
    die();
}
$comment = trim(filter_input(INPUT_POST, "comment") ?? "");
$location = trim(filter_input(INPUT_POST, "location") ?? "");



if (isset($_SESSION["emp_no"])) {
    $pdo = getPDO();
    try {
        $pdo->beginTransaction();
        $insert = "INSERT INTO safety(emp_no, status_id, comment, location, can_work) VALUES (:emp_no, :status_id, :comment, :location, :can_work)";

        $stmt = $pdo->prepare($insert);
        $stmt->execute([
            ":emp_no" => $_SESSION["emp_no"],
            ":status_id" => $status_id,
            ":comment" => $comment ?? "安全",
            ":location" => $location,
            ":can_work" => $can_work
        ]);
        $pdo->commit();
    } catch (\Throwable $th) {
        if($pdo->inTransaction()) $pdo->rollBack();
        $_SESSION["safety_create_err"] = "作成できなかった";
        header("Location: " . TEAM_SYSTEM . "/client/page/touroku.php");
        exit;
    }

    header("location " . TEAM_SYSTEM . "/client/page/safetyList.php");
    exit;
}
