<?php
//ログイン画面のサーバー側
//マサキカイリ
// Home.phpからもらってきたログイン情報をここで処理してログイン情報を渡す
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";

function access()
{
    header("Location: " . TEAM_SYSTEM . "/client/index.php");
    exit;
}
//POSTじゃないならHomeに返す
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    access();
}
access();


<<<<<<< HEAD
function kengen($dept_no,$page){//管理者なのかチェック
=======
function modoru($dept_no, $page)
{ //管理者なのかチェック
>>>>>>> 505b078d5f558814775d587de2e54fbdf67b56be
    if ($dept_no === "1") {
        header("Location: " . TEAM_SYSTEM . "/client/page/" . $page . ".php");
        exit;
    } else {
        header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
        exit;
    }
}

//セッションスタート
session_start();

//　IDが空じゃないか
$emp_no = filter_input(INPUT_POST, "emp_no", FILTER_VALIDATE_INT);
if (empty($emp_no)) {
    $_SESSION['emp_no_err'] = "従業員番号が空です。";
    access();
}
//　IDがint型か
if (!is_int($emp_no)) {
    $_SESSION['emp_no_err'] = "従業員番号に数字以外が入っています";
    access();
}


//　パスワードは空じゃないか
$pass = filter_input(INPUT_POST, "password");
if (empty($pass)) {
    $_SESSION['pass_err'] = "パスワードが空です。";
    access();
}

// パスワードをハッシュ化
// $hashpass = password_verify($pass , PASSWORD_DEFAULT);


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
        $_SESSION['emp_no'] = $emp_no;
        $_SESSION['dept_no'] = $dept_no;

        //dept_no(部署)が１なら管理人の画面に遷移
        $page = "manager";
        $dept_no = $user['DEPT_NO'];
<<<<<<< HEAD
        kengen($dept_no,$page);
=======
>>>>>>> 505b078d5f558814775d587de2e54fbdf67b56be

        //  PDOオブジェクトを破棄
        $stmt = null;
        $db = null;
        modoru($dept_no, $page);


        //パスワードが間違ってたらHomeに遷移
    } else {
        $_SESSION["pass_err"] = "パスワードが間違っている";
        access();
    }
} catch (PDOException $poe) {
    access();
    // exit("DBエラー" . $poe->getMessage());//開発時だけメッセージ表示
}
