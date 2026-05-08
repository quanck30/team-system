<?php
//社員情報の登録（サーバー）
// マサキカイリ

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php"; //多分def.phpいらない
require_once __DIR__ . "/../helpers/utils.php";


//セッションスタート
session_start();

//URLの直打ちを対策
// access();

// if ($_SERVER["REQUEST_METHOD"] !== "POST") { 
//     homeidou();
// }

// $emp_no = $_POST['emp_no'] ?? ""; 
// $ename = $_POST['ename'] ?? ""; 
// $birthday = $_POST['birthday'] ?? "";
// $sex = $_POST['sex'] ?? "";
// $tel = $_POST['tel'];
// $address = $_POST['address'] ?? "";
// $job = $_POST['job'] ?? "";
// $salary = $_POST['salary'] ?? "";
// $dept_no = $_POST['dept_no'] ?? "";
// $mgr_no  = $_POST['mgr_no'] ?? "";
// $admin_role = $_POST['admin_role'] ?? "";
// $password = $_POST['password'] ?? "";
// $confirm_password = $_POST['confirm_password'] ?? ""; 

//上の変数に格納とやっている内容は同じ
$inputs = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS) ?: [];

// foreach($inputs as $i){//debug用
// echo $i . "<br>";
// }

$info_fields = [
    'emp_no'    => '社員番号',
    'Lname'     => '苗字',
    'Fname'     => '名前',
    'birthday'  => '生年月日',
    'sex'       => '性別',
    'tel'       => '電話番号',
    'address'   => '住所',
    'job_no'    => '職種',
    'dept_no'   => '部署番号',
    'password'  => 'パスワード',
    'confirm_password' => 'パスワード確認',
];

$errors = [];

// echo "trim前";
// foreach($inputs as $info){
//     echo $info . "<br>";
// }

$inputs = array_map(function ($v) {
    if (!is_string($v)) return $v;
    // 全角スペースを半角にし、前後の空白を削除
    return trim(mb_convert_kana($v, "s", "UTF-8"));
}, $inputs);

// trimで空白を除去
// $inputs = array_map(function ($v) { //第一引数に使いたい関数、第二引数に配列名
//     return str_replace([" ", "　"], "", $v); //空白をすべて除去
// }, $inputs);

// echo "trim後";

//値が空かどうかのチェックのループ
foreach ($info_fields as $info => $label) {
    if (!isset($inputs[$info]) || $inputs[$info] === "") {
        // echo $inputs[$info] . "<br>";//todo
        $errors[] = "{$label}が入力されていません。";
    }
}
// echo $inputs["job_no"];//TODO

// 社員番号はSTR型か
if(!is_string($inputs["emp_no"])){
    $errors[] = "半角数字だけにしてください。";
}
if(strlen($inputs['emp_no']) !== 8){
    $errors[] = "社員番号は8桁にしてください。";
}

//英数字混合か判断 preg_matchは英数字が含まれてたら1 含まれていなかったら0を返す
if (preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/', $inputs['password']) === 0) {
    $errors[] = "パスワードは英数字混合にしてください。";
}

//パスワードが8文字以上か
if (strlen($inputs['password']) <= 7) {
    $errors[] = "パスワードを8文字以上に設定してください。";
}

//パスワードが再確認用のパスワードと同じかどうか
if ($inputs['password'] !== $inputs['confirm_password']) {
    $errors[] = "パスワードが違います。";
}


//電話番号の形式があっているか(000 1111 2222) ← 〇 (0000 1111 2222) ← ✖
$inputs["tel"] = str_replace(["-", " ", "　"], "", $inputs["tel"]);
if (strlen($inputs["tel"]) !== 11) {
    // echo $inputs["tel"] . "格納前"; //todo
    $errors[] = "電話番号が正しく入力されていません。";
}
$inputs["tel"] = preg_replace('/(\d{3})(\d{4})(\d{4})/', '$1-$2-$3', $inputs["tel"]);

//sessionに入力した値を保存
$_SESSION["old_inputs"] = $inputs;

if(!empty($errors)){
    $_SESSION['erres'] = $errors;
    nextpage("registerform");
    // echo "エラー";//debug用
    exit;
}

$inputs["ename"] = $inputs["Lname"] . " " . $inputs["Fname"];

try {
    //DB登録
    $pdo = getPDO();

    //トランザクション開始
    $pdo->beginTransaction();

    //sql文
    $sql = "INSERT INTO EMPLOYEE (
                    emp_no ,ename ,birthday ,sex ,tel ,address ,job_no ,dept_no ,password
                ) values (
                    :emp_no ,:ename ,:birthday ,:sex ,:tel ,:address , :job_no, :dept_no ,:password)";

    $stmt = $pdo->prepare($sql); //sqlの準備

    $params = [
        ':emp_no'     => $inputs['emp_no'],
        ':ename'      => $inputs['ename'],
        ':birthday'   => $inputs['birthday'],
        ':sex'        => $inputs['sex'],
        ':tel'        => $inputs['tel'],
        ':address'    => $inputs['address'],
        ':job_no'     => $inputs['job_no'],
        ':dept_no'    => $inputs['dept_no'],
        // ':mgr_no'     => $inputs['mgr_no'],
        ':password'   => password_hash($inputs['password'], PASSWORD_DEFAULT), // ハッシュ化
    ];

    $stmt->execute($params);

    //コミット  
    $pdo->commit();
    // $_SESSION['register_success'] = "データの登録が成功しました。";
    // echo "データの登録に成功しました";
    nextpage("registerComplete");
} catch (PDOException $poe) {
    $pdo->rollback();
    $_SESSION['register_err'] = "データの登録に失敗しました。";
    nextpage("registerform");
    // echo "データの登録に失敗しました   <br>詳細：" . $poe->getMessage(); //debug用
    exit;
}
