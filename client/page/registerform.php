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
$old_inputs = $_SESSION["old_inputs"] ?? "";
unset($_SESSION["erres"]);
unset($_SESSION["register_err"]);
unset($_SESSION["old_inputs"]);

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
            <h2>社員登録</h2>
            <p class="subtitle">新しい社員情報を入力してください</p>

            <div>
                <?php if (!empty($register_err)): ?>
                    <p><?= $register_err ?></p>
                <?php endif; ?>

                <?php if (!empty($erres)): ?>
                    <?php foreach ((array)$erres as $err): ?>
                        <p><?= $err ?></p>
                    <?php endforeach; ?>
                <?php endif ?>
            </div>

            <form action="../../server/emp_register.php" method="post">

                <div class="form-group">
                    <label>社員番号</label>
                    <input name="emp_no" type="text" value="<?= $old_inputs["emp_no"] ?? "" ?>" placeholder="例: 20260001" required>
                </div>

                <div class="form-group">
                    <label>苗字</label>
                    <input name="Lname" type="text" value="<?= $old_inputs["Lname"] ?? "" ?>" placeholder=" 例: 山田" required>
                </div>

                <div class="form-group">
                    <label>名前</label>
                    <input name="Fname" type="text" value="<?= $old_inputs["Fname"] ?? "" ?>" placeholder=" 例: 太郎" required>
                </div>

                <div class="form-group">
                    <label>生年月日</label>
                    <input name="birthday" value="<?= $old_inputs["birthday"] ?? "" ?>" type="date" required>
                </div>

                <div class="form-group">
                    <label>性別</label>
                    <select name="sex" required>
                        <option value="">選択してください</option>
                        <option value="M" <?= (isset($old_inputs["sex"]) && $old_inputs["sex"] === 'M') ? 'selected' : '' ?>>男性</option>
                        <option value="F" <?= (isset($old_inputs["sex"]) && $old_inputs["sex"] === 'F') ? 'selected' : '' ?>>女性</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>電話番号</label>
                    <input name="tel" type="text" value="<?= $old_inputs["tel"] ?? "" ?>" placeholder=" 例: 000-0000-0000" required>
                </div>

                <div class="form-group">
                    <label>住所</label>
                    <input name="address" value="<?= $old_inputs["address"] ?? "" ?>" type="text" required>
                </div>

                <div class="form-group">
                    <label>職種</label>
                    <select name="job_no" required>
                        <option value="1" <?= (isset($old_inputs["job_no"]) && $old_inputs["job_no"] === '1') ? 'selected' : '' ?>>システムエンジニア</option>
                        <option value="2" <?= (isset($old_inputs["job_no"]) && $old_inputs["job_no"] === '2') ? 'selected' : '' ?>>WEBデザイナー</option>
                        <option value="3" <?= (isset($old_inputs["job_no"]) && $old_inputs["job_no"] === '3') ? 'selected' : '' ?>>カスタマーサポート</option>
                        <option value="4" <?= (isset($old_inputs["job_no"]) && $old_inputs["job_no"] === '4') ? 'selected' : '' ?>>業務員</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>部署</label>
                    <select name="dept_no" required>
                        <option value="1" <?= (isset($old_inputs["dept_no"]) && $old_inputs["dept_no"] === '1') ? 'selected' : '' ?>>管理部</option>
                        <option value="2" <?= (isset($old_inputs["dept_no"]) && $old_inputs["dept_no"] === '2') ? 'selected' : '' ?>>営業部</option>
                        <option value="3" <?= (isset($old_inputs["dept_no"]) && $old_inputs["dept_no"] === '3') ? 'selected' : '' ?>>開発部</option>
                        <option value="4" <?= (isset($old_inputs["dept_no"]) && $old_inputs["dept_no"] === '4') ? 'selected' : '' ?>>総務部</option>
                    </select>
                </div>

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