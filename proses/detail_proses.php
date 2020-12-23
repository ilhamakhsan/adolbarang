<?php
include_once("../config.php");
session_start();
$id_produk = $_GET['id'];
//echo $id_produk;
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
</head>
<body>
<section class="w3ls-bnrbtm py-5" id="about">
	<div class="container ">
    <div class="row shadow ">
    <?php 
                  $sql = $conn->query("SELECT mk_products.name, mk_products.stock, mk_products.id, mk_products.unit_price, mk_products.description, mk_products.stock, mk_products.weigth,  core_images.img_path
                  FROM mk_products INNER JOIN core_images ON mk_products.id = core_images.img_parent_id WHERE mk_products.id='$id_produk'") or die (mysql_error());

               while($tampilproduk = $sql->fetch_assoc()){ ?>
                           <?php $stock_barang =$tampilproduk['stock'];
                           ?>
        <div class="col md-6">
            <a href="#"><img class="card-img-top mt-3 mb-3" style="width: 500px; height: 500px;" src="../../backend/admin/uploads/<?php echo $tampilproduk['img_path']; ?>" alt=""></a>
        </div>
        <div class="col md-6">
        <div class="card-body">
             <h4 class="card-title">
              <a href="#"><?php echo $tampilproduk['name']; ?></a>
            </h4>
            <h5>$ <?php echo  number_format($tampilproduk['unit_price']); ?> -,</h5>
            <h5> Stock = <?php echo $tampilproduk['stock']; ?>.</h5>
            <h5>Weight = <?php echo $tampilproduk['weigth']; ?> gram.</h5>
            <p class="card-text"><?php echo $tampilproduk['description']; ?></p>
            <?php   }?>
            <a href="../index.php" class="btn btn-danger"> kembali</a>
            <a href="beli_proses.php?id=<?php echo $id_produk;?>" class="btn btn-primary" class="btn btn-danger" id="popup_box"> Beli</a>
          </div>
        </div>
      
    </div>
    </div>
</section>
    
</body>
</html>

