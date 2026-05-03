<?php

require_once __DIR__ . "/../../helpers/def.php";
session_start();

// 管理者かどうか
if (empty($_SESSION["dept_no"]) || $_SESSION["dept_no"] !== 1) {
    header("Location: " . TEAM_SYSTEM . "/client/index.php");
    exit;
}

$empty_err = $_SESSION["info_null_err"] ?? "";
$no_pass_mix = $_SESSION["no_pass_mix"] ?? "";
$no_pass_enough = $_SESSION["no_pass_enough"] ?? "";
$no_pass_err = $_SESSION["no_pass_err"] ?? "";
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社員登録</title>
    <link rel="stylesheet" href="../css/registerform.css">
</head>

<body>

    <div class="wrapper">
        <div class="container">

            <?php if (isset($empty_err)): ?><!--それぞれの項目が空じゃないか-->
                <p><?= $empty_err ?></p>
            <?php else: ?>
                <p></p>
            <?php endif ?>

            <h2>社員登録</h2>
            <p class="subtitle">新しい社員情報を入力してください</p>

            <form action="../../server/emp_register.php" method="post">

                <div class="form-group">
                    <label>社員番号</label>
                    <input name="emp_no" type="text" placeholder="例: 2260392" required>
                </div>

                <div class="form-group">
                    <label>名前 (ENAME)</label>
                    <input name="ename" type="text" placeholder="例: 山田 太郎" required>
                </div>

                <div class="form-group">
                    <label>生年月日</label>
                    <input name="birthday" type="date" required>
                </div>

                <div class="form-group">
                    <label>性別</label>
                    <select name="sex" required>
                        <option value="">選択してください</option>
                        <option value="M">男性</option>
                        <option value="F">女性</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>電話番号</label>
                    <input name="tel" type="text" required>
                </div>

                <div class="form-group">
                    <label>住所</label>
                    <input name="address" type="text" required>
                </div>

                <div class="form-group">
                    <label>職種</label>
                    <select name="job" required>
                        <option value="1">システムエンジニア</option>
                        <option value="2">WEBデザイナー</option>
                        <option value="3">カスタマーサポート</option>
                        <option value="4">業務員</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>部署番号</label>
                    <select name="dept_no" required>
                        <option value="1">営業</option>
                        <option value="2">人事</option>
                        <option value="3">マーケティング</option>
                        <option value="4">財務</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>管理番号</label>
                    <select name="mgr_no" required>
                        <option value="1">E001</option>
                        <option value="2">E002</option>
                        <option value="3">E003</option>
                        <option value="4">E004</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>パスワード</label>
                    <input name="password" type="password" required>
                    <?php if (isset($no_pass_mix)): ?><!--数字混合か-->
                        <p><?= $no_pass_mix ?></p>
                    <?php else: ?>
                        <p></p>
                    <?php endif ?>

                    <?php if (isset($no_pass_enough)): ?><!--8文字以上か-->
                        <p><?= $no_pass_enough ?></p>
                    <?php else: ?>
                        <p></p>
                    <?php endif ?>

                </div>

                <div class="form-group">
                    <label>パスワード確認</label>
                    <input name="confirm_password" type="password" required>
                    <?php if (isset($no_pass_err)): ?><!--パスワードの合致-->
                        <p><?= $no_pass_err ?></p>
                    <?php else: ?>
                        <p></p>
                    <?php endif ?>
                </div>

                <button type="submit">登録</button>

            </form>

            <p><a href="../index.php">ログインに戻る</a></p>

        </div>
    </div>
</body>

</html>