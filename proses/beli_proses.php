<?php
session_start();
include_once("../config.php");
//mendapat id produk
$id_produk = $_GET['id'];

//jika sudah ada produk itu, maka produk jumlahnya +1
if(isset($_SESSION['chart'][$id_produk]))
{
    $_SESSION['chart'][$id_produk]+=1;
}
//selain itu (belum ada di keranjang), maka produk dianggap dibeli 1
else
{
    $_SESSION['chart'][$id_produk]=1;
}


//menghitung berat
foreach($_SESSION['chart'] as $id_produk=>$jumlah): 
    //menampilkan produk berdasarkan id produk-->
    
    //$id_produkk='prd00e16d41d524dcd1d7544fcae0d49260';
    $ambil = $conn->query("SELECT * FROM `mk_products` WHERE `id` = '$id_produk';");
    $pecah = $ambil ->fetch_assoc();
    $weigth = $pecah["weigth"];
 endforeach ;

 if(isset($_SESSION['berat'][$weigth]))
 {
    $_SESSION['berat'][$weigth]+=1;
 }
//selain itu (belum ada di keranjang), maka produk dianggap dibeli 1
    else
      {
       $_SESSION['berat'][$weigth]=1;
      }

            


//larikan ke keranjang
//echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
//echo "<script>location ='../keranjang.php';</script>";
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
    <a href="#" class="click">Delete Account</a>
    <div class="popup_box">
      <i class="fas fa-exclamation"></i>
      <h1>Produk telah dimasukan ke keranjang</h1>
      <div class="btns">
        <a href="../keranjang.php" class="btn2" id="popup_box">OK</a>
      </div>
    </div>
  </body>
</html>
