<?php
// 削除確認
session_start();
require_once __DIR__ . "/../../helpers/def.php";
require_once __DIR__ . "/../../helpers/utils.php";
if (empty($_SESSION["dept_no"]) || $_SESSION["dept_no"] !== 1) {
    header("Location: " . TEAM_SYSTEM . "/client/page/safetyList.php");
    exit;
}

$safety_id = filter_input(INPUT_GET, "safety_id", FILTER_VALIDATE_INT);
if ($safety_id === false || $safety_id === null) {
    header("Location: " . TEAM_SYSTEM . "/client/page/safetyList.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>削除確認</title>
    <link rel="stylesheet" href="../css/delete.css">
</head>

<body>

    <div class="container">
        <div class="card">

            <h2>削除確認</h2>
            <p>このデータを本当に削除しますか？<br>この操作は元に戻せません。</p>

            <div class="buttons">
                <a href=<?= "../../server/safety/safety_delete.php?safety_id=" . h($safety_id)   ?> class="yes">削除する</a>
                <a href="safetyList.php" class="no">キャンセル</a>
            </div>
        </div>
    </div>

</body>

</html>