<?php
//ログイン画面のサーバー側
//マサキカイリ
// Home.phpからもらってきたログイン情報をここで処理してログイン情報を渡す
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";


function access()
{
    //Home.phpに遷移
    header("Location: " . TEAM_SYSTEM . "/client/Home.php");
    exit;
}
//URL直打ちを対策
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    access();
}



function kengen($dept_no){//管理者なのかチェック
    if ($dept_no !== "1") {
        header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
    }
}
function nextpage($page)//次のページに遷移
{
    header("Location: " . TEAM_SYSTEM . "/client/page/" . $page . ".php");
}

//セッションスタート
session_start();
//セッションにデータを保存
$_SESSION['message'];

//　IDが空じゃないか
$emp_no = $_POST['emp_no'];
if (isset($emp_no)) {
    $_SESSION['emp_no_err'] = "従業員番号が空です。";
    access();
}
//　IDがint型か
if (!is_int($emp_no)) {
    $_SESSION['emp_no_err'] = "従業員番号に数字以外が入っています";
    access();
}


//　パスワードは空じゃないか
$pass = $_POST['password'];
if (isset($pass)) {
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
    $password = $user['password'];
    if (password_verify($pass, $user['password'])) {
        // セッションの保存（社員番号）
        $_SESSION['emp_no'] = $emp_no;
        $_SESSION['dept_no'] = $dept_no;

        //dept_no(部署)が１なら管理人の画面に遷移
        $dept_no = $user['DEPT_NO'];
        if ($dept_no === "1") {
            // $page = "manager";
            nextpage("manager");
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
        access();
    }
    exit;
} catch (PDOException $poe) {
    access();
    exit("DBエラー" . $poe->getMessage());//開発時だけメッセージ表示
}
