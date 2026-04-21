<?php
// Home.phpからもらってきたログイン情報をここで処理してログイン情報を返す
if($_SERVER["REQUEST_METHOD"] === "POST"){

}
require_once __DIR__ . "../helpers/def.php";
require_once __DIR__ . "../helpers/utils.php";

//セッションスタート
session_start();
//セッションにデータを保存
$_SESSION['message'];

//　IDが空じゃないか
$emp_no = $_POST['emp_no'];
if(isset($emp_no)){
    $_SESSION['message'] = "従業員番号が空です。";
    header('Location: ../client/page/Home.php');
    exit;
}
//　IDがint型か
if(is_int($emp_no)){
    $_SESSION['message'] = "従業員番号に数字以外が入っています";
    header('Location: ../client/page/Home.php');
    exit;
}

//　パスワードは空じゃないか
$pass = $_POST['password'];
if(isset($pass)){
    $_SESSION['message'] = "パスワードが空です。";
    header('Location: ../client/page/Home.php');
    exit;
}

// パスワードをハッシュ化
$hashpass = password_hash($pass , PASSWORD_DEFAULT);


try{
    // データべースと接続
    $dbf -> getPDO();

    //社員IDで情報をとってくる
    $sql = "SELECT * FROM EMPLOYEE WHERE EMP_NO = :emp_no";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':emp_no' , $emp_no , PDO::PARAM_STR);

    //TODO: ハッシュ化したパスワードを送る
    $password = $stmt['password'];
    if(){

    }
    //TODO:番号で社員を管理 DBとデータを照合

    //TODO:照合して合致したデータを引っ張てくる

    //TODO:ユーザーネームとパスワードをDBのデータと照合

    /*TODO:システム管理部にチェックがついてたら管理者用メニューに遷移
    チェックがついていなかったら社員メニューに遷移
    */
    if($_POST["/* TODO: */"]){
        $kengen = true; //管理用の権限
    }

    //TODO:セッションの保存
} catch (PDOException $poe) {
    exit("DBエラー" . $poe->getMessage());//開発時だけメッセージ表示
}

?>
 