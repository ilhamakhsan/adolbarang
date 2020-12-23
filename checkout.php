<?php
//include koneksi database
include_once("config.php");
//memerikasa apakah user sudah login atau belum
//jika belum login maka akan ada alert silahkan login dan akan di kembalikan di halaman index
session_start();
//echo "<pre>";
//print_r($_SESSION['berat']);
//echo "</pre>";


if (!isset($_SESSION['username'])){
  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Alert Popup Box</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

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
  <body>
    <a href="#" class="click">Delete Account</a>
    <div class="popup_box">
      <i class="fas fa-exclamation"></i>
      <h1>silahkan loging</h1>
      <div class="btns">
        <a href="keranjang.php" class="btn2" id="popup_box">OK</a>
      </div>
    </div>
  </body>
</html>
   <?php }
if(empty($_SESSION['chart']) OR !isset($_SESSION['chart']))
{
    echo "<script>alert('silahkan belanja'); </script>";
    echo "<script>location='index.php'; </script>";
}



?>
<?php foreach($_SESSION['berat'] as $berat=>$jumlah): 
//$jumber= $berat *$jumlah;   
?>


<?php endforeach ?>

<?php if(isset($_SESSION['username'])) {
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

      <form action="checkout_proses.php" method="post" class="center">
                                 <div   style="text-align: left; padding-bottom: 0" class="add-address form">
                                    <div id="wrapper-ajah" style="padding:0;margin-top:10px">
                                       <div class="form-group"><label for="Nama Pertama">Nama Pertama</label><input id="address-firstname" name="shipping_first_name" type="text" required placeholder="" class="form-control"></div>
                                       <div class="form-group"><label for="Nama Akhir">Nama Akhir</label><input id="address-lastname" name="shipping_last_name" type="text" required placeholder="" class="form-control"></div>
                                       <div class="form-group"><label for="Email">Email</label><input id="address-email" name="shipping_email" type="tel" required placeholder="" class="form-control"></div>
                                       <div class="form-group"><label for="Phone">Phone</label><input id="address-phone" name="shipping_phone" type="text" required placeholder="" class="form-control"></div>
                                       <div class="form-group"><label for="Alamat">Alamat lengkap</label><input id="address" name="shipping_address_1" type="text" required placeholder="" class="form-control"></div>
                                        <div class="form-group"><label for="postal_code">kode pos</label><input id="postal_code" name="postal_code" type="" required placeholder="" class="form-control"></div>
                                        <div class="panel-body">
								<div>
									<?php
									//Get Data Kabupaten
									
									//Get Data Kabupaten
									//-----------------------------------------------------------------------------//

									//Get Data Provinsi
									$curl = curl_init();

									curl_setopt_array($curl, array(
										CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
										CURLOPT_RETURNTRANSFER => true,
										CURLOPT_ENCODING => "",
										CURLOPT_MAXREDIRS => 10,
										CURLOPT_TIMEOUT => 30,
										CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
										CURLOPT_CUSTOMREQUEST => "GET",
										CURLOPT_HTTPHEADER => array(
										"key:a5e53f0925c10f6ac34af4e67ed6b3e8"
										),
										));

										$response = curl_exec($curl);
										$err = curl_error($curl);

										echo "
										<div class= \"form-group\">
											<label for=\"provinsi\">Provinsi Tujuan </label>
											<select class=\"form-control\" name='provinsi' id='provinsi' required>";
												echo "<option >Pilih Provinsi Tujuan</option>";
												$data = json_decode($response, true);
												for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
                                       echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
                                      
												}
												echo "</select>
											</div>";
											//Get Data Provinsi
											?>

											<div class="form-group">
												<label for="kabupaten">Kota/Kabupaten Tujuan</label><br>
												<select class="form-control" id="kabupaten" name="kabupaten" required></select>
											</div>
											<div class="form-group">
												<label for="kurir">Kurir</label><br>
												<select class="form-control" id="kurir" name="kurir">
													<option value="jne">JNE</option>
													<option value="tiki">TIKI</option>
													<option value="pos">POS INDONESIA</option>
												</select>
											</div>
                                 <div class="form-group">
												<label for="kabupaten">layanan</label><br>
												<select class="form-control" id="layanan" name="layanan"></select>
											</div>
											<div class="form-group">
												<label for="berat">Berat (gram)</label><br>
												<input class="form-control" id="berat" type="text" name="berat" value="<?php echo 1000;//$jumber1*$jumber2?>" disabled />
											</div>
                                 <div class="form-group"><label for="memo">memo</label><input id="postal_code" name="memo" type=""  class="form-control"></div>
										</div>
								</div>
							</div>
						</div>
            <button id="submit-checkout-button" type="submit" name="submit" class="btn btn-danger" >Checkout</button>
						<div class="col-md-8">
							<div class="panel panel-success">
								<div class="panel-heading">
									<h3 class="panel-title">Ongkos Kirim</h3>
								</div>
								<div class="panel-body">
									<ol>
										<div id="ongkir"></div>
										
									</ol>
								</div>
						</div>
         <!-- <div style="text-align:right" class="form-group"><label for="save-address"><input type="checkbox" id="save-address" name="save-account" style="margin-right: 5px; margin-bottom: -2px">Simpan alamat</label></div>
                                       -->
          </div>
           
           </div>
           </form>


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
      
      
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
  </html>
  <script type="text/javascript">

