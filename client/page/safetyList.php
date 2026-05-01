<?php
// 安否一覧表示画面
// 2026・04・21
session_start();
require_once __DIR__ . "/../../server/safety/safety_show.php";
require_once __DIR__ . "/../../helpers/def.php";
require_once __DIR__ . "/../../helpers/utils.php";
require_once __DIR__ . "/../../helpers/function.php";
$dept_no = $_SESSION["dept_no"] ?? 0;
$update_access_err = $_SESSION["update_access_err"] ?? "";
unset($_SESSION["update_access_err"]);
$all_safety = get_all_safety();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社員安否一覧画面</title>
    <link rel="stylesheet" href="./../css/safetyList.css">
</head>

<body>
    <header>
        <div>
            <h1>社員安否一覧画面</h1>
        </div>
    </header>

    <h2>安否一覧表示</h2>
    <a class="back" href="./touroku.php">安否登録</a>

    <section class="safety-display">
        <table>
            <thead>
                <tr>
                    <th>社員番号</th>
                    <th>名前</th>
                    <th>安否状態</th>
                    <th>出社状態</th>
                    <th>編集</th>
                    <?php if ($dept_no === 1): ?>
                        <th>削除</th>
                    <?php endif ?>
                    <th>削除</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($all_safety as $safety): ?>
                    <tr class="clickable-row" role="link" data-href="./safetydetail.php?safety_id=<?= h($safety["safety_id"]) ?>">
                        <td><?= h($safety["emp_no"]) ?></td>
                        <td><?= h($safety["ename"]) ?></td>
                        <td data-status="<?= h($safety["status"]) ?>">
                            <?= h($safety["status"]) ?>
                        </td>
                        <td><?= h($safety["can_work"]) ?></td>
                        <td><a href=<?= "./safety_update.php?safety_id=" .h($safety["safety_id"]) ?>>編集</a></td>
                        <?php if ($dept_no === 1): ?>
                            <td><a href=<?= "./delete.php?safety_id=" .h($safety["safety_id"]) ?>>削除</a></td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </section>

    <div class="bottom-links">
        <a href="./touroku.php">戻る</a>
        <a href="./index.php">ログアウト</a>
    </div>

    <script src="./../js/safetyList.js"></script>
    <script>
        const updateAccessErr = <?= json_encode($update_access_err) ?>;
        if (updateAccessErr) {
            alert(updateAccessErr);
        }
    </script>
</body>

</html>
