<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="touroku.css">
    <title>登録画面</title>
    
    <style>
        
    header{
            background-color: #3498db;
            color: white;              
            padding: 20px;              
            text-align: center;
        }
    body {
    background-color: #ffffff;
    }
    </style>

</head>
<body>
     <header>
        <h1>登録画面</h1>
    </header>

    <h3>あなたの現在の安否を選択してください</h3>
    <form action="safetyList.php" method="post">
        <input type="checkbox" name="safety" value="安全">安全
        <input type="checkbox" name="safety" value="危険">危険<br>
        <label for="date">日付を選択してください:</label>
        <input type="date" id="date" name="date">
        <input type="submit" value="送信">
    </form>



    <!-- <a href="safetyList.php">社員安否一覧画面</a> -->
</body>
</html>