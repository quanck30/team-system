<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社員安否一覧画面</title>
    <link rel="stylesheet" href="../css/dezain.css">



</head>
<body>
    <header>
        <h1>社員安否一覧画面</h1>
    </header>
    
    
    <div class="box">
        <div class=title>
    <h2>一覧</h2>
        </div>

    <?php $emp_no = $_POST['safety'] ?>


    

    <?php echo $emp_no  ?><br>
    </div>
    
        <div class="title">
    <a href="safetydetail.php">安否詳細画面</a>
        
    </div>
</body>
</html>