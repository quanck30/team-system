<?php
// 安否情報を削除
// DINH BINH QUAN
// 2026/04/21
require_once __DIR__ . "/../../helpers/utils.php";
session_start();
$dept_no = $_SESSION["dept_no"] ?? 0;
$safety_id = filter_input(INPUT_GET, "safety_id", FILTER_VALIDATE_INT);
// if ($dept_no !== 1 || empty($safety_id)) {
//     die("削除権限が持ってない");
// }
$pdo = getPDO();
try {
    $pdo->beginTransaction();
    $delete = "DELETE FROM safety WHERE safety_id = :safety_id";

    $stmt = $pdo->prepare($delete);
    $stmt->execute([
        "safety_id" => $safety_id
    ]);
    $pdo->commit();
    header("Location: " . TEAM_SYSTEM . "/client/page/safetyList.php");
    exit;
} catch (\Throwable $th) {
    $_SESSION["delete_err"] = "削除できない";
    echo $th->getMessage();
    header("Location: " . TEAM_SYSTEM . "/client/page/safetyList.php");
    exit;
}
