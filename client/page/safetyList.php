<?php
// 安否一覧表示画面
// 2026・04・21
require_once __DIR__ . "/../../server/safety/safety_show.php";
require_once __DIR__ . "/../../helpers/def.php";
// if (empty($_SESSION["emp_no"])) {
//     header("Location: " . TEAM_SYSTEM . "/client/index.php");
//     exit;
// };
$dept_no = $_SESSION["dept_no"] ?? 0;
$all_safety = get_all_safety();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社員安否一覧画面</title>
    <!-- <link rel="stylesheet" href="./../css/index.css">
    <link rel="stylesheet" href="./../css/safety.css"> -->
    <link rel="stylesheet" href="./../css/safetyList.css">

</head>

<body>
    <header>
        <div>
            <h1>社員安否一覧画面</h1>
        </div>
    </header>



    <h2>安否一覧表示</h2><a class="back" href="">安否登録</a>

    <section class="safety-display">
        <table>
            <thead>
                <tr>
                    <th>社員番号</th>
                    <th>名前</th>
                    <th>安否状態</th>
                    <th>コメント</th>
                    <th>出社状態</th>
                    <th>現在地</th>
                    <th>登録日付</th>
                    <th>登録時間</th>
                    <th></th>
                    <th></th>
                    <?php if ($dept_no === 1): ?>
                        <th></th>
                    <?php endif ?>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($all_safety as $safety): ?>
                    <tr>
                        <td><?= h($safety["emp_no"]) ?></td>
                        <td><?= h($safety["ename"]) ?></td>
                        <td><?= h($safety["status"]) ?></td>
                        <td><?= h($safety["comment"]) ?></td>
                        <td><?= h($safety["can_work"]) ?></td>
                        <td><?= h($safety["current_location"]) ?></td>
                        <td><?= h($safety["day"]) ?></td>
                        <td><?= h($safety["time"]) ?></td>
                        <td><a href=<?= "./safety_update.php?safety_id=" . $safety["safety_id"] ?>>編集</a></td>
                        <?php if ($dept_no === 1): ?>
                            <td><a href="./safetydetail.php?">削除</a></td>
                        <?php endif ?>
                        <td><a href=<?= "./delete.php?safety_id=" . $safety["safety_id"] ?>>削除</a></td>
                    </tr>
                <?php endforeach ?>


            </tbody>
        </table>
    </section>
</body>

</html>