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
 
// id user
$code_id_user = generate_string($permitted_chars, 32);


?>
<?php
// koneksi ke database
include_once("config.php");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


//id 
        
     
?>

<?php
//input register get dari register.php
        $user_id=$code_id_user;
        $user_name= @$_POST['billing_first_name'];
        $billing_first_name= @$_POST['billing_first_name'];
        $billing_last_name= @$_POST['billing_last_name'];
        $billing_company= @$_POST['billing_company'];
        $billing_address_1= @$_POST['billing_address_1'];
        $billing_address_2= @$_POST['billing_address_2'];
        $billing_country= @$_POST['billing_country'];
        $billing_state= @$_POST['billing_state'];
        $billing_city= @$_POST['billing_city'];
        $billing_postal_code= @$_POST['billing_postal_code'];
        $user_email= @$_POST['billing_email'];
        $user_password= md5(@$_POST['password']);
        $user_phone= @$_POST['billing_phone'];
       

?>
<?php
$sql="INSERT INTO `core_users`(`user_id`, `user_is_sys_admin`, `is_shop_admin`, `facebook_id`, `user_name`, `user_email`, `user_phone`, `user_password`, `user_about_me`, `user_cover_photo`, `user_profile_photo`, `role_id`, `status`, `is_banned`, `added_date`, `billing_first_name`, `billing_last_name`, `billing_company`, `billing_address_1`, `billing_address_2`, `billing_country`, `billing_state`, `billing_city`, `billing_postal_code`, `billing_email`, `billing_phone`, `shipping_first_name`, `shipping_last_name`, `shipping_company`, `shipping_address_1`, `shipping_address_2`, `shipping_country`, `shipping_state`, `shipping_city`, `shipping_postal_code`, `shipping_email`, `shipping_phone`, `device_token`) VALUES ('$user_id','0','0','','$user_name','$user_email', '$user_phone', '$user_password', '', '', '', '4', '1', '0', current_timestamp(),'$billing_first_name', '$billing_last_name', '$billing_company', '$billing_address_1', '$billing_address_2', '$billing_country', '$billing_state', '$billing_city', '$billing_postal_code', '$user_email', '$user_phone', '', '', '', '', '', '', '', '', '', '', '', '0')";
if ($conn->query($sql) === TRUE) { ?>
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
  <body>
    <a href="#" class="click"></a>
    <div class="popup_box">
      <i class="fas fa-exclamation"></i>
      <h1>Register Berhasil</h1>
      <div class="btns">
        <a href="index.php" class="btn2" id="popup_box">OK</a>
      </div>
    </div>
  </body>
</html>

    <?php
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

?>

<?php

//$conn->close();
//header("Location: index.php");
?>
