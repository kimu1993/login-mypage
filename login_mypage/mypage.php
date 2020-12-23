<?php
mb_internal_encoding("utf8");

session_start();

try{
    //try catch文。DBに接続できなければエラー文を表示
$pdo = new PDO("mysql:dbname=lesson01;host=localhost","root","root");    
}catch(PDOException $e){
die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスでができません。<br>しばらくしてから再度ログインをしてください。</p>
<a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>");    
    
}

//prepared statement(プリペアードステートメント)でSQL文の型を作る(DBとPOSTデータを照合させる。select文とwhere句を使用。)
$stmt = $pdo->prepare("SELECT * FROM login_mypage WHERE mail = ? && password =?");

//bindValueメソッドでパラメータをセット
$stmt->bindvalue(1,$_POST['mail']);
$stmt->bindvalue(2,$_POST['password']);

//executeでクエリを実行

$stmt->execute();

//データベースを切断
$pdo = NULL;



//fetch while文でデータを取得し、sessionに代入

while($row = $stmt->fetch()){
  $_SESSION['id']=$row['id'];
  $_SESSION['name']=$row['name'];
  $_SESSION['mail']=$row['mail'];
  $_SESSION['password']=$row['password'];
  $_SESSION['picture']=$row['picture'];
  $_SESSION['comments']=$row['comments'];
    
}

//データ取得ができずに(emptyを使用して判定)sessionがなければ、リダイレクト（エラー画面へ）
if(empty($_SESSION['id'])){
header('Location:http://localhost/login_mypage/login_error.php'); 
    
}

if(isset($_POST['login_keep'])){
    $_SESSION['login_keep'] = $_POST['login_keep'];
    
}

if(isset($_SESSION['id']) && isset($_SESSION['login_keep'])){
setcookie(mail,$_POST['mail'],time()+60*60*24*7);
setcookie(password,$_POST['password'],time()+60*60*24*7);
setcookie(login_keep,$_POST['login_keep'],time()+60*60*24*7);
    
}
if(empty($_SESSION['login_keep'])){
setcookie(mail,time()-1);
setcookie(password,time()-1);
setcookie(login_keep,time()-1);
    
}
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
    
    <meta charset="utf-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="mypage.css">
    </head>
    
    <body>
        
    <header>
    <img src="4eachblog_logo.jpg">
    </header>
        
        <div class="mypage_contents">
            
      <a href="log_out.php" class="login">ログアウト</a>
            
            <h2>会員情報</h2>
            
            <div class="mypage_detail">
            <p>こんにちは！ <?php echo $_SESSION['name'] ?>さん
            </p>
                
              <div class="flex_contain">
                <div>
       <img src="<?php echo $_SESSION['picture']?>" class="profile_img" />
                </div>
                    
                <div>
                  <p>氏名 : <?php echo $_SESSION['name']?></p>
                  <p>メール : <?php echo $_SESSION['mail']?></p>
                  <p>パスワード : <?php echo $_SESSION['password']?></p>
                </div>
                
                
            </div>
                
                  <p><?php echo $_SESSION['comments']?></p>
        
        <br>
        
                <form action="mypage_hensyu.php" method="post">
                    <input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage">
                <input type="submit" value="編集する" class="hensyu">
                
                </form>
                
            </div>
        </div>
    
    </body>




</html>