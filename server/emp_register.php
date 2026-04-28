<?php
//社員情報の登録（サーバー）
// マサキカイリ

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";


//セッションスタート
session_start();

//URLの直打ちを対策
access($_SESSION['dept_no']);

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

$info_fields = [
    'emp_no' => '社員番号',
    'ename' => '名前',
    'birthday' => '生年月日',
    'sex' => '性別',
    'tel' => '電話番号',
    'address' => '住所',
    'job' => '職種',
    'salary' => '給与',
    'dept_no' => '部署番号',
    'mgr_no' => '管理番号',
    'admin_role' => '管理者権限',
    'password' => 'パスワード',
    'confirm_password' => 'パスワード確認',
];

$errors = [];

//値が空かどうかのチェックのループ
foreach ($info_fields as $info => $label) {
    if (empty($inputs[$info])) {
        $errors[] = "{$label}が入力されていません";
    }
}

//英数字混合か判断 preg_matchは英数字が含まれてたら1 含まれていなかったら0を返す
if(preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/', $inputs['password']) === 0){
    $errors['no_pass_mix'] = "パスワードは英数字混合にしてください。";
}

//パスワードが8文字以上か
if (strlen(trim($inputs['password'])) <= 7) {
    $errors['no_pass_enough'] = "パスワードを8文字以上に設定してください";
}

//パスワードが再確認用のパスワードと同じかどうか
if ($inputs['password'] !== $inputs['confirm_password']) {
    $errors['no_pass_err'] = "パスワードが違います";
}


$_SESSION['info_null_err'] = $errors;

if (empty($errors)) {
    try {
        //DB登録
        $db = getPDO();

        //トランザクション開始
        $db->beginTransaction();

        //sql文
        $sql = "INSERT INTO EMPLOYEE (
                        emp_no ,ename ,birthday ,sex ,tel ,address ,job ,salary ,dept_no ,mgr_no ,admin_role ,password
                    ) values (
                        :emp_no ,:ename ,:birthday ,:sex ,:tel ,:address ,:job ,:salary ,:dept_no ,:mgr_no ,:admin_role ,:password)";

        $stmt = $db->prepare($sql); //sqlの準備

        $params = [
            ':emp_no'     => $inputs['emp_no'],
            ':ename'      => $inputs['ename'],
            ':birthday'   => $inputs['birthday'],
            ':sex'        => $inputs['sex'],
            ':tel'        => $inputs['tel'],
            ':address'    => $inputs['address'],
            ':job'        => $inputs['job'],
            ':salary'     => $inputs['salary'],
            ':dept_no'    => $inputs['dept_no'],
            ':mgr_no'     => $inputs['mgr_no'],
            ':admin_role' => $inputs['admin_role'],
            // 'password' => $inputs['password']//TODO:rootユーザー作成後削除
            ':password'   => password_hash($inputs['password'], PASSWORD_DEFAULT), // ハッシュ化
        ];

        $stmt->execute($params);

        //コミット  
        $db->commit();
        $_SESSION['register_success'] = "データの登録が成功しました";
    } catch (PDOException $poe) {
        $db->rollback();
        $_SESSION['register_err'] = "データの登録に失敗しました   <br>詳細：" . $poe->getMessage();
        exit;
    }
}
?>