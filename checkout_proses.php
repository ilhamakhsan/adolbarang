<?php 
session_start();

?>
<?php
 //kodingan generate id 
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
 
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}
 
// id transaction hdr header
$code_hdr = generate_string($permitted_chars, 32);
$id_hdr = $code_hdr; 

?>
<?php
// koneksi ke database
include_once("config.php");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

<tbody>

<?php foreach($_SESSION['chart'] as $id_produk=>$jumlah): ?>
<!--menampilkan produk berdasarkan id produk-->
<?php
//$id_produkk='prd00e16d41d524dcd1d7544fcae0d49260';
$ambil = $conn->query("SELECT * FROM `mk_products` WHERE `id` = '$id_produk';");
$pecah = $ambil ->fetch_assoc();
$nama_produk = $pecah['name'];
$harga_produk = $pecah['unit_price'];
$stock_barang = $pecah['stock'];
$jml_barang = $jumlah;

$product_id=$id_produk;
$product_name=$nama_produk;
$original_price=$harga_produk;
$price=$harga_produk;
$qty=$jml_barang;
$item_subtotal = $harga_produk*$qty;

$code_det =generate_string($permitted_chars, 32);
$id_det = $code_det;

$code_cut =generate_string($permitted_chars, 32);
$id_cut = $code_cut;
?>

