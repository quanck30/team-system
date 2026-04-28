<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社員登録</title>
    <link rel="stylesheet" href="../css/registerform.css">
</head>

<body>
<div class="container">

    <h2>社員登録</h2>

    <form action="../../server/emp_register.php" method="post">

        <label>社員番号 (EMP_NO)</label>
        <input name="emp_no" type="number" required>

        <label>名前 (ENAME)</label>
        <input name="ename" type="text" required>

        <label>生年月日 (BIRTHDAY)</label>
        <input name="birthday" type="date" required>

        <label>性別 (SEX)</label>
        <select name="sex" required>
            <option value="">選択してください</option>
            <option value="M">男性</option>
            <option value="F">女性</option>
        </select>

        <label>電話番号 (TEL)</label>
        <input name="tel" type="text" required>

        <label>住所 (ADDRESS)</label>
        <input name="address" type="text" required>

        <label>職種 (JOB)</label>
        <input name="job" type="text" required>

        <label>給与 (SALARY)</label>
        <input name="salary" type="number" required>

        <label>部署番号 (DEPT_NO)</label>
        <select name="dept_no" type="number" required>
            <option value="1"></option>
            <option value="2"></option>
            <option value="3"></option>
            <option value="4"></option>
        </select>

        <label>管理番号 (MGR_NO)</label>
        <input name="mgr_no" type="number">

        <label>管理者権限 (ADMIN_ROLE)</label>
        <select name="admin_role">
            <option value="0">一般ユーザー</option>
            <option value="1">管理者</option>
        </select>

        <label>パスワード</label>
        <input name="password" type="password" required>

        <label>パスワード確認</label>
        <input name="confirm_password" type="password" required>

        <button type="submit">登録</button>

    </form>

    <p><a href="../index.php">ログインに戻る</a></p>

</div>
</body>
</html>