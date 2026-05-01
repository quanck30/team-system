<?php
//ログイン画面のサーバー側
//マサキカイリ
// Home.phpからもらってきたログイン情報をここで処理してログイン情報を渡す

require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";

//セッションスタート
session_start();

if($_SERVER['REQUEST_METHOD'] !== "POST"){
    exit;
}

//　IDが空じゃないか
$raw_emp_no = $_POST['emp_no'] ?? "";
if (empty($raw_emp_no)) {
    $_SESSION['emp_no_err'] = "従業員番号が空です。";
    // access($_SESSION['dept_no']);//まだセッションにdept_noなどが格納されていない
}
//　IDがint型か
if (!ctype_digit($raw_emp_no)) {
    $_SESSION['emp_no_err'] = "従業員番号に数字以外が入っています";
}

// パスワードは空じゃないか
$pass = $_POST['password'];
if (empty($pass)) {
    $_SESSION['pass_err'] = "パスワードが空です。 <br>";
}

// パスワードが8文字以上か
if(strlen(trim($pass)) <= 7){
$_SESSION['pass_err'] = "パスワードを8文字以上に設定してください";
}

//エラーメッセージがあったらHomeに移動
if (!empty($_SESSION['emp_no_err']) || !empty($_SESSION['pass_err'])){
    homeidou();
    exit;
}


try {
    // データべースと接続
    $db = getPDO();

    //社員IDで情報をとってくる
    $sql = "SELECT * FROM EMPLOYEE WHERE EMP_NO = :emp_no";

    $stmt = $db->prepare($sql);
    //bindValueで型が正しいか確認
    $stmt->bindValue(':emp_no', $emp_no, PDO::PARAM_INT);

    //userに結果を格納
    $stmt->execute();
    $user = $stmt->fetch();

    // ハッシュ化したパスワードを照合
    if (password_verify($pass, $user['password'])) {
        // セッションの保存（社員番号）
        $_SESSION['emp_no'] = $user['emp_no'];
        $_SESSION['dept_no'] = $user['dept_no'];

        //ログイン済みを 1 それ以外は未定義
        $_SESSION['logged_in'] = 1;

        //dept_no(部署)が１なら管理人の画面に遷移
        $dept_no = $user['DEPT_NO'];
        if ($dept_no === "1") {
            // $page = "manager";
            nextpage("kanrisha");
        } else {
            //安否登録画面に遷移
            nextpage("touroku");
        }
        //  PDOオブジェクトを破棄
        $stmt = null;
        $db = null;
    //パスワードが間違ってたらHomeに遷移
    } else {
        $_SESSION["pass_err"] = "パスワードが間違っている";
        homeidou();
    }
    exit;
} catch (PDOException $poe) {
    homeidou();
    exit("DBエラー" . $poe->getMessage());//開発時だけメッセージ表示
}
