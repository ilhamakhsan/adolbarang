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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
      <h3 class="center"> FORM REGISTRASI</h3>
      <form action="register_proses.php" method="post" class="center">
        <div   style="text-align: left; padding-bottom: 0" class="add-address form">
           <div id="wrapper-ajah" style="padding:0;margin-top:10px">
              <label for="Nama Pertama">Nama Pertama</label><input id="address-firstname" name="billing_first_name" type="text" required placeholder="" class="form-control">
              <label for="Nama Akhir">Nama Akhir</label><input id="address-lastname" name="billing_last_name" type="text" required placeholder="" class="form-control">
              <label for="Email">Email</label><input id="address-email" name="billing_email" type="text" required placeholder="" class="form-control">
              <label for="password">Password</label><input id="password" name="password" type="password" required placeholder="" class="form-control">
              <input type="checkbox" class="form-checkbox"> Show password <br>
              <label for="Phone">Phone</label><input id="address-phone" name="billing_phone" type="tel" required placeholder="" class="form-control">
              <label for="Perusahaan">Perusahaan</label><input id="address-company" name="billing_company" type="text" required placeholder="" class="form-control">
              <label for="Alamat">Alamat</label><input id="address" name="billing_address_1" type="text" required placeholder="" class="form-control">
              <label for="Negara">Negara</label><input id="address-country" name="billing_country" type="text" required placeholder="" class="form-control">
              <label for="Provinsi">Provinsi</label><input id="address-province" name="billing_state" type="text" required placeholder="" class="form-control">
              <label for="Kota">Kota</label><input id="address-kota" name="billing_city" type="text" required placeholder="" class="form-control">
              <label for="Kode Pos">Kode Pos</label><input id="postal_code" name="billing_postal_code" type="" required placeholder="" class="form-control"> <br>
              <button id="submit-checkout-button" type="submit" name="submit" class="btn btn-success center" >Daftar</button>
        </div>
        </form>

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
    <script type="text/javascript">
	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('#password').attr('type','text');
			}else{
				$('#password').attr('type','password');
			}
		});
	});
   </script>
  </html>