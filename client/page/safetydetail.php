<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安否詳細画面</title>
    <link rel="stylesheet" href="../css/dezain.css">

  
</head>
<body>
    <header>
       <h1>安否詳細画面</h1>
    </header>
    <!-- 一覧表示 -->
    <table>
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>メール</th>
        </tr>
        <?php if (!empty($rows)): ?>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="3">データがありません</td></tr>
    <?php endif; ?>
    </table>
    
</body>
</html>