<?php
    $sql2= "INSERT INTO `mk_transactions_counts` (`id`, `product_id`, `cat_id`, `sub_cat_id`, `user_id`, `added_date`) VALUES ('$id_cut', '$product_id', '', '', '$user_id', current_timestamp())"; 
    if ($conn->query($sql2) === TRUE) {
        //echo "New record created successfully <br>";
    } else {
        //echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
?>

<?php
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

    $sql1 = "INSERT INTO `mk_transactions_detail` (`id`, `transactions_header_id`, `shop_id`, `product_id`, `product_attribute_id`, `product_name`, `product_attribute_name`, `product_attribute_price`, `product_color_id`, `product_color_code`, `original_price`, `price`, `discount_amount`, `qty`, `discount_value`, `discount_percent`, `added_date`, `added_user_id`, `updated_date`, `updated_user_id`, `updated_flag`, `currency_symbol`, `currency_short_form`,`jml_ttl`) VALUES ('$id_det', '$id_hdr', '', '$product_id', '', '$product_name', '', '0', '', '', '$original_price', '$price', '', '$qty', '', '', current_timestamp(), '', current_timestamp(), '0', '0', 'Rp.', 'IDR', '$item_subtotal')";
    if ($conn->query($sql1) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }


?>
<?php

$update_stock =$stock_barang-$qty;
//ini codingan untk mengurangi stock
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
      $sql3 = "UPDATE `mk_products` SET `stock`='$update_stock' WHERE `id`='$product_id'";
      if ($conn->query($sql3) === TRUE) {
          echo "New record created successfully <br>";
      } else {
          echo "Error: " . $sql3 . "<br>" . $conn->error;
      }
?>


<?php endforeach ?>



<?php
//input billing get dari database 
$pembeli_id=$_SESSION['username'];
$sql = $conn->query("SELECT `user_id`,`user_name`,`user_phone`, `billing_first_name`, `billing_last_name`, `billing_company`, `billing_address_1`, `billing_address_2`, `billing_country`, `billing_state`, `billing_city`, `billing_postal_code`, `billing_email`, `billing_phone`FROM `core_users` WHERE `user_email`='$pembeli_id' ");
while($tampiluser = $sql->fetch_assoc()){ 
        $user_id=$tampiluser['user_id'];
        $contact_name = $tampiluser['user_name'];
        $added_user_id = $tampiluser['user_id'];
        $billing_first_name = $tampiluser['billing_first_name'];
        $billing_last_name = $tampiluser['billing_last_name'];
        $billing_company = $tampiluser['billing_company'];
        $billing_address_1 = $tampiluser['billing_address_1'];
        $billing_address_2 = $tampiluser['billing_address_2'];
        $billing_country = $tampiluser['billing_country'];
        $billing_state = $tampiluser['billing_state'];
        $billing_city = $tampiluser['billing_city'];
        $billing_postal_code = $tampiluser['billing_postal_code'];
        $billing_email = $tampiluser['billing_email'];
        $billing_phone = $tampiluser['billing_phone'];

    }
?>

<?php
//inputan
//$user_id="c4ca4238a0b923820dcc509a6f75849b";
//$contact_name ="ilham";
//$contact_phone ="089505833033";
//$added_user_id ="c4ca4238a0b923820dcc509a6f75849b";
$payment_method ="COD";
$trans_status_id="1";
//$billing_first_name ="ilham";
//$billing_last_name="akhsani";
//$billing_company="perusahaan";
//$billing_address_1="semarang";
//$billing_address_2="bsb";
//$billing_country="indonesia";
//$billing_state="jawa tengah";
//$billing_city="semarang";
//$billing_postal_code="52252";
//$billing_email="ilham akhsan23@gmail.com";
//$billing_phone="089505833033";


        $shipping_first_name= @$_POST['shipping_first_name'];
        $shipping_last_name= @$_POST['shipping_last_name'];
        $shipping_company= @$_POST['shipping_company'];
        $shipping_address_1= @$_POST['shipping_address_1'];
        $shipping_address_2= @$_POST['shipping_address_2'];
        $shipping_country= "indonesia";
        $shipping_state= @$_POST['provinsi'];
       
        $shipping_city= @$_POST['kabupaten'];
        $shipping_postal_code= @$_POST['shipping_postal_code'];
        $shipping_email= @$_POST['shipping_email'];
        $shipping_phone= @$_POST['shipping_phone'];
        $shipping= @$_POST['kurir'];
        $shipping_layanan = @$_POST['layanan'];
        $memo= @$_POST['memo'];
?>
<?php
//jml_ttl
$sql = $conn->query("SELECT SUM(jml_ttl) FROM `mk_transactions_detail` WHERE `transactions_header_id`='$id_hdr'");

 while($tampil_jml = $sql->fetch_assoc()){ 
    $jml_ttl=$tampil_jml['SUM(jml_ttl)'];
}
//echo $jml_ttl;

?>


<?php
    $sql = "INSERT INTO `mk_transactions_header` (`id`, `user_id`, `sub_total_amount`, `discount_amount`, `coupon_discount_amount`, `tax_amount`, `tax_percent`, `shipping_amount`, `shipping_tax_percent`, `shipping_method_amount`, `shipping_method_name`, `balance_amount`, `total_item_amount`, `total_item_count`, `contact_name`, `contact_phone`, `payment_method`, `added_date`, `added_user_id`, `updated_date`, `updated_user_id`, `updated_flag`, `trans_status_id`, `currency_symbol`, `currency_short_form`, `trans_code`, `billing_first_name`, `billing_last_name`, `billing_company`, `billing_address_1`, `billing_address_2`, `billing_country`, `billing_state`, `billing_city`, `billing_postal_code`, `billing_email`, `billing_phone`, `shipping_first_name`, `shipping_last_name`, `shipping_company`, `shipping_address_1`, `shipping_address_2`, `shipping_country`, `shipping_state`, `shipping_city`, `shipping_postal_code`, `shipping_email`, `shipping_phone`, `memo`, `shipping`) VALUES ('$id_hdr', '$user_id', '$jml_ttl', '', '', '', '', '$shipping_layanan', '', '$shipping_layanan', '', '', '', '', '$contact_name', '$contact_phone', '$payment_method', current_timestamp(), '$added_user_id', '0000-00-00 00:00:00.000000', '', '', '$trans_status_id', 'IDR', 'IDR', '', '$billing_first_name', '$billing_last_name', '$billing_company', '$billing_address_1', '$billing_address_2', '$billing_country', '$billing_state', '$billing_city', '$billing_postal_code', '$billing_email', '$billing_phone', '$shipping_first_name', '$shipping_last_name', '$shipping_company', '$shipping_address_1', '$shipping_address_2', '$shipping_country', '$shipping_state', '$shipping_city', '$shipping_postal_code', '$shipping_email', '$shipping_phone', '$memo', '$shipping - $shipping_layanan') ";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully <br>";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
?> 



<?php

//$conn->close();
header("Location: checkout_berhasil.php");
unset($_SESSION['chart']);
?>
