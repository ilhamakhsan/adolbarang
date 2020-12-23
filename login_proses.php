<?php
include_once("config.php")
?>

<?php
$username   = $_POST['email'];
$pass       = md5($_POST['Password']);



$user = mysqli_query($conn,"select * from core_users where user_email='$username' and user_password='$pass'");
$chek = mysqli_num_rows($user);
if($chek>0)
{ ?>
    <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Alert Popup Box</title>
    <link rel="stylesheet" href="assets/css/popup.css">
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.css">
    <script src="assets/js/jquery.js"></script>
    <script>
      $(document).ready(function(){
        $('.ready').ready(function(){
          $('.popup_box').css("display", "block");
        });
        $('.btn1').click(function(){
          $('.popup_box').css("display", "none");
        });
      
      });

    </script>

  </head>
  <body class="body">
    <a href="#" class="click"></a>
    <div class="popup_box">
      <i class="fas fa-exclamation"></i>
      <h1>Login Berhasil</h1>
      <div class="btns">
        <a href="index.php" class="btn2" id="popup_box">OK</a>
      </div>
    </div>
  </body>
</html>

<?php
    session_start();
        $_SESSION['username'] = $username;
   
}else
{ ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Alert Popup Box</title>
    <link rel="stylesheet" href="assets/css/popup.css">
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.css">
    <script src="assets/js/jquery.js"></script>
    <script>
      $(document).ready(function(){
        $('.ready').ready(function(){
          $('.popup_box').css("display", "block");
        });
        $('.btn1').click(function(){
          $('.popup_box').css("display", "none");
        });
      
      });

    </script>

  </head>
  <body class="body">
    <a href="#" class="click"></a>
    <div class="popup_box">
      <i class="fas fa-exclamation"></i>
      <h1>Username / Password salah !</h1>
      <div class="btns">
        <a href="login.php" class="btn2" id="popup_box">OK</a>
      </div>
    </div>
  </body>
</html>
 
<?php
}
?>