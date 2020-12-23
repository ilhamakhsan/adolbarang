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
    
    <title>Adolbarang.id</title>
  </head>
  <body>
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
            <form class="form-inline my-2 my-lg-0 mr-auto" method="post">
                <input type="text" class="form-control  mr-sm-2" name="inputan_pencarian" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="cari" value="cari">Search</button>
            </form>
            <div class="icon mt-2 mb-2">
                    <h5>
                        <a href="keranjang.php" class="fas fa-cart-plus ml-3 mr-5"></a>
                    </h5>
                </div>
                <a href="login.php" class="btn btn-success mr-2"> Login </a>
                <a href="proses/logout_proses.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
      </nav>
      <!-- end Header-->

      <!-- banner slider -->
	<div id="homepage-slider" class="st-slider">
		<input type="radio" class="cs_anchor radio" name="slider" id="play1" checked="" />
		<input type="radio" class="cs_anchor radio" name="slider" id="slide1" />
		<input type="radio" class="cs_anchor radio" name="slider" id="slide2" />
		<input type="radio" class="cs_anchor radio" name="slider" id="slide3" />
		<div class="images">
			<div class="images-inner">
				<div class="image-slide">
					<div class="banner-w3ls-1" >
                  
					</div>
				</div>
				<div class="image-slide">
					<div class="banner-w3ls-2">

					</div>
				</div>
				<div class="image-slide">
					<div class="banner-w3ls-3">

					</div>
				</div>
			</div>
		</div>
		<div class="labels">
			<div class="fake-radio">
				<label for="slide1" class="radio-btn"></label>
				<label for="slide2" class="radio-btn"></label>
				<label for="slide3" class="radio-btn"></label>
			</div>
		</div>
	</div>
	<!-- //banner slider -->

	<!-- banner bottom grids -->
	<section class="banner-bottom-w3layouts pb-5" id="services">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 about-in text-center">
					<div class="serv-cont-wthree">
						<div class="">
							<img src="assets/img/fitur/feature-1.png" class="icon-wthrees">
						</div>
						<h5 class="card-title mb-3 mt-4">Aman</h5>
						<p class="card-text">Transaksi di Adolbarang dijamin aman 100%.  </p>
					</div>
				</div>
				<div class="col-lg-4 about-in text-center my-lg-0 my-4">
					<div class="serv-cont-wthree">
						<div class="">
							<img src="assets/img/fitur/feature-2.png" class="icon-wthrees">
						</div>
						<h5 class="card-title mb-3 mt-4">Berkualitas</h5>
						<p class="card-text">Ribuan barang bekas berkualitas asli (no KW) ada di sini.</p>
					</div>
				</div>
				<div class="col-lg-4 about-in text-center">
					<div class="serv-cont-wthree">
						<div class="">
							<img src="assets/img/fitur/feature-3.png" class="icon-wthrees">
						</div>
						<h5 class="card-title mb-3 mt-4">Penuh Cerita</h5>
						<p class="card-text">Selalu ada cerita khusus tersimpan dalam  setiap produk. </p>
					</div>
				</div>
			</div>
		</div>
	</section>
   <!-- //banner bottom grids -->
   

   <!--Product-->
   <section class="w3ls-bnrbtm py-5" id="about">
		<div class="container ">
      <div class="row shadow ">
      <?php
       $inputan_pencarian = @$_POST['inputan_pencarian'];
       $cari = @$_POST['cari'];
         if($cari){
               if($inputan_pencarian != "") {
                  $sql = $conn->query("SELECT  mk_products.name, mk_products.stock, mk_products.unit_price, mk_products.id,mk_products.description, core_images.img_path 
                                       FROM mk_products INNER JOIN core_images ON mk_products.id = core_images.img_parent_id WHERE name LIKE '%$inputan_pencarian%'") or die (mysqli_error());
                  } else {
                   $sql = $conn->query("SELECT  mk_products.name, mk_products.stock, mk_products.unit_price, mk_products.id, mk_products.description, core_images.img_path
                                       FROM mk_products INNER JOIN core_images ON mk_products.id = core_images.img_parent_id") or die (mysqli_error());
                         }
                  } else {
                    $sql = $conn->query("SELECT mk_products.name, mk_products.stock, mk_products.id,mk_products.description, mk_products.unit_price, core_images.img_path
                                       FROM mk_products INNER JOIN core_images ON mk_products.id = core_images.img_parent_id") or die (mysqli_error());
                          }                       

         while($tampilproduk = $sql->fetch_assoc()){ ?>
            <?php $stock_barang =$tampilproduk['stock'];
             if($stock_barang>0){
              ?>
                <div class="col-lg-4 col-md-6 mb-4 mt-4 hover">
                  <div class="card h-100">
                     <div class="">
                         <img class="card-img-top" style="width:350px;height:200px;" src="admin/uploads/<?php echo $tampilproduk['img_path']; ?>" alt="">
                      </div>
                                    
                        <div class="card-body">
                           <h4 class="card-title">
                              <a href="#"><?php echo $tampilproduk['name']; ?></a>
                           </h4>
                           <h5>$<?php echo  number_format($tampilproduk['unit_price']); ?> -,</h5>
                           <p class="card-text"><?php echo $tampilproduk['description']; ?></p>
                              <a href="proses/beli_proses.php?id=<?php echo $tampilproduk['id'];?>" class="btn btn-primary" class="btn btn-danger" id="popup_box"> Beli</a>
                              <a href="proses/detail_proses.php?id=<?php echo $tampilproduk['id'];?>" class="btn btn-success" > Detail</a>
                              
                        </div>
                         <div class="card-footer">
                           <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                     </div>
                  </div>
         <?php  } } ?>

<!-- Modal data-toggle="modal" data-target="#produk1"-->

<!-- -->
    </div>
    </div>
    </section>

    <section class="w3ls-bnrbtm py-5" id="about">
		<div class="container ">
      <div class="row shadow ">
      <div class="mr-auto ml-auto mb-0">
        <nav aria-label="..." class="mb-4 mt-4">
                <ul class="pagination">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
      </div>
     </div>
     </div>
     </section>
     <!-- End Product-->
    <!--About-->
   <div class="container">
      <div class="border-bottom ml-5 mr-5"></div>
     <section id="section-6" data-anchor="seo" class="section">
        <div id="section-6-wrapper bg-wa" >
           <div class="container">
              <div class="row">
                 <div class="col-sm-12">
                    <h4 class="title">Adolbarang.id</h4>
                 </div>
                 <div class="col-sm-6">
                    <div class="wrapper ">
                       <p class="about-ad">Apakah kamu orang yang hobi berbelanja? Kamu begitu menyukai proses berbelanja sehingga banyak barang yang menumpuk di rumahmu? Kini kamu tidak perlu lagi khawatir dengan hobimu yang satu ini—khawatir akan kehabisan uang ataupun banyaknya tumpukan barang di rumah.</p>
                       <p class="about-ad">Jika kamu memiliki barang-barang second berkualitas yang tidak terpakai, kenapa tidak dijual di AdolBarang.Id saja? Bersama AdolBarang.Id kamu bisa membuat online shop second yang setiap harinya dapat dilihat oleh ribuan pembeli. Tumpukan barang belanjaanmu pun dapat disulap kembali menjadi uang. Banyak  sekali orang yang ingin beli barang second seperti milik kamu lho! Sayang bangetkan kalau barang-barang kamu yang tidak terpakai menjadi rusak seiring berjalannya waktu?</p>
                    </div>
                 </div>
                 <div class="col-sm-6">
                    <div class="wrapper">
                       <p class="about-ad">Bukan hanya itu, bersama AdolBarang.Id kamu juga bisa lho membeli barang-barang branded berkualitas yang dipatok dengan harga murah, karena dijual bekas. Second murah bukan berarti jelek ya, tapi karena memang barang tersebut sudah tidak lagi terpakai oleh pemilik lamanya. Kalau ada yang lebih murah, original, dan berkualitas, kenapa pilih yang lain? Dijamin kamu tidak akan menyesal jika membelinya. </p>
                       <p class="about-ad">Bukan hanya kamu yang senang ketika menjual dan membeli barang bekas, tapi bumi juga senang lho. Bersama AdolBarang.Id kamu turut serta melakukan kampanye 3R (Reduce, Reuse, Recycle) demi mengurangi kerusakan bumi. Asik sekali, bukan? Tidak perlu ragu, ayo bergabung bersama AdolBarang.Id</p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <div class="border-bottom ml-5 mr-5"></div>
     <!--end About-->
     <!--footer-->
     <footer id="footer" class="footer">
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
