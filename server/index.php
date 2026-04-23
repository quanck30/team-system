<?php
//ログイン画面のサーバー側
//マサキカイリ
// Home.phpからもらってきたログイン情報をここで処理してログイン情報を渡す

//POSTじゃないならHomeに返す
function access(){
    if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
    exit;
    }
}

require_once __DIR__ . "../helpers/def.php";
require_once __DIR__ . "../helpers/utils.php";

function modoru($dept_no,$page){//管理者なのかチェック
    if ($dept_no === "1") {
        header("Location: " . TEAM_SYSTEM . "/client/page/" . $page . ".php");
    } else {
        header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
    }
}
//セッションスタート
session_start();
//セッションにデータを保存
$_SESSION['message'];

//　IDが空じゃないか
$emp_no = $_POST['emp_no'];
if(isset($emp_no)){
    $_SESSION['message'] = "従業員番号が空です。";
    header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
    exit;
}
//　IDがint型か
if(!is_int($emp_no)){
    $_SESSION['message'] = "従業員番号に数字以外が入っています";
    header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
    exit;
}


//　パスワードは空じゃないか
$pass = $_POST['password'];
if(isset($pass)){
    $_SESSION['message'] = "パスワードが空です。";
    header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
    exit;
}

// パスワードをハッシュ化
// $hashpass = password_verify($pass , PASSWORD_DEFAULT);


try{
    // データべースと接続
    $dbf -> getPDO();

    //社員IDで情報をとってくる
    $sql = "SELECT * FROM EMPLOYEE WHERE EMP_NO = :emp_no";

    $stmt = $db->prepare($sql);
    //bindValueで型が正しいか確認
    $stmt->bindValue(':emp_no' , $emp_no , PDO::PARAM_INT);

    //resultに結果を格納
     $stmt->execute();
     $user = $stmt -> fetch();

    // ハッシュ化したパスワードを照合
    $password = $user['password'];
    if(password_verify( $pass , $user['password'])){
        //dept_no(部署)が１なら管理人の画面に遷移
        //headerの管理人側のページを変数に格納
        $page = "TODO";//TODO
        $dept_no = $user['DEPT_NO'];

        // セッションの保存（社員番号）
        $_SESSION['emp_no'] = $emp_no;
        $_SESSION['dept_no'] = $dept_no;
        modoru($dept_no,$page);
        
        exit;
        
    //パスワードが間違ってたらHomeに遷移
    } else {
        header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
        exit;
    }

} catch (PDOException $poe) {
    header("Location: " . TEAM_SYSTEM . "/client/page/Home.php");
    exit;
    // exit("DBエラー" . $poe->getMessage());//開発時だけメッセージ表示
}

?>
 