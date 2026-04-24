<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者画面</title>
</head>
<body>
    <div class="container"> 
    <h1>管理者メニュー</h1>
    <div class="menu">
        <a href="../../server/emp_list.php" >
            <h2>社員一覧</h2>
            <p>社員情報を確認・管理</p>
        </a>
        <a href="safetyList.php" >
            <h2>安否一覧</h2>
            <p>社員の安否状況を確認</p>
        </a>
        <a href="registerform.php">
            <h2>安否登録</h2>
            <p>安否情報を登録</p>
        </a>
        <a href="delete.php">
            <h2>安否削除</h2>
            <p>不要な安否情報を削除</p>
        </a>
       <div class="logout">
            <a href="index.php"></a>    
        </div>
    </div>
    </div>
</body>
</html>
