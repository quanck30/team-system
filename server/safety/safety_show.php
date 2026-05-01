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
        $select = "SELECT Saf.safety_id, E.emp_no, E.ename, S.status, C.can_work
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

function get_safety(int $safety_id)
{
    $result = null;
    try {
        $pdo = getPDO();
        $select = "SELECT Saf.safety_id, C.can_work, Saf.status_id, D.dname,Saf.current_location, E.emp_no, E.ename, S.status, Saf.comment, DATE(Saf.create_at) as day, TIME(Saf.create_at) as time 
                    FROM safety Saf 
                    JOIN employee E ON  Saf.emp_no = E.emp_no 
                    JOIN status S ON Saf.status_id = S.status_id
                    JOIN department D ON E.dept_no = D.dept_no
                    JOIN canwork C ON Saf.can_work_no = C.can_work_no
                    WHERE Saf.safety_id = :safety_id";
        $stmt = $pdo->prepare($select);
        $stmt->execute([
            "safety_id" => $safety_id
        ]);
        $result = $stmt->fetch();
    } catch (\Throwable $th) {
        $result = 'データが存在しません' . $th->getMessage();
    }
    return $result;
}
