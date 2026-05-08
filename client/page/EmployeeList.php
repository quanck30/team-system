<?php
// 社員一覧表示画面
// 2026・04・21
// require_once __DIR__ . "/../../server/safety/safety_show.php";
require_once __DIR__ . "/../../server/emp_list.php";
// session_start();//emp.list.php側で呼び出してるからいらない
// 管理者かどうか
if (empty($_SESSION["dept_no"]) || $_SESSION["dept_no"] !== 1) {
    header("Location: " . TEAM_SYSTEM . "/client/page/index.php");
    exit;
}

$db_err = $_SESSION["error_message_list"] ?? "";
// $safeties = get_all_safety();
$users = get_info();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社員一覧画面</title>
    <!-- <link rel="stylesheet" href="./../css/index.css">
    <link rel="stylesheet" href="./../css/safety.css"> -->
    <link rel="stylesheet" href="./../css/safetyList.css">

</head>

<body>
    <header>
        <div>
            <h1>社員一覧画面</h1>
        </div>
    </header>
    
    <?php if (isset($db_err)): ?>
        <p><?= h($db_err) ?></p>
    <?php endif; ?>

    <h2>社員一覧表示</h2>
    <div class="bottom-links">
        <a href="registerform.php">新規登録</a>
    </div>

    <section class="safety-display">
        <table>
            <thead>
                <tr>
                    <th>社員番号</th>
                    <th>名前</th>
                    <th>部署</th>
                    <th>上司名</th>
                    <th>職種</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th><?= h($user["emp_no"]) ?></th><!-- 従業員番号-->
                        <th><?= h($user["ename"]) ?></th><!-- 従業員の名前-->
                        <th><?= h($user["dname"]) ?></th><!-- 部署の名前-->
                        <th><?= h($user["mname"]) ?></th><!-- 上司名-->
                        <th><a href="detail.php">詳細</a></th>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td>20260304</td>
                    <td>佐藤太郎</td>
                    <td>大阪市店</td>
                    <td>大阪府大阪市</td>
                </tr>
                <tr>
                    <td>20260304</td>
                    <td>佐藤太郎</td>
                    <td>大阪市店</td>
                    <td>大阪府大阪市</td>
                </tr>
                <tr>
                    <td>20260304</td>
                    <td>佐藤太郎</td>
                    <td>大阪市店</td>
                    <td>大阪府大阪市</td>
                </tr>
                <tr>
                    <td>20260304</td>
                    <td>佐藤太郎</td>
                    <td>大阪市店</td>
                    <td>大阪府大阪市</td>
                </tr>
            </tbody>

        </table>
        <!-- <?php echo $emp_no  ?><br>  -->
    </section>
    <div class="bottom-links">
        <a href="kanrisha.php">戻る</a>
        <a href="index.php">ログアウト</a>
    </div>
</body>

</html>