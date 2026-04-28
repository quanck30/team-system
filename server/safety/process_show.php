<?php
// 安否一覧表示処理
// 2026/04/27
require_once __DIR__ ."/safety_show.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . TEAM_SYSTEM . "/client/page/touroku.php");
    exit;
}
if (empty($_SESSION["emp_no"])) {
    header("Location: " . TEAM_SYSTEM . "/client/index.php");
    exit;
};
$all_safety = get_all_safety();