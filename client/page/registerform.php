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
      <p class="subtitle">新しい社員情報を入力してください</p>

    <form action="../../server/register.php" method="post">

        <div class="form-group">
            <label>社員番号</label>
            <input name="emp_no" type="text" placeholder="例: 2260392" required>
        </div>

        <div class="form-group">
            <label>名前 (ENAME)</label>
            <input name="ename" type="text" placeholder="例:　山田　blahblah" required>
        </div>

        <div class="form-group">
            <label>生年月日 (BIRTHDAY)</label>
            <input name="birthday" type="date" required>
        </div>

        <div class="form-group">
        <label>性別 (SEX)</label>
            <select name="sex" required>
                <option value="">選択してください</option>
                <option value="M">男性</option>
                <option value="F">女性</option>
            </select>
        </div>

        <div class="form-group">
            <label>電話番号 (TEL)</label>
            <input name="tel" type="text" required>
        </div>

        <div class="form-group">
            <label>住所 (ADDRESS)</label>
            <input name="address" type="text" required>
        </div>

        <div class="form-group">
        <label>職種 (JOB)</label>
            <select name="job" type="text" required>
                <option value="1">システムエンジニア</option>
                <option value="2">WEBデザイナー</option>
                <option value="3">カスタマーサポート</option>
                <option value="4">業務員</option>
            </select>
        </div>

        <div class="form-group">
        <label>部署番号 (DEPT_NO)</label>
            <select name="dept_no" type="text" required>
                <option value="1">営業</option>
                <option value="2">人事</option>
                <option value="3">マーケティング</option>
                <option value="4">財務</option>
            </select>
        </div>

        <div class="form-group">
            <label>管理番号 (MGR_NO)</label>
            <input name="mgr_no" type="text">
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

</div>
</body>
</html>
