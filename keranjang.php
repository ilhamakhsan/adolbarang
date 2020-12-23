<?php
include_once("config.php");
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- fontawesome-free-->
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
    <!-- CSS nya-->
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/shop-homepage.css">

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
        $('.btn2').click(function(){
            location.reload(); ;
        });
      });

    </script>
    <title>Adolbarang.id</title>
  </head>
     <!--Header-->
    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Adolbarang</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                
            </ul>
            <form class="form-inline my-2 my-lg-0 mr-auto">
                <input class="form-control  mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
                <div class="icon mt-2 mb-2">
                    <h5>
                        <a href="keranjang.php" class="fas fa-cart-plus ml-3 mr-5"></a>
                    </h5>
                </div>
                <a href="login.php" class="btn btn-success mr-2"> Login </a>
                <a href="register.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
      </nav>
      <!-- end Header-->

      <?php if(empty($_SESSION['chart']) OR !isset($_SESSION['chart']))
        { ?>
        <a href="#" class="click"></a>
        <div class="popup_box">
        <i class="fas fa-exclamation"></i>
        <h1>Keranjang kosong silahkan belanja</h1>
        <div class="btns">
            <a href="index.php" class="btn2" id="popup_box">OK</a>
        </div>
        </div>
        </body>
        <?php } ?>

      <section class="konten">
        <div class ="container">
        <h3>Keranjang Belanja</h3>
        <div style="overflow-x:auto;">
            <table class="table table-bordered">
             <thead>
                <tr>
                <th>NO</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Berat</th>
                <th>Jumlah</th>
                <th>Sub Harga</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
            <?php $nomor=1; 
                  $i=0;
            ?>
            <?php if(!empty($_SESSION['chart']) OR isset($_SESSION['chart']))
            { ?>
            <?php foreach($_SESSION['chart'] as $id_produk=>$jumlah): ?>
            <!--menampilkan produk berdasarkan id produk-->
            <?php
            //$id_produkk='prd00e16d41d524dcd1d7544fcae0d49260';
            $ambil = $conn->query("SELECT * FROM `mk_products` WHERE `id` = '$id_produk';");
            $pecah = $ambil ->fetch_assoc();
            $subharga = $pecah["unit_price"]*$jumlah;
            $nama_produk =$pecah['name'];
            $stock = $pecah["stock"];
            $weigth = $pecah["weigth"];
            if($jumlah>$stock){
               $_SESSION['chart'][$id_produk]=$stock;
               ?> 
               <a href="#" class="click"></a>
                <div class="popup_box">
                <i class="fas fa-exclamation"></i>
                <h1>stok <?php echo $nama_produk ?> tersisa <?php echo $stock ?></h1>
                <div class="btns">
                    <a href="#" class="btn2" id="popup_box">OK</a>
                    <button id="ok"></button>
                </div>
                </div>
               
               <?php
                 }
                ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $nama_produk;?></td>
                <td>Rp. <?php echo number_format ($pecah["unit_price"]);?></td>
                <td><?php echo $weigth*$jumlah/1000?> KG</td>
                <td><?php echo $jumlah; ?></td>
                <td>Rp. <?php echo number_format ($subharga); ?></td>
                <td>
                    <a href="proses/hapus_keranjang_proses.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
                </td>
            </tr>
            <?php $nomor++;

            
            ?>
        
            <?php endforeach ?>
                      
        <?php } ?>
        </tbody>
        </table>
        <!---->
        </div>
            <a href="index.php" class="btn btn-success">lanjutkan belanja</a>
            <a href="checkout.php" class="btn btn-primary">Checkout</a>
        </div>

    </section>

      <!--footer-->
     <footer id="footer" >
        <div class="border-bottom ml-5 mr-5"></div>
        <div class="container">
           <div class="row">
              <div class="col-sm-12">
                 <div id="socmed-heading">Follow Us</div>
                 <div id="socmed-wrapper">
                    <div class="socmed-second-wrapper">
                       <div class="socmed-item"><a href="#" target="_blank" rel="noopener"><span class="fab fa-instagram"></span></a></div>
                       <div class="socmed-item"><a href="#" target="_blank" rel="noopener"><span class="fab fa-facebook"></span></a></div>
                       <div class="socmed-item"><a href="#" target="_blank" rel="noopener"><span class="fab fa-google"></span></a></div>
                       <div class="socmed-item"><a href="#" target="_blank" rel="noopener"><span class="fab fa-youtube"></span></a></div>
                       <div class="socmed-item"><a href="#" target="_blank" rel="noopener"><span class="fab fa-twitter"></span></a></div>
                       <div class="socmed-item"><a href="#" target="_blank" rel="noopener"><span class="fa fa-envelope"></span></a></div>
                    </div>
                 </div>
              </div>
           </div>
           <div class="row">
              <div class="col-sm-12">
                 <div style="margin-bottom: 8px" class="footer-text">
                    Made with  
                    <div class="fa fa-heart"></div>
                    from Semarang
                 </div>
                 <div class="footer-text">AdolBarang.Id</div>
              </div>
           </div>
        </div>
     </footer>
     <!--end footer-->
     </div>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
  </html>

 
  