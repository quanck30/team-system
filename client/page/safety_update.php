<?php
//安否情報編集
// 2026・04・30
require_once __DIR__ . "/../../server/safety/safety_show.php";
require_once __DIR__ . "/../../helpers/def.php";


session_start();
$emp_no = $_SESSION["emp_no"] ?? "E0001";
$safety_id = filter_input(INPUT_GET, "safety_id", FILTER_VALIDATE_INT);
echo $safety_id;
// if (empty($safety_id) || empty($emp_no)) {
//     header("Location: " . TEAM_SYSTEM . "/client/index.php");
// }
$safety = get_safety($emp_no);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/touroku.css">
    <title>編集画面</title>


</head>

<body>
    <header>
        <h1>編集画面</h1>
    </header>
    <form action="./../../server/safety/safety_update.php" method="post">

        <div class="title">
            <h2>安否確認</h2>
        </div>
        <div class="form">
            <label>安否状況</label>
            <input type="radio" name="safety" value="1" <?= ($safety["status_id"] === 1) ? "checked" : "" ?>>無事
            <input type="radio" name="safety" value="2" <?= ($safety["status_id"] === 2) ? "checked" : "" ?>>軽傷
            <input type="radio" name="safety" value="3" <?= ($safety["status_id"] === 3) ? "checked" : "" ?>>重症
            <input type="radio" name="safety" value="4" <?= ($safety["status_id"] === 4) ? "checked" : "" ?>>救助か必要
        </div>
        <div class="form">
            <label>出社は可能ですか？</label>
            <input type="radio" name="available" value="1" <?= ($safety["can_work_no"] === 1) ? "checked" : "" ?>>可能
            <input type="radio" name="available" value="2" <?= ($safety["can_work_no"] === 2) ? "checked" : "" ?>>在宅のみ可能
            <input type="radio" name="available" value="3" <?= ($safety["can_work_no"] === 3) ? "checked" : "" ?>>不可
        </div>
        <div class="form">
            <label>現在位置はどこですか？</label>
            <input type="text" name="location"
                value="<?= $safety["current_location"] ?>">
        </div>

        コメント
        <div class="form-group horizpntal-layout">
            <label class="form-label">
                <div class="form-row">
            </label>
            <textarea name="comment" class="form-input"
                required><?= $safety["comment"] ?></textarea>

        </div>

        <input type="submit">
        <a href="./Home.php">戻る</a>
    </form>

    </div>

    <!-- <a href="safetyList.php">社員安否一覧画面</a> -->
</body>

</html>