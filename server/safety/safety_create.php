<?php
// 災害発生時に安否情報を新規登録する
// 2026/04/17
// DINH BINH QUAN

session_start();
require_once __DIR__ . "/../../helpers/def.php";
require_once __DIR__ . "/../../helpers/utils.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . TEAM_SYSTEM . "/client/page/touroku.php");
    exit;
}

//チェックボックスから安全かどうか送信してくれる
$status_id = filter_input(INPUT_POST, 'safety', FILTER_VALIDATE_INT);
$can_work_no = filter_input(INPUT_POST, 'available', FILTER_VALIDATE_INT);

if (
    $status_id === false || $can_work_no === false ||
    !in_array($status_id, [1, 2, 3, 4], true) ||
    !in_array($can_work_no, [1, 2, 3], true)
) {
    die();
}
$comment = trim(filter_input(INPUT_POST, "comment") ?? "");
$current_location = trim(filter_input(INPUT_POST, "location") ?? "");
if (isset($_SESSION["emp_no"])) {
    $pdo = getPDO();
    try {
        $pdo->beginTransaction();
        $insert = "INSERT INTO safety(emp_no, status_id, comment, current_location, can_work_no) VALUES (:emp_no, :status_id, :comment, :current_location, :can_work_no)";

        $stmt = $pdo->prepare($insert);
        $stmt->execute([
            ":emp_no" => $_SESSION["emp_no"],
            ":status_id" => $status_id,
            ":comment" => $comment ?: "安全",
            ":current_location" => $current_location,
            ":can_work_no" => $can_work_no
        ]);
        $pdo->commit();
        header("Location: " . TEAM_SYSTEM . "/client/page/safetyList.php");
        exit;
    } catch (\Throwable $th) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        $_SESSION["safety_create_err"] = "作成できなかった";
        header("Location: " . TEAM_SYSTEM . "/client/page/touroku.php");
        exit;
    }
} else {
    $_SESSION["safety_create_err"] = "セッションが無効です。再ログインしてください。";
    header("Location: " . TEAM_SYSTEM . "/client");
    exit;
}
