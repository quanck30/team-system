<?php
// 全社員の安否状況を一覧表示する
// DINH BINH QUAN
// 2026/04/20


session_start();
function get_all_safety(): array
{
    $all_safety = [];

    if ($_SERVER["REQUEST_METHOD"] !== "GET") {
        header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
        exit;
    }

    try {

        $pdo = getPDO();
        $select = "SELECT * FROM safety";
        $stmt = $pdo->prepare($select);
        $stmt->execute();
        while ($safety = $stmt->fetch()) {
            $all_safety[] = $safety;
        }
    } catch (\Throwable $th) {
    }
    return $all_safety;
}

function get_safety($emp_no)
{
    $result = null;

    if ($_SERVER["REQUEST_METHOD"] !== "GET") {
        header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
        exit;
    }

    try {
        $pdo = getPDO();
        $select = "SELECT * FROM safety WHERE emp_no = :emp_no";
        $stmt = $pdo->prepare($select);
        $stmt->execute([
            "emp_no" => $emp_no
        ]);
        $result = $stmt->fetch();
    } catch (\Throwable $th) {
        $result = 'データが存在しません';
    }
    return $result;
}