$(document).ready(function(){
  $('#provinsi').change(function(){

    //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
    var prov = $('#provinsi').val();

        $.ajax({
            type : 'GET',
             url : 'http://localhost/adolbarang/ongkir_proses/cek_kabupaten.php',
            data :  'prov_id=' + prov,
        success: function (data) {

        //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
        $("#kabupaten").html(data);
      }
          });
  });

  $("#kabupaten").change(function(){
    //Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax
    var asal = $('#asal').val();
    var kab = $('#kabupaten').val();
    var kurir = $('#kurir').val();
    var berat = $('#berat').val();

        $.ajax({
            type : 'POST',
             url : 'http://localhost/adolbarang/ongkir_proses/cek_ongkir.php',
            data :  {'kab_id' : kab, 'kurir' : kurir, 'asal' : asal, 'berat' : berat},
        success: function (data) {

        //jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
        $("#ongkir").html(data);
      }
          });
  });
      $("#kurir").change(function(){
    //Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax
    var asal = $('#asal').val();
    var kab = $('#kabupaten').val();
    var kurir = $('#kurir').val();
    var berat = $('#berat').val();

        $.ajax({
            type : 'POST',
             url : 'http://localhost/adolbarang/ongkir_proses/cek_ongkir.php',
            data :  {'kab_id' : kab, 'kurir' : kurir, 'asal' : asal, 'berat' : berat},
        success: function (data) {

        //jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
        $("#ongkir").html(data);
      }
          });
  });

       $('#kurir').change(function(){

          //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
          var asal = $('#asal').val();
          var kab = $('#kabupaten').val();
          var kurir = $('#kurir').val();
          var berat = $('#berat').val();

        $.ajax({
            type : 'POST',
             url : 'http://localhost/adolbarang/ongkir_proses/cek_layanan.php',
            data :  {'kab_id' : kab, 'kurir' : kurir, 'asal' : asal, 'berat' : berat},
        success: function (data) {

        //jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
        $("#layanan").html(data);
       }
       });
    });

    $('#kabupaten').change(function(){

       //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
       var asal = $('#asal').val();
       var kab = $('#kabupaten').val();
       var kurir = $('#kurir').val();
       var berat = $('#berat').val();

       $.ajax({
          type : 'POST',
          url : 'http://localhost/adolbarang/ongkir_proses/cek_layanan.php',
          data :  {'kab_id' : kab, 'kurir' : kurir, 'asal' : asal, 'berat' : berat},
          success: function (data) {

          //jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
          $("#layanan").html(data);
       }
       });
       });
});
</script>
  
  
  
  
  <?php
}?>
