<?php
// ルートユーザーを作成する

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . "/../helpers/utils.php";

$employees = [
    [
        'emp_no' => 'E0001',
        'ename' => '田中 太郎',
        'birthday' => '1985-05-20',
        'sex' => 'M',
        'tel' => '080-1234-5678',
        'address' => '東京都新宿区西新宿1-1-1',
        'job_no' => 1,
        'dept_no' => 1
    ],
    [
        'emp_no' => 'E0002',
        'ename' => '佐藤 美紀',
        'birthday' => '1992-11-10',
        'sex' => 'F',
        'tel' => '090-8765-4321',
        'address' => '神奈川県横浜市中区桜木町',
        'job_no' => 1,
        'dept_no' => 2
    ],
    [
        'emp_no' => 'E0003',
        'ename' => '鈴木 一郎',
        'birthday' => '1978-03-15',
        'sex' => 'M',
        'tel' => '070-1122-3344',
        'address' => '千葉県千葉市中央区',
        'job_no' => 1,
        'dept_no' => 3
    ],
    [
        'emp_no' => 'E0004',
        'ename' => '高橋 健一',
        'birthday' => '1980-07-22',
        'sex' => 'M',
        'tel' => '080-3344-5566',
        'address' => '埼玉県さいたま市大宮区',
        'job_no' => 1,
        'dept_no' => 4
    ],
    [
        'emp_no' => 'E0005',
        'ename' => '伊藤 あおい',
        'birthday' => '1995-12-05',
        'sex' => 'F',
        'tel' => '090-2233-4455',
        'address' => '東京都渋谷区道玄坂',
        'job_no' => 2,
        'dept_no' => 3
    ],
    [
        'emp_no' => 'E0006',
        'ename' => '渡辺 誠',
        'birthday' => '1988-09-18',
        'sex' => 'M',
        'tel' => '070-9988-7766',
        'address' => '千葉県船橋市本町',
        'job_no' => 2,
        'dept_no' => 2
    ],
    [
        'emp_no' => 'E0007',
        'ename' => '中村 結衣',
        'birthday' => '1993-04-30',
        'sex' => 'F',
        'tel' => '080-4455-6677',
        'address' => '東京都港区六本木',
        'job_no' => 2,
        'dept_no' => 3
    ],
    [
        'emp_no' => 'E0008',
        'ename' => '小林 裕太',
        'birthday' => '1982-11-12',
        'sex' => 'M',
        'tel' => '090-6677-8899',
        'address' => '神奈川県川崎市中原区',
        'job_no' => 3,
        'dept_no' => 2
    ],
    [
        'emp_no' => 'E0009',
        'ename' => '加藤 陽子',
        'birthday' => '1975-06-08',
        'sex' => 'F',
        'tel' => '070-5566-7788',
        'address' => '東京都江東区豊洲',
        'job_no' => 3,
        'dept_no' => 3
    ]
];

$managers = [
    ['mgr_no' => 'E0001', 'dept_no' => 1],
    ['mgr_no' => 'E0002', 'dept_no' => 2],
    ['mgr_no' => 'E0003', 'dept_no' => 3],
    ['mgr_no' => 'E0004', 'dept_no' => 4],
];

