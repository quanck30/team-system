<?php
//ログイン画面のサーバー側
//マサキカイリ
// Home.phpからもらってきたログイン情報をここで処理してログイン情報を渡す

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";

//セッションスタート
session_start();

// access();

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    homeidou();
    exit;
}

//　IDが空じゃないか
$emp_no = $_POST['emp_no'] ?? "";
if (empty($emp_no)) {
    $_SESSION['emp_no_err'] = "従業員番号が空です。";
}

// パスワードは空じゃないか
$pass = $_POST['password'];
if (empty($pass)) {
    $_SESSION['pass_err'] = "パスワードが空です。";
}

// パスワードが8文字以上か
// if(strlen(trim($pass)) <= 7){
// $_SESSION['pass_err'] = "パスワードを8文字以上に設定してください";
// }

$emp_no = trim($emp_no);
if (!preg_match('/^[0-9]{8}$/' , $emp_no) || !ctype_digit($emp_no)) {
    $_SESSION['emp_err'] = "社員番号が正しくありません。";
}

    //エラーメッセージがあったらHomeに移動
    if (!empty($_SESSION['emp_err']) || !empty($_SESSION['emp_no_err']) || !empty($_SESSION['pass_err'])) {
    homeidou();
    exit;
}


try {
    // データべースと接続
    $pdo = getPDO();

    //社員IDで情報をとってくる
    $sql = "SELECT * FROM EMPLOYEE WHERE EMP_NO = :emp_no";

    $stmt = $pdo->prepare($sql);
    //bindValueで型が正しいか確認
    $stmt->bindValue(':emp_no', $emp_no, PDO::PARAM_INT);

    //userに結果を格納
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user === false || !password_verify($pass, $user['password'])) {
        // ログイン失敗の処理
        $_SESSION['login_err'] = "従業員番号またはパスワードが正しくありません。";
        homeidou();
        exit;
    }

    // ハッシュ化したパスワードを照合
    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['emp_no'] = $user['emp_no'];
        $_SESSION['dept_no'] = $user['dept_no'];
        //ログイン済みを 1 それ以外は未定義
        $_SESSION['logged_in'] = 1;

        //dept_no(部署)が１なら管理人の画面に遷移
        if ($user['dept_no'] === 1) {
            nextpage("kanrisha");
        } else {
            //安否登録画面に遷移
            nextpage("touroku");
        }
        //  PDOオブジェクトを破棄
        $stmt = null;
        $db = null;
        //パスワードが間違ってたらHomeに遷移
    }
    exit;
} catch (PDOException $poe) {
    
    $_SESSION["login_db_err"] = "DBエラー" . $poe->getMessage();
    // homeidou();
    exit;//開発時だけメッセージ表示
}
