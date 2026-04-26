<?php
//社員一覧画面（サーバー側）
//マサキカイリ

//
require_once __DIR__ . "/../server/index.php";
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";

//URL直打ちの対策
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    access();
}

// $page = "manager";// 管理者用メニュー画面に戻すパス
// kengen($_SESSION['dept_no'] ?? 0 , $page); //0の場合Home.phpに遷移

//管理人かどうか
kengen($_SESSION['dept_no']);

function get_info()
{
    try{
        // DB登録
        $db = getPDO();

        // sqlでselect文(社員一覧)
        $sql = "SELECT * FROM EMPLOYEE";

        $stmt = $db->prepare($sql);

        //実行し結果を格納
        $stmt->execute();

        $result = [];

        //社員情報を一行ずつresult配列に格納
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        //  PDOオブジェクトを破棄
        $stmt = null;
        $db = null;

        return $result; //社員情報一覧を返す
    } catch(PDOException $poe){
        $_SESSION['error_message_list'] = $poe;
        // ページを管理者用メニュー画面に戻す
        header("Location:" . TEAM_SYSTEM . "/client/page/manager.php");
        exit;
    }
}

?>