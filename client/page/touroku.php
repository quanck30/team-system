<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/touroku.css">
    <title>登録画面</title>


</head>

<body>
    <header>
        <h1>登録画面</h1>
    </header>
    <form action="./../../server/safety/safety_create.php" method="post">

        <div class="title">
            <h2>安否確認</h2>
        </div>
        <div class="form">
            <label>　安否状況</label>
            <input type="radio" name="safety" value="1">無事
            <input type="radio" name="safety" value="2">軽傷
            <input type="radio" name="safety" value="3">重症
            <input type="radio" name="safety" value="4">救助か必要
        </div>
        <div class="form">
            <label>出社は可能ですか？</label>
            <input type="radio" name="available" value="1">可能
            <input type="radio" name="available" value="2">在宅のみ可能
            <input type="radio" name="available" value="3">不可
        </div>
        <div class="form">
            <label>現在位置はどこですか？</label>
            <input type="text" name="location"
                placeholder="例）大阪駅">
        </div>

        コメント
        <div class="form-group horizpntal-layout">
            <label class="form-label">
                <div class="form-row">

            </label>
            <textarea name="comment" class="form-input"
                placeholder="例）けがあり"
                required></textarea>

        </div>

        <input type="submit" value="送信">
        <a href="./safetyList.php">安否情報一覧</a>
    </form>

    </div>

    <!-- <a href="safetyList.php">社員安否一覧画面</a> -->
</body>

</html>