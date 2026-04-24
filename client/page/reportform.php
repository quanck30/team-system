<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Form</title>
    <link rel="stylesheet" href="/css">
</head>
<body>
    <div>
        <form action="../../server/reportform.php" method="post">
        <label>
            <input type="radio" name="status" value="0" required>無事
            <input type="radio" name="status" value="1" required>無事じゃない
        </label><br>
        <button type="submit">送信</button>
        </form>
    </div>    
</body>
</html>