$safeties = [
    ['emp_no' => 'E0001', 'status_id' => 1, 'comment' => '家族全員無事です。避難所にいます。', 'location' => '代々木公園避難所', 'can_work_no' => 1, 'create_at' => '2026-04-30 10:43:07'],
    ['emp_no' => 'E0002', 'status_id' => 2, 'comment' => '足に軽い怪我をしましたが、歩けます。', 'location' => '自宅', 'can_work_no' => 2, 'create_at' => '2026-04-30 10:43:07'],
    ['emp_no' => 'E0003', 'status_id' => 1, 'comment' => '外出中でしたが、怪我はありません。', 'location' => '品川駅付近', 'can_work_no' => 3, 'create_at' => '2026-04-30 10:43:07'],
    ['emp_no' => 'E0004', 'status_id' => 1, 'comment' => '会社にいます。備蓄食料を確認中です。', 'location' => '本社ビル3F', 'can_work_no' => 1, 'create_at' => '2026-04-30 11:15:20'],
    ['emp_no' => 'E0005', 'status_id' => 3, 'comment' => '家財が倒れて動けません。助けを待っています。', 'location' => '世田谷区アパート', 'can_work_no' => 3, 'create_at' => '2026-04-30 11:20:45'],
    ['emp_no' => 'E0006', 'status_id' => 2, 'comment' => '電車の中で立ち往生しています。復旧待ち。', 'location' => '新宿駅構内', 'can_work_no' => 2, 'create_at' => '2026-04-30 11:30:10'],
    ['emp_no' => 'E0007', 'status_id' => 1, 'comment' => '近所の消火活動を手伝っています。午後から在宅可。', 'location' => '実家(中野区)', 'can_work_no' => 2, 'create_at' => '2026-04-30 11:45:00'],
    ['emp_no' => 'E0008', 'status_id' => 4, 'comment' => '怪我人がいます。至急救急車を呼びたいが繋がりません。', 'location' => '渋谷交差点付近', 'can_work_no' => 3, 'create_at' => '2026-04-30 11:55:12'],
    ['emp_no' => 'E0009', 'status_id' => 1, 'comment' => '通信環境が悪いため、取り急ぎ無事のみ報告します。', 'location' => '不明(移動中)', 'can_work_no' => 1, 'create_at' => '2026-04-30 12:05:30'],
];
$pdo = getPDO();
try {
    $pdo->beginTransaction();

    // =====================
    // 1. INSERT employee
    // =====================
    $stmtEmp = $pdo->prepare("
        INSERT INTO employee 
        (emp_no, ename, birthday, sex, tel, address, job_no, dept_no, password)
        VALUES (:emp_no, :ename, :birthday, :sex, :tel, :address, :job_no, :dept_no, :password)
        ON DUPLICATE KEY UPDATE ename = VALUES(ename)
    ");

    foreach ($employees as $emp) {
        $stmtEmp->execute([
            ':emp_no'   => $emp['emp_no'],
            ':ename'    => $emp['ename'],
            ':birthday' => $emp['birthday'],
            ':sex'      => $emp['sex'],
            ':tel'      => $emp['tel'],
            ':address'  => $emp['address'],
            ':job_no'   => $emp['job_no'],
            ':dept_no'  => $emp['dept_no'],
            ':password' => password_hash("12345678", PASSWORD_DEFAULT)
        ]);
    }

    // // =====================
    // // 2. UPDATE manager
    // =====================
    $stmtMgr = $pdo->prepare("
        UPDATE department 
        SET mgr_no = :mgr_no 
        WHERE dept_no = :dept_no
    ");

    foreach ($managers as $mgr) {
        $stmtMgr->execute([
            ':mgr_no' => $mgr['mgr_no'],
            ':dept_no' => $mgr['dept_no']
        ]);
    }

    // =====================
    // 3. INSERT Safety
    // =====================
    $stmtRep = $pdo->prepare("
        INSERT INTO safety 
        (emp_no, status_id, comment, current_location, can_work_no, create_at)
        VALUES (:emp_no, :status_id, :comment, :location, :can_work_no, NOW())
    ");

    foreach ($safeties as $saf) {
        $stmtRep->execute([
            ':emp_no'      => $saf['emp_no'],
            ':status_id'   => $saf['status_id'],
            ':comment'     => $saf['comment'],
            ':location'    => $saf['location'],
            ':can_work_no' => $saf['can_work_no']
        ]);
    }

    $pdo->commit();

    echo "初期データの登録が完了しました。";
} catch (\Throwable $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    echo "ERROR: " . $e->getMessage();
    echo "<br>FILE: " . $e->getFile();
    echo "<br>LINE: " . $e->getLine();

    exit;
}
