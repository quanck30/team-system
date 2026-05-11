<?php

require_once __DIR__ . "/../../helpers/def.php";
require_once __DIR__ . "/../../helpers/utils.php";
session_start();
// 管理者かどうか
if (empty($_SESSION["dept_no"]) || $_SESSION["dept_no"] !== 1) {
    header("Location: " . TEAM_SYSTEM . "/client/index.php");
    exit;
}

$erres = $_SESSION["erres"] ?? "";
$register_err = $_SESSION["register_err"] ?? "";
unset($_SESSION["erres"]);
unset($_SESSION["register_err"]);


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
    <?php if (!empty($erres)) : ?>
    <p class="err"><?= $erres ?></p>
    <?php endif; ?>

    <?php if (!empty($register_err)) : ?>
    <p class="err"><?= $register_err ?></p>
<?php endif; ?>


    <div class="wrapper">
        <div class="container">
            <h2>社員登録</h2>
            <p class="subtitle">新しい社員情報を入力してください</p>

            <?php if (!empty($register_err)): ?>
                <p><?= $register_err ?></p>
            <?php endif; ?>

            <?php if (!empty($erres)): ?>
                <?php foreach ((array)$erres as $err): ?>
                    <p><?= $err ?></p>
                <?php endforeach; ?>
            <?php endif ?>

            <form action="../../server/emp_register.php" method="post">

                <div class="form-group">
                    <label>社員番号</label>
                    <input name="emp_no" type="text" placeholder="例: 20260001" required>
                </div>

                <div class="form-group">
                    <label>苗字</label>
                    <input name="Lname" type="text" placeholder="例: 山田" required>
                </div>

                <div class="form-group">
                    <label>名前</label>
                    <input name="Fname" type="text" placeholder="例: 太郎" required>
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
                    <input name="tel" type="text" placeholder="例: 000-0000-0000" required>
                </div>

                <div class="form-group">
                    <label>住所</label>
                    <input name="address" type="text" required>
                </div>

                <div class="form-group">
                    <label>職種</label>
                    <select name="job_no" required>
                        <option value="1">システムエンジニア</option>
                        <option value="2">WEBデザイナー</option>
                        <option value="3">カスタマーサポート</option>
                        <option value="4">業務員</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>部署</label>
                    <select name="dept_no" required>
                        <option value="1">管理部</option>
                        <option value="2">営業部</option>
                        <option value="3">開発部</option>
                        <option value="4">総務部</option>
                    </select>
                </div>

                <!-- <div class="form-group">
                    <label>管理番号</label>
                    <select name="mgr_no" required>
                        <option value="1">E001</option>
                        <option value="2">E002</option>
                        <option value="3">E003</option>
                        <option value="4">E004</option>
                    </select>
                </div> -->

                <div class="form-group">
                    <label>パスワード</label>
                    <input name="password" type="password" required>
                </div>

                <div class="form-group">
                    <label>パスワード確認</label>
                    <input name="confirm_password" type="password" required>
                </div>

                <button type="submit">登録</button>

            </form>

            <p><a href="../index.php">ログインに戻る</a></p>
            <p><a href="kanrisha.php">管理者画面</a></p>

        </div>
    </div>
</body>

</html>