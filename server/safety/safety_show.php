<?php
// 全社員の安否状況を一覧表示する
// DINH BINH QUAN
// 2026/04/20
require_once __DIR__ . "/../../helpers/utils.php";

function get_all_safety(): array
{
    $all_safety = [];

    try {
        $pdo = getPDO();
        $select = "SELECT Saf.safety_id, E.emp_no, E.ename, S.status, C.can_work, Saf.comment, Saf.current_location, DATE_FORMAT(create_at, '%Y年%m月%d日') AS day, DATE_FORMAT(create_at, '%H:%i') AS time 
                    FROM safety Saf 
                    JOIN employee E ON  Saf.emp_no = E.emp_no 
                    JOIN status S ON Saf.status_id = S.status_id
                    JOIN canwork C ON Saf.can_work_no = C.can_work_no
                    ORDER BY S.status_id DESC";
        $stmt = $pdo->prepare($select);
        $stmt->execute();
        while ($safety = $stmt->fetch()) {
            $all_safety[] = $safety;
        }
    } catch (\Throwable $th) {
        die("データベースのエラー" . $th->getMessage());
    }
    return $all_safety;
}

function get_safety(string $emp_no)
{
    $result = null;
    try {
        $pdo = getPDO();
        $select = "SELECT Saf.safety_id, Saf.can_work_no, Saf.status_id,Saf.current_location, E.emp_no, E.ename, S.status, Saf.comment, DATE(Saf.create_at) as day, TIME(Saf.create_at) as time 
                    FROM safety Saf 
                    JOIN employee E ON  Saf.emp_no = E.emp_no 
                    JOIN status S ON Saf.status_id = S.status_id
                    WHERE E.emp_no = :emp_no";
        $stmt = $pdo->prepare($select);
        $stmt->execute([
            "emp_no" => $emp_no
        ]);
        $result = $stmt->fetch();
    } catch (\Throwable $th) {
        $result = 'データが存在しません' . $th->getMessage();
    }
    return $result;
}
