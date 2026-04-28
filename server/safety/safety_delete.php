<?php
// 安否情報を削除
// DINH BINH QUAN
// 2026/04/21

function safety_delete($dept_no, $safety_id): bool
{
    if ($dept_no !== 1) return false;
    $pdo = getPDO();
    try {
        $pdo->beginTransaction();
        $delete = "DELETE FROM safety WHERE safaty_id = :id";

        $stmt = $pdo->prepare($delete);
        $stmt->execute([
            "id" => $safety_id
        ]);
        $pdo->commit();
        return true;
    } catch (\Throwable $th) {

        return false;
    }
    return false;
}
