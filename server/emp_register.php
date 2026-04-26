<?php
//社員情報の登録（サーバー）
// マサキカイリ

require_once __DIR__ . "/../server/index.php";
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";

//URLの直打ちを対策
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    access();
}
//管理人かどうか
kengen($_SESSION['dept_no']);

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
    'admin_role' => '管理者権限',//TODO:管理者権限には何が入る？
    'password' => 'パスワード',
    'confirm_password' => 'パスワード確認',
];

$errors = [];

//値が空かどうかのチェックのループ
foreach($info_fields as $info => $label){
    if(empty($inputs[$info])){
        $errors[] = "{$label}が入力されていません";

    }
}

//パスワードが再確認用のパスワードと同じかどうか
if($inputs['password'] !== $inputs['confirm_password']){
    $errors[] = "パスワードが違います";
}

$_SESSION['info_null'] = $errors;

function register($inputs)//引数にregisterform.phpの情報をとってくる
{
    if(empty($errors)){

        try{
            //DB登録
            $db = getPDO();

            //sql文
            $sql = "INSET INTO EMPLOYEE (
                        emp_no ,ename ,birthday ,sex ,tel ,address ,job ,salary ,dept_no ,mgr_no ,admin_role ,password
                    ) values (
                        :emp_no ,:ename ,:birthday ,:sex ,:tel ,:address ,:job ,:salary ,:dept_no ,:mgr_no ,:admin_role ,:password)";

            $stmt = $db -> prepare($sql);//sqlの準備
            //sex
            if($inputs['sex'] === "M"){
                //男性
                $stmt -> bindValue('sex' , 'M' ,PDO::PARAM_STR);
            } else {
                //女性
                $stmt->bindValue('sex', 'F', PDO::PARAM_STR);
            }
            //dept_no
            //admin_role
            // パスワードのハッシュ化

        } catch (PDOException $poe){

        }
    }
}
?>