<?php
mb_internal_encoding("utf8");

//セッションスタート
session_start();

if (empty($_POST['from_mypage'])){
    header("Location:login_error.php");}


?>


<!DOCTYPE HYML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ編集画面</title>
    <link rel="stylesheet" type="text/css" href="mypage_hensyu.css">
    
    </head>
    

    <body>
    <header>
    <img src="4eachblog_logo.jpg">
        <div class="login"><a href="log_out.php">ログアウト</a></div>
    </header>
        
        
        <div class="mypage_contents">
            
            <h2>会員情報</h2>
            
            <div class="mypage_detail">
            <p>こんにちは！ <?php echo $_SESSION['name'] ?>さん
            </p>
                
              <div class="flex_contain">
                <div>
       <img src="<?php echo $_SESSION['picture']?>" class="profile_img" />
                </div>
                    
                <div>
                <form action="mypage_update.php" method="post">
                    <p>氏名 : <input type="text" value="<?php echo $_SESSION['name']?>" name="name"></p>
            
                    
                    
                    <p>メール : <input type="text" value="<?php echo $_SESSION['mail']?>" name="mail"></p>
             
                    
                    
                    <p>パスワード : <input type="text" value="<?php echo $_SESSION['password']?>" name="password"></p>
           
                    
                </div>
                
                
            </div>
                    <p><textarea rows="5" cols="70" name="comments"><?php echo $_SESSION['comments']?></textarea>
           
                
                    <input type="submit" value="この内容に変更する" class="button1">
                
                
                </form>
                    
        
        <br>
        
            </div>
        </div>
    </body>
    
</html>