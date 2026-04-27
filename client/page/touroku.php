<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dezain.css">

    <title>登録画面</title>
    

</head>
<body>
    <header>
        <h1>登録画面</h1>
    </header>
    <form action="safetyList.php" method="post">
    <div class="box">
        <div class="title">
           <h2>安否確認</h2> 
        </div>
        <div class="form">
            <label>安否</label>
            <input type="radio" name="safety" value="1">安全
            <input type="radio" name="safety" value="2">危険
        </div>
        <div class="form-group horizpntal-layout">
        <label class="form-label">
        <div class="form-row">
        コメント
        </label>
        <input type="text"
               class="form-input"
               name="name"
               placeholder="例）けがあり"
               required>
               </div>
    </div>
      <input type="submit" value="送信">
    </form>

    </div>
    
    
      
      



    <!-- <a href="safetyList.php">社員安否一覧画面</a> -->
</body>
</html>