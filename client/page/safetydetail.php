<?php
// 安否詳細画面
// 2026/05/01
require_once __DIR__ . "/../../server/safety/safety_show.php";
require_once __DIR__ . "/../../helpers/utils.php";
require_once __DIR__ . "/../../helpers/def.php";

$safety_id = filter_input(INPUT_GET, 'safety_id', FILTER_VALIDATE_INT);
if (empty($safety_id) || $_SERVER["REQUEST_METHOD"] !== "GET") {
    header("Location: " . TEAM_SYSTEM . "/client/page/safetyList.php");
    exit;
}
$safety = get_safety($safety_id);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安否詳細画面</title>
    <!-- <link rel="stylesheet" href="../css/dezain.css"> -->
    <link rel="stylesheet" href="../css/safetydetail.css">

</head>

<body>
    <header>
        <h1>安否詳細画面</h1>
    </header>
    <!-- 一覧表示 -->
    <table>
        <tr>
            <th>社員番号</th>
            <th>名前</th>
            <th>部署</th>
            <th>コメント</th>
            <th>現在地
                （入力時）
            </th>
            <th>出勤可能</th>


        </tr>
        <?php if (!empty($safety)): ?>
            <tr>
                <td><?= h($safety["emp_no"]) ?></td>
                <td><?= h($safety["ename"]) ?></td>
                <td><?= h($safety["dname"]) ?></td>
                <td><?= h($safety["comment"]) ?></td>
                <td><?= h($safety["current_location"]) ?></td>
                <td><?= h($safety["can_work"]) ?></td>
            <?php else: ?>
            <tr>
                <td colspan="3">データがありません</td>
            </tr>
        <?php endif; ?>
    </table>
    <div class="bottom-links">
        <a href="./safetyList.php">戻る</a>
        <a href="./../../server/logout.php">ログアウト</a>
    </div>
</body>

</html>