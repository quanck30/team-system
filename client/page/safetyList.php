<!DOCTYPE html>
<html lang="ja">
<?php
// 安否一覧表示画面
// 2026・04・21
require_once __DIR__ . "/../../server/safety/safety_show.php";
// $safeties = get_all_safety();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社員安否一覧画面</title>
    <link rel="stylesheet" href="./../css/index.css">
    <link rel="stylesheet" href="./../css/safety.css">
</head>

<body>
    <div>
        <h1>社員安否一覧画面</h1>
        <a class="back" href="">安否登録</a>
    </div>
    <h2>安否一覧表示</h2>

    <section class="safety-display">
        <table>
            <thead>
                <tr>
                    <th>社員番号</th>
                    <th>名前</th>
                    <th>安否状態</th>
                    <th>コメント</th>
                    <th></th>
                </tr>
            </thead>

            <tbody> <!-- <?php foreach ($safeties as $safety): ?> -->
                <!-- <tr>
                     <th><?= h($safety["emp_no"]) ?></th>
                     <th><?= h($safety["ename"]) ?></th>
                     <th><?= h($safety["status"]) ?></th>
                     <th><?= h($safety["comment"]) ?></th>
                 </tr> -->
                <!-- <?php endforeach ?> -->
                <tr>
                    <td>20260304</td>
                    <td>佐藤太郎</td>
                    <td>安全</td>
                    <td>特にない</td>
                    <td><a href="./safetydetail.php">詳細</a></td>
                </tr>
                <tr>
                    <td>20260304</td>
                    <td>佐藤太郎</td>
                    <td>安全</td>
                    <td>特にない</td>
                    <td><a href="./safetydetail.php">詳細</a></td>
                </tr>
                <tr>
                    <td>20260304</td>
                    <td>佐藤太郎</td>
                    <td>安全</td>
                    <td>特にない</td>
                    <td><a href="./safetydetail.php">詳細</a></td>
                </tr>
                <tr>
                    <td>20260304</td>
                    <td>佐藤太郎</td>
                    <td>安全</td>
                    <td>特にない</td>
                    <td><a href="./safetydetail.php">詳細</a></td>
                </tr>
            </tbody>

    <?php echo $emp_no  ?><br>
    </div>
    
        <div class="title">
    <a href="safetydetail.php">安否詳細画面</a>
        
    </div>
        </table>
    </section>
</body>

</html>