<?php
session_start();
if(isset($_SESSION['id'])){
    header("Location:mypage.php");
    
}


?>

<!DOCTYPE HYML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン画面</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    
    </head>

    <body>
    <header>
    <img src="4eachblog_logo.jpg">
        <div class="login"><a href="register.php">新規登録画面</a></div>
    </header>
        
        <form action="mypage.php" method="post">
        <div class="form_contents">
            
            <div class="mail">
            メールアドレス<br>
            <input type="text" name="mail" size=35 value="<?php echo $_COOKIE['mail']?>" />
            </div>
            <div class="password">
            パスワード<br>
            <input type="password" name="password" size=35 value="<?php echo $_COOKIE['password']?>" />
            </div>
            <div>
                
                <label><input type="checkbox" class="formbox" size="40" name="login_keep" value="login_keep" 
                              <?php if(isset($_COOKIE['login_keep'])){echo "checked='checked'";}?>> ログイン状態を保持する</label>
            </div>
            
            <div class="loginbutton">
            <input type="submit" value="ログイン" class="button1"/>
        </div>
        
        
        </div>
            
        </form>
        
    </body>
</html>