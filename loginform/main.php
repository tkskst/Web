<?php
session_start();
if(!isset($_SESSION["login_TF"])||$_SESSION["login_TF"]==0){
    header("Location: ./nologin.php");
}
$my_no=$_SESSION["my_no"];
$my_name=$_SESSION["my_name"];

?>
<!DOCTYPE html>
<html la="ja">
    <head>
        <meta charset="utf-8">
        <link href="css/main.css" rel="stylesheet" />
        <title>トップページ</title>
    </head>
    <body>
        <header>
            <div class="header-wrapper">
                <h1 class="logo-title"><a href="#">サンプルサイト</a></h1>
            </div>
        </header>
        <h2>ログインに成功しました<h2>
            <p>あなたは<?php echo $my_name?>さんですね</p>
    </body>
</html>