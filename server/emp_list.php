<?php
//社員一覧画面（サーバー側）
//マサキカイリ


require_once __DIR__ . "/../helpers/function.php";
require_once __DIR__ . "/../helpers/def.php";
require_once __DIR__ . "/../helpers/utils.php";


//セッションスタート
session_start();

//URL直打ちの対策と権限があるか
access();

function get_info()
{
    try{
        // DB登録
        $pdo = getPDO();

        // sqlでselect文(社員一覧)
        $sql = "SELECT E.*, D.dname AS dname, M.ename AS mname FROM employee E
                JOIN department D ON E.dept_no = D.dept_no 
                LEFT JOIN employee M ON E.dept_no = M.dept_no AND M.job_no = 1";

        $stmt = $pdo->prepare($sql);

        //実行し結果を格納
        $stmt->execute();

        $users = [];

        //社員情報を一行ずつusers配列に格納
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }

        //  PDOオブジェクトを破棄
        $stmt = null;
        $db = null;

        return $users; //社員情報一覧を返す
        //TODO:絞り込み機能検討
    } catch(PDOException $poe){
        $_SESSION['error_message_list'] = $poe->getMessage();
        // ページを管理者用メニュー画面に戻す
        header("Location:" . TEAM_SYSTEM . "/client/page/kanrisha.php");
        exit;
    }
}

?>