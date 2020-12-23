<?php
	//$asal = $_POST['asal'];116
	$asal = 399;
	$id_kabupaten = $_POST['kab_id'];
	$kurir = $_POST['kurir'];
	$berat = $_POST['berat'];

	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$id_kabupaten."&weight=".$berat."&courier=".$kurir."",
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    "key:a5e53f0925c10f6ac34af4e67ed6b3e8"
	  ),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  $data = json_decode($response, true);
	}
	?>
	<?php echo $data['rajaongkir']['origin_details']['city_name'];?> ke <?php echo $data['rajaongkir']['destination_details']['city_name'];?> @<?php echo $berat;?>gram Kurir : <?php echo strtoupper($kurir); ?>
	<?php
	 for ($k=0; $k < count($data['rajaongkir']['results']); $k++) {
	?>
				 <?php
				 for ($l=0; $l < count($data['rajaongkir']['results'][$k]['costs']); $l++) {
				 ?>
			      <option value="<?php echo $data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value'];?>"><?php echo $data['rajaongkir']['results'][$k]['costs'][$l]['service']." Rp. ".$data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value'];?></option>
                 <?php
				 }
				 ?>
	 <?php
	 }
	 ?>
