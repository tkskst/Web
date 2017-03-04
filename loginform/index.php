<?php
session_start();
$_SESSION["my_no"]=0;
$_SESSION["my_name"]="";
$_SESSION["login_TF"]=0;
//ログインフォーム version2.0版
//php5.5及びphp7.0に対応しました

//変数初期化
//DBから読み出したのを格納する変数
$read_no="";
$read_name="";
$read_password="";

//入力してPOSTしたものを格納する変数
$input_name="";//ユーザーネーム
$input_pass="";//パスワード

$errorMessage = "";

//POST処理
if (isset($_POST["login"])) {
  // １．ユーザIDの入力チェック
  if (empty($_POST["input_name"])) {
    $errorMessage = "ユーザIDが未入力です。";} 
  if (empty($_POST["input_pass"])) {
    $errorMessage = "パスワードが未入力です。";} 
    
  if (!empty($_POST["input_name"])&&!empty($_POST["input_pass"])) {
      //ここで変数に代入を行う
    $input_name = htmlspecialchars($_POST["input_name"], ENT_QUOTES);	
    $input_pass = htmlspecialchars($_POST["input_pass"], ENT_QUOTES);	
    
    // mysqliクラスのオブジェクトを作成
    $mysqli = new mysqli('localhost', 'root', 'password', 'db_user');
    if ($mysqli->connect_error) {
          echo $mysqli->connect_error;
           exit();
           }else{
           $mysqli->set_charset("utf8");
           }
     
    // SQL文、テーブルより入力したユーザー名を検索
     $sql = "SELECT * FROM db_user WHERE name='$input_name'";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
         while ($row = $result->fetch_assoc()) {
         $read_no= $row["no"];
         $read_name=$row["name"];
         $read_password=$row["password"];
         }
        // 結果セットを閉じる
         $result->close();
      }
      // DB接続を閉じる
      $mysqli->close();
      if($password==$input_pass){
          
       $_SESSION["my_no"]=$read_no;
       $_SESSION["my_name"]=$read_name;
       $_SESSION["login_TF"]=1;
          
        header("Location: ./main.html");
      }else{
        $errorMessage="パスワードまたはユーザー名が間違っています";
      }
      }
}

?>
<!DOCTYPE html>
<html la="ja">
    <head>
        <meta charset="utf-8">
        <title>MySQLサンプル</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <h1>MySQLサンプル</h1>
        <form id="form" name="form" action="" method="POST">
            <div><?php echo $errorMessage?></div>
            <label for="userid">ユーザーネーム</label><input type="text" id="input_name" name="input_name" value="" /><br />
            <label for="userid">パスワード</label><input type="password" id="input_pass" name="input_pass" value="" /><br />
            <input type="submit" id="login" name="login" value="Go" /><br />
        </form>
    </body> 
</html>