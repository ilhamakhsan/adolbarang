<?php 
session_start();
$id_produk=$_GET["id"];
unset($_SESSION ["chart"][$id_produk]);


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Alert Popup Box</title>
    <link rel="stylesheet" href="../assets/css/popup.css">
    <link rel="stylesheet" href="../assets/fontawesome-free/css/all.css">
    <script src="../assets/js/jquery.js"></script>
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
  <body>
    <a href="#" class="click"></a>
    <div class="popup_box">
      <i class="fas fa-exclamation"></i>
      <h1>produk telah terhapus</h1>
      <div class="btns">
        <a href="../keranjang.php" class="btn2" id="popup_box">OK</a>
      </div>
    </div>
  </body>
</html>